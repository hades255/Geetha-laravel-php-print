<?php
  
namespace App\Console\Commands;
  
use Illuminate\Console\Command;
use Carbon\Carbon;
use Modules\Superadmin\Entities\Subscription;
use App\Business;
use App\Notifications\ExpiredModulesNotification;
use App\User;
use Illuminate\Support\Facades\DB;
   
class ExpiredModules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expired:modules';
  
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify on expired modules';
  
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
  
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        try {
            
            $businesses = Business::select('id', 'name','owner_id')->get()->toArray();
            $modules = $this->getModules();
            $expirykeys = $this->getModuleExpiryKeys();
            
            foreach($businesses as $business){
                
                    $owner = User::select(DB::raw('CONCAT(surname, " ", first_name, " ", last_name) AS name'), 'email')
                         ->where('id', $business['owner_id'])
                         ->first()
                         ->toArray();
                
                $subscription = Subscription::active_subscription( $business['id']);
                if(!empty($subscription)){
                    
                    $activation_details = json_decode($subscription->module_activation_details,true);
                    $i=0;
                    foreach($modules as $one){
                        
                        $expired_on = !empty($activation_details[$expirykeys[$i]]) ? $activation_details[$expirykeys[$i]] : null;
                        
                        
                        if(!empty($expired_on)){
                            
                            $data = array();
                            $data['business_name'] = $business['name'];
                            $data['module_name'] = $one;
                            $data['date'] = $expired_on;
                            $data['owner_name'] = $owner['name'];
                            
                            if(strtotime($expired_on) == date('Y-m-d')){
                                $data['days'] = 0;
                            }elseif((strtotime($expired_on)-time()) == 7){
                                $data['days'] = 7;
                            }elseif((strtotime($expired_on)-time()) == 3){
                                $data['days'] = 3;
                            }elseif((strtotime($expired_on)-time()) == 15){
                                $data['days'] = 15;
                            }elseif((strtotime($expired_on)-time()) == 30){
                                $data['days'] = 30;
                            }
                            if(!empty($data['days'])){
                                
                                
                                $this->sendEmail($data,$owner['email'],$one." Expires in ".$data['days']." days!");
                            }
                            
                            
                        }
                        
                        $i++;
                    }
                    
                    
                
                }
            }
            
        
    } catch (Exception $exception) {
            $this->error('The notification process has been failed.'.$exception);
        }
    }
    
    
    
    public function sendEmail($body,$to,$subject){
        $data['email_body'] = $body;
        $data['subject'] = $subject;

        
        $email_settings['mail_driver'] = config('mail.driver');
        $email_settings['mail_host'] = config('mail.host');
        $email_settings['mail_port'] = config('mail.port');
        $email_settings['mail_username'] = config('mail.username');
        $email_settings['mail_password'] = config('mail.password');
        $email_settings['mail_encryption'] = config('mail.encryption');
        $email_settings['mail_from_address'] = config('mail.from.address');
        $email_settings['mail_from_name'] = config('mail.from.name');
        
        $data['email_settings'] = $email_settings;


        \Notification::route('mail', [$to])
            ->notify(new ExpiredModulesNotification($data));
    }
    
    public function getModules()
    {
        return array("Manufacturing Module",
                    "Accounting Module",
                    "Access Module",
                    "HR Module",
                    "Visitors Registration Module",
                    "Petro Module",
                    "Repair Module",
                    "Fleet Module",
                    "Mpcs Module",
                    "Backup Module",
                    "Property Module",
                    "Auto Repair Module",
                    "Contact Module",
                    "Ran Module",
                    "Report Module",
                    "Settings Module",
                    "User Management Module",
                    "Banking Module",
                    "Sale Module",
                    "Leads Module",
                    
                    "Hospital System",
                    "Enable Restaurant",
                    "Enable Duplicate Invoice",
                    "Tasks Management",
                    "Enable Cheque Writing",
                    "List Easy Payment",
                    "Pump Operator Dashboard",
                    "Stock Taking Module"
                    );
    }
    
    public function getModulePriceKeys(){
        return array(
                'mf_price',
                'ac_price',
                'access_module_price',
                'hr_price',
                'vreg_price',
                'petro_price',
                'repair_price',
                'fleet_price',
                'mpcs_price',
                'backup_price',
                'property_price',
                'auto_price',
                'contact_price',
                'ran_price',
                'report_price',
                'settings_price',
                'um_price',
                'banking_price',
                'sale_price',
                'leads_price',
                
                'hospital_price',
                'restaurant_price',
                'duplicate_invoice_price',
                'tasks_price',
                'cheque_price',
                'list_easy_price',
                'pump_price',
                "stock_taking_price"
                
                
            );
    }
    
    public function getModuleExpiryKeys(){
        return array(
                'mf_expiry_date',
                'ac_expiry_date',
                'access_module_expiry_date',
                'hr_expiry_date',
                'vreg_expiry_date',
                'petro_expiry_date',
                'repair_expiry_date',
                'fleet_expiry_date',
                'mpcs_expiry_date',
                'backup_expiry_date',
                'property_expiry_date',
                'auto_expiry_date',
                'contact_expiry_date',
                'ran_expiry_date',
                'report_expiry_date',
                'settings_expiry_date',
                'um_expiry_date',
                'banking_expiry_date',
                'sale_expiry_date',
                'leads_expiry_date',
                
                
                'hospital_expiry_date',
                'restaurant_expiry_date',
                'duplicate_invoice_expiry_date',
                'tasks_expiry_date',
                'cheque_expiry_date',
                'list_easy_expiry_date',
                'pump_expiry_date',
                'stock_taking_expiry_date'
            );
    }
    
    public function getModuleActivatedKeys(){
        return array(
                'mf_activated_on',
                'ac_activated_on',
                'access_module_activated_on',
                'hr_activated_on',
                'vreg_activated_on',
                'petro_activated_on',
                'repair_activated_on',
                'fleet_activated_on',
                'mpcs_activated_on',
                'backup_activated_on',
                'property_activated_on',
                'auto_activated_on',
                'contact_activated_on',
                'ran_activated_on',
                'report_activated_on',
                'settings_activated_on',
                'um_activated_on',
                'banking_activated_on',
                'sale_activated_on',
                'leads_activated_on',
                
                'hospital_activated_on',
                'restaurant_activated_on',
                'duplicate_invoice_activated_on',
                'tasks_activated_on',
                'cheque_activated_on',
                'list_easy_activated_on',
                'pump_activated_on',
                'stock_taking_activated_on'
            );
    }
}