<?php

namespace App\Http\Controllers;

use App\Account;
use App\AccountGroup;

use App\AccountTransaction;

use App\AccountType;
use App\Business;
use App\BusinessLocation;
use App\Currency;
use App\Transaction;
use App\TransactionPayment;
use App\Utils\BusinessUtil;
use App\Utils\ModuleUtil;
use App\Utils\TransactionUtil;
use App\VariationLocationDetails;
use App\VariationStoreDetails;
use App\Charts\CommonChart;
use Carbon\Carbon;
use Datatables;
use DB;
use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Contracts\Repositories\HostnameRepository;
use Modules\Superadmin\Entities\HelpExplanation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Superadmin\Entities\Subscription;

class HomeController extends Controller
{
    /**
     * All Utils instance.
     *
     */
    protected $businessUtil;
    protected $transactionUtil;
    protected $moduleUtil;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        BusinessUtil    $businessUtil,
        TransactionUtil $transactionUtil,
        ModuleUtil      $moduleUtil
    )
    {
        $this->businessUtil = $businessUtil;
        $this->transactionUtil = $transactionUtil;
        $this->moduleUtil = $moduleUtil;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        $business_id = request()->session()->get('user.business_id');
        $subscription = Subscription::active_subscription($business_id);
        $currency = Currency::where('id', request()->session()->get('business.currency_id'))->first();
        
        
        if (session()->get('business.is_patient')) {
            return redirect('patient');
        }
        if (session()->get('business.is_hospital') || session()->get('business.is_laboratory')) {
            return redirect('hospital');
        }
        $home_dashboard = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'home_dashboard');
        $enable_petro_module = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'enable_petro_module');
        /**
         * @author:Afes Oktavianus
         * @since: 25-08-2021
         * @Req :3413
         */
         
         if (request()->ajax()) {
             $filter = request()->filter;
             $type = request() ->type;
             
             $bargraph = array();
             
             $divide = 0;
             
             switch($filter){
                 case "today":
                     $start = date('Y-m-d');
                     $start_prev = date('Y-m-d', strtotime('-1 day', strtotime($start)));
                     
                     $end = date('Y-m-d');
                     $end_prev = date('Y-m-d', strtotime('-1 day', strtotime($end)));
                     
                     $prev_title = "Day ";
                     
                     $bargraph[] = array("start" => $start,"end" => $end);
                     
                     break;
                     
                case "yesterday":
                     $start = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
                     $start_prev = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
                     
                     $end = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
                     $end_prev = date('Y-m-d', strtotime('-1 day', strtotime($end)));
                     
                     $prev_title = "2 Days ";
                     $bargraph[] = array("start" => $start,"end" => $end);
                     
                     break;
                case "week":
                    $start = date('Y-m-d', strtotime('monday this week'));
                    $start_prev = date('Y-m-d', strtotime('-7 day', strtotime($start)));
                    
                    $end = date('Y-m-d', strtotime('sunday this week'));
                    $end_prev = date('Y-m-d', strtotime('-7 day', strtotime($end)));
                    
                    for($i= (int) date('d',strtotime($start));$i <= (int) date('d',strtotime($end)); $i++){
                        
                        $d = str_pad($i, 2, '0', STR_PAD_LEFT);
                        
                        $bargraph[] = array("start" => date("Y-m-$d"),"end" => date("Y-m-$d"));
                    }
                    
                    $prev_title = "Week ";
                    
                    break;
                 case "financial-year":
                     $divide = 1;
                    $start = request()->session()->get("financial_year.start");
                    $start_prev = date('Y-m-d', strtotime('-1 year', strtotime($start)));
                    
                    $end = request()->session()->get("financial_year.end");
                    $end_prev = date('Y-m-d', strtotime('-1 year', strtotime($end)));
                    
                    
                    for($i= 1;$i <= 12; $i++){
                        $d = str_pad($i, 2, '0', STR_PAD_LEFT);
                        
                        $query_date = date('Y-').$d."-01";
                        
                        
                        $bargraph[] = array("start" => date("Y-$d-01"),"end" => date('Y-m-t',strtotime($query_date)));
                        
                    }
                    
                    
                    $prev_title = "Financial Year ";
                    
                    break;
                    
                case "month":
                    
                    $m = date('t');
                    $prev = str_pad((( (int) date('m') ) - 1), 2, '0', STR_PAD_LEFT);
                    
                    $start = date('Y-m-01');
                    $start_prev = date("Y-$prev-01");
                    
                    $end = date('Y-m-t');
                    $end_prev = date("Y-$prev-t");
                    
                    $prev_title = "Month ";
                    
                    $times = floor($m/3);
                    $k = 0;
                    
                    for($i= 1;$i <= (int) date('d',strtotime($end)); $i+=3){
                        $k++;
                        
                        $d = str_pad($i, 2, '0', STR_PAD_LEFT);
                        
                        if($k == $times){
                           $bargraph[] = array("start" => date("Y-m-$d"),"end" => date("Y-m-t")); 
                           break;
                        }else{
                            
                            $dEnd = str_pad($i+2, 2, '0', STR_PAD_LEFT);
                            
                            $bargraph[] = array("start" => date("Y-m-$d"),"end" => date("Y-m-$dEnd")); 
                        }
                        
                        
                    }
                    
                    
                    break;
                case "year":
                    $divide = 1;
                    $start = date('Y-01-01');
                    $start_prev = date('Y-m-d', strtotime('-1 year', strtotime($start)));
                    
                    $end = date('Y-12-31');
                    $end_prev = date('Y-m-d', strtotime('-1 year', strtotime($end)));
                    
                    
                    for($i= 1;$i <= 12; $i++){
                        $d = str_pad($i, 2, '0', STR_PAD_LEFT);
                        
                        $query_date = date('Y-').$d."-01";
                        
                        
                        $bargraph[] = array("start" => date("Y-$d-01"),"end" => date('Y-m-t',strtotime($query_date)));
                        
                    }
                    
                    
                    $prev_title = "Year ";
                    
                    break;
                default:
                    $start = date('Y-m-d');
                     $start_prev = date('Y-m-d', strtotime('-1 day', strtotime($start)));
                     
                     $end = date('Y-m-d');
                     $end_prev = date('Y-m-d', strtotime('-1 day', strtotime($end)));
                     
                     $prev_title = "Day ";
                     
                     $bargraph[] = array("start" => $start,"end" => $end);
             }
             
             
             
             $incomeGrp_accounts = Account::leftjoin('account_groups', 'accounts.asset_type', 'account_groups.id')->where('accounts.business_id', $business_id)->where('account_groups.name', 'Sales Income Group')->select('accounts.id')->get()->pluck('id');
             
             $receivables = Account::leftjoin('account_groups', 'accounts.asset_type', 'account_groups.id')->where('accounts.business_id', $business_id)->where('accounts.name', 'Accounts Receivable')->select('accounts.id')->get()->pluck('id');
             
             $cashacc = Account::leftjoin('account_groups', 'accounts.asset_type', 'account_groups.id')->where('accounts.business_id', $business_id)->where('account_groups.name', 'Cash Account')->select('accounts.id')->get()->pluck('id');
             
             $card_account = $this->transactionUtil->account_exist_return_id('Cards (Credit Debit) Account');
        
            // GET LINKED CARD ACCOUNT IDS
            $cardsacc = $this->getLinkedCardsIds($card_account);
             
             $sales = $this->totalDebitsTotalCredits($business_id,$incomeGrp_accounts,$start,$end)['credit'];
             
             $credit_received = $this->totalDebitsTotalCredits($business_id,$receivables,$start,$end)['credit'];
             
             $purchases = $this->getTotalPurchases($business_id, $start, $end);
             
             $filters = array("start_date" => $start,"end_date" => $end);
             
             $expenses = $this->transactionUtil->getExpenseReport($business_id, $filters,"total");
             
             $fga_id = $this->transactionUtil->account_exist_return_id('Finished Goods Account');
             
             $stock_acount_balance_pre = Account::getAccountBalance($fga_id, $start, $end, true, true, false);
             
             
             $stocks = $stock_acount_balance_pre + $purchases - $sales;
             
             $credit_OB = $this->getcreditOpeningBalance($start,$receivables,$end);
             $credit_OB_prev = $this->getcreditOpeningBalance($start_prev,$receivables,$end_prev);
             
             
             
             $credit_given = $this->totalDebitsTotalCredits($business_id,$receivables,$start,$end)['debit'];
             $credit_given_prev = $this->totalDebitsTotalCredits($business_id,$receivables,$start_prev,$end_prev)['debit'];
             
             
             $cashtrans = $this->totalDebitsTotalCredits($business_id,$cashacc,$start,$end)['debit'];
             $cashtrans_prev = $this->totalDebitsTotalCredits($business_id,$cashacc,$start_prev,$end_prev)['debit'];
             
             
             $cardtrans = $this->totalDebitsTotalCredits($business_id,$cardsacc,$start,$end)['debit'];
             $cardtrans_prev = $this->totalDebitsTotalCredits($business_id,$cardsacc,$start_prev,$end_prev)['debit'];
             
             
             $shortage_query = Transaction::select('transaction_payments.final_total')
                ->leftjoin('transaction_payments', 'transactions.id', 'transaction_payments.transaction_id')
             
                ->where('transactions.business_id', $business_id)->where('type', 'settlement')->where('sub_type', 'shortage')
    
                ->whereIn('transactions.payment_status', ['paid', 'partial'])
    
                ->whereDate('transaction_date', '>=', $start)
    
                ->whereDate('transaction_date', '<=', $end);
                
             $shortage = $shortage_query->sum('final_total');
             
             $shortage_query_prev = Transaction::select('transaction_payments.final_total')
                ->leftjoin('transaction_payments', 'transactions.id', 'transaction_payments.transaction_id')
             
                ->where('transactions.business_id', $business_id)->where('type', 'settlement')->where('sub_type', 'shortage')
    
                ->whereIn('transactions.payment_status', ['paid', 'partial'])
    
                ->whereDate('transaction_date', '>=', $start_prev)
    
                ->whereDate('transaction_date', '<=', $end_prev);
                
             $shortage_prev = $shortage_query_prev->sum('final_total');
             
             $pie_chart = [round($cashtrans,2), round($cardtrans,2),round($credit_given,2),round($shortage,2)];
             $pie_chart_prev = [round($cashtrans_prev,2), round($cardtrans_prev,2),round($credit_given_prev,2),round($shortage_prev,2)];
             
            
            $chartdata = array();
            foreach($bargraph as $bar){
                $filtersN = array("start_date" => $bar['start'],"end_date" => $bar['end']);
                $expensesN = $this->transactionUtil->getExpenseReport($business_id, $filtersN,"total");
                
                $stock_acount_balance_preN = Account::getAccountBalance($fga_id, $bar['start'], $bar['end'], true, true, false);
             
             
                 $stocksN = ($stock_acount_balance_preN + $this->getTotalPurchases($business_id, $bar['start'], $bar['end']) - $this->totalDebitsTotalCredits($business_id,$incomeGrp_accounts,$bar['start'],$bar['end'])['credit'])/1000;
                 
                 if($divide == "1"){
                     $stocksN *=1000;
                 }
                
                $chartdata[] = array(
                    "year"=> $bar['end'],
                    "purchases" => $this->getTotalPurchases($business_id, $bar['start'], $bar['end']),
                    
                    "sales"=> $this->totalDebitsTotalCredits($business_id,$incomeGrp_accounts,$bar['start'],$bar['end'])['credit'],
                    "stocks" => $stocksN,
                    "expenses" => $expensesN->total_expense,
                    "color"=> "#311B92",
                    "color2"=> "#2E7D32",
                    "color3" => "#B56101",
                    "color4" => "#D32F2F",
                );
            }
            
             
            //  $bar_chart = $this->getBarchart($filter,$start,$end);
             
             $layered = $this->getLayeredchart($filter,$start,$end,$start_prev,$end_prev,$divide);
             
             
             if($type == "sub"){
                $topcats = DB::table('transaction_sell_lines')
                        ->join('transactions','transactions.id','=','transaction_sell_lines.transaction_id')
                        ->join('products', 'products.id', '=', 'transaction_sell_lines.product_id')
                        ->join('categories', 'categories.id', '=', 'products.sub_category_id')
                        ->select('categories.name', DB::raw('SUM(transaction_sell_lines.quantity*transaction_sell_lines.unit_price) as valued'))
                        ->groupBy('categories.id')
                        ->where('transactions.business_id',$business_id)
                        ->whereDate('transactions.transaction_date','>=',$start)
                        ->whereDate('transactions.transaction_date','<=',$end)
                        ->orderBy('valued', 'desc')
                        ->limit(4)
                        ->get()->toArray(); 
             }else{
                 
                 $topcats = DB::table('transaction_sell_lines')
                        ->join('transactions','transactions.id','=','transaction_sell_lines.transaction_id')
                        ->join('products', 'products.id', '=', 'transaction_sell_lines.product_id')
                        ->join('categories', 'categories.id', '=', 'products.category_id')
                        ->select('categories.name', DB::raw('SUM(transaction_sell_lines.quantity*transaction_sell_lines.unit_price) as valued'))
                        ->groupBy('categories.id')
                        ->where('transactions.business_id',$business_id)
                        ->whereDate('transactions.transaction_date','>=',$start)
                        ->whereDate('transactions.transaction_date','<=',$end)
                        ->orderBy('valued', 'desc')
                        ->limit(4)
                        ->get()->toArray();
                 
             }
             
            $topcatsVal = [];
            $topcatsLab = [];
            foreach($topcats as $one){
                $topcatsVal[] = $one->name;
                $topcatsLab[] = (int) $one->valued;
            }
                
                
             
            
             return json_encode(array("sales" => $currency->symbol." ".number_format($sales,2,$currency->decimal_separator,$currency->thousand_separator),
             
                 "credit_given" => $currency->symbol." ".number_format($credit_received,2,$currency->decimal_separator,$currency->thousand_separator)
                 ,
                 "purchases" => $currency->symbol." ".number_format($purchases,2,$currency->decimal_separator,$currency->thousand_separator),
                 "expenses" => $currency->symbol." ".number_format($expenses->total_expense,2,$currency->decimal_separator,$currency->thousand_separator),
                 "stocks" => $currency->symbol." ".number_format($stocks,2,$currency->decimal_separator,$currency->thousand_separator),
                 
                 "credit_received" => $currency->symbol." ".number_format($credit_given,2,$currency->decimal_separator,$currency->thousand_separator),
                 "bar_char" => json_encode($chartdata),
                 
                 "pie_chart" => $pie_chart,
                 
                 "pie_curr" => $pie_chart,
                 
                 "pie_prev" => $pie_chart_prev,
                 
                 "prev_title" => $prev_title,
                 
                 "layered" => $layered,
                 
                 "topcatsVal" => $topcatsVal,
                 
                 "topcatsLab" =>$topcatsLab 
                 
                 )
             );
             
         }
         
         
         
         
        $enable_petro_dashboard = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'enable_petro_module');
        $enable_petro_task_management = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'enable_petro_task_management');
        $enable_petro_pump_management = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'enable_petro_pump_management');
        $enable_petro_management_testing = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'enable_petro_management_testing');
        $enable_petro_meter_reading = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'enable_petro_meter_reading');
        $enable_petro_meter_resetting = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'enable_petro_meter_resetting');
        $enable_petro_pump_dashboard = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'enable_petro_pump_dashboard');
        $enable_petro_pumper_management = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'enable_petro_pumper_management');
        $enable_petro_daily_collection = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'enable_petro_daily_collection');
        $enable_petro_settlement = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'enable_petro_settlement');
        $enable_petro_list_settlement = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'enable_petro_list_settlement');
        $enable_petro_dip_management = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'enable_petro_dip_management');
        $report_module = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'report_module');
        $product_report = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'product_report');
        $payment_status_report = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'payment_status_report');
        $report_daily = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'report_daily');
        $report_daily_summary = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'report_daily_summary');
        $report_profit_loss = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'report_profit_loss');
        $report_credit_status = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'report_credit_status');
        $activity_report = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'activity_report');
        $contact_report = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'contact_report');
        $trending_product = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'trending_product');
        $user_activity = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'user_activity');
        $report_verification = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'report_verification');
        $report_table = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'report_table');
        $report_staff_service = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'report_staff_service');
        $report_register = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'report_register');
        $contact_module = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'contact_module');
        $contact_supplier = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'contact_supplier');
        $contact_customer = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'contact_customer');
        $contact_group_customer = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'contact_group_customer');
        $contact_group_supplier = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'contact_group_supplier');
        $import_contact = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'import_contact');
        $customer_reference = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'customer_reference');
        $customer_statement = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'customer_statement');
        $customer_payment = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'customer_payment');
        $outstanding_received = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'outstanding_received');
        $issue_payment_detail = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'issue_payment_detail');

        $edit_received_outstanding = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'edit_received_outstanding');
        $pos_sale = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'pos_sale');

        $cheque_templates = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'cheque_templates');
        $write_cheque = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'write_cheque');
        $manage_stamps = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'manage_stamps');
        $manage_payee = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'manage_payee');
        $cheque_number_list = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'cheque_number_list');
        $deleted_cheque_details = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'deleted_cheque_details');
        $printed_cheque_details = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'printed_cheque_details');
        $default_setting = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'default_setting');

        $pump_operator_dashboard = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'pump_operator_dashboard');
        $property_module = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'property_module');
        $disable_all_other_module_vr = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'disable_all_other_module_vr');
        if ($disable_all_other_module_vr && !auth()->user()->can('superadmin')) {
            return redirect()->to('visitor-module/visitor');
        }
        
        if (!auth()->user()->can('dashboard.data')) {
            return view('home.index')->with(compact('home_dashboard', 'property_module', 'enable_petro_module', 'enable_petro_dashboard',
                'enable_petro_task_management',
                'enable_petro_pump_management',
                'enable_petro_management_testing',
                'enable_petro_meter_reading',
                'enable_petro_meter_resetting',
                'enable_petro_pump_dashboard',
                'enable_petro_pumper_management',
                'enable_petro_daily_collection',
                'enable_petro_settlement',
                'enable_petro_list_settlement',
                'enable_petro_dip_management',
                'report_module',
                'product_report',
                'payment_status_report',
                'report_daily',
                'report_daily_summary',
                'report_profit_loss',
                'report_credit_status',
                'activity_report',
                'contact_report',
                'trending_product',
                'user_activity',
                'report_verification',
                'report_table',
                'report_staff_service',
                'report_register',
                'contact_module',
                'contact_supplier',
                'contact_customer',
                'contact_group_customer',
                'contact_group_supplier',
                'import_contact',
                'customer_reference',
                'customer_statement',
                'customer_payment',
                'outstanding_received',
                'issue_payment_detail',
                'edit_received_outstanding',
                'pos_sale',
                'subscription',
                'cheque_templates',
                'write_cheque',
                'manage_stamps',
                'manage_payee',
                'cheque_number_list',
                'deleted_cheque_details',
                'printed_cheque_details',
                'default_setting',
                'currency'
            ));
        }
        // $fy = $this->businessUtil->getCurrentFinancialYear($business_id);
        // $date_filters['this_fy'] = $fy;
        // $date_filters['this_month']['start'] = date('Y-m-01');
        // $date_filters['this_month']['end'] = date('Y-m-t');
        // $date_filters['this_week']['start'] = date('Y-m-d', strtotime('monday this week'));
        // $date_filters['this_week']['end'] = date('Y-m-d', strtotime('sunday this week'));
        
        
        //Chart for sells last 30 days
        // $sells_last_30_days = $this->transactionUtil->getSellsLast30Days($business_id);
        // $labels = [];
        // $all_sell_values = [];
        // $dates = [];
        // for ($i = 29; $i >= 0; $i--) {
        //     $date = \Carbon::now()->subDays($i)->format('Y-m-d');
        //     $dates[] = $date;
        //     $labels[] = date('j M Y', strtotime($date));
        //     if (!empty($sells_last_30_days[$date])) {
        //         $all_sell_values[] = $sells_last_30_days[$date];
        //     } else {
        //         $all_sell_values[] = 0;
        //     }
        // }
        
        
        //Get sell for indivisual locations
        // $all_locations = BusinessLocation::forDropdown($business_id);
        // $location_sells = [];
        // $sells_by_location = $this->transactionUtil->getSellsLast30Days($business_id, true);
        // foreach ($all_locations as $loc_id => $loc_name) {
        //     $values = [];
        //     foreach ($dates as $date) {
        //         $sell = $sells_by_location->first(function ($item) use ($loc_id, $date) {
        //             return $item->date == $date &&
        //                 $item->location_id == $loc_id;
        //         });
        //         if (!empty($sell)) {
        //             $values[] = $sell->total_sells;
        //         } else {
        //             $values[] = 0;
        //         }
        //     }
        //     $location_sells[$loc_id]['loc_label'] = $loc_name;
        //     $location_sells[$loc_id]['values'] = $values;
        // }
        // $sells_chart_1 = new CommonChart;
        // $sells_chart_1->labels($labels)
        //     ->options($this->__chartOptions(__(
        //         'home.total_sells',
        //         ['currency' => $currency->code]
        //     )));
        // if (!empty($location_sells)) {
        //     foreach ($location_sells as $location_sell) {
        //         $sells_chart_1->dataset($location_sell['loc_label'], 'line', $location_sell['values']);
        //     }
        // }
        // if (count($all_locations) > 1) {
        //     $sells_chart_1->dataset(__('report.all_locations'), 'line', $all_sell_values);
        // }
        // //Chart for sells this financial year
        // $sells_this_fy = $this->transactionUtil->getSellsCurrentFy($business_id, $fy['start'], $fy['end']);
        // $labels = [];
        // $values = [];
        // $months = [];
        // $date = strtotime($fy['start']);
        // $last = date('m-Y', strtotime($fy['end']));
        // $fy_months = [];
        // do {
        //     $month_year = date('m-Y', $date);
        //     $fy_months[] = $month_year;
        //     $month_number = date('m', $date);
        //     $labels[] = Carbon::createFromFormat('m-Y', $month_year)
        //         ->format('M-Y');
        //     $date = strtotime('+1 month', $date);
        //     if (!empty($sells_this_fy[$month_year])) {
        //         $values[] = $sells_this_fy[$month_year];
        //     } else {
        //         $values[] = 0;
        //     }
        // } while ($month_year != $last);
        // $fy_sells_by_location = $this->transactionUtil->getSellsCurrentFy($business_id, $fy['start'], $fy['end'], true);
        // $fy_sells_by_location_data = [];
        // foreach ($all_locations as $loc_id => $loc_name) {
        //     $values_data = [];
        //     foreach ($fy_months as $month) {
        //         $sell = $fy_sells_by_location->first(function ($item) use ($loc_id, $month) {
        //             return $item->yearmonth == $month &&
        //                 $item->location_id == $loc_id;
        //         });
        //         if (!empty($sell)) {
        //             $values_data[] = $sell->total_sells;
        //         } else {
        //             $values_data[] = 0;
        //         }
        //     }
        //     $fy_sells_by_location_data[$loc_id]['loc_label'] = $loc_name;
        //     $fy_sells_by_location_data[$loc_id]['values'] = $values_data;
        // }
        // $sells_chart_2 = new CommonChart;
        // $sells_chart_2->labels($labels)
        //     ->options($this->__chartOptions(__(
        //         'home.total_sells',
        //         ['currency' => $currency->code]
        //     )));
        // if (!empty($fy_sells_by_location_data)) {
        //     foreach ($fy_sells_by_location_data as $location_sell) {
        //         $sells_chart_2->dataset($location_sell['loc_label'], 'line', $location_sell['values']);
        //     }
        // }
        // if (count($all_locations) > 1) {
        //     $sells_chart_2->dataset(__('report.all_locations'), 'line', $values);
        // }
        // //Get Dashboard widgets from module
        // $module_widgets = $this->moduleUtil->getModuleData('dashboard_widget');
        // $widgets = [];
        // foreach ($module_widgets as $widget_array) {
        //     if (!empty($widget_array['position'])) {
        //         $widgets[$widget_array['position']][] = $widget_array['widget'];
        //     }
        // }
        // $pending_customer_payments = Transaction::leftjoin('contacts', 'transactions.contact_id', 'contacts.id')->select('name')->where('transactions.business_id', $business_id)->where('payment_status', 'pending')->groupBy('name')->pluck('name')->toArray();
        // $customer_name_payment = implode(',', $pending_customer_payments);
        // $help_explanations = HelpExplanation::pluck('value', 'help_key');
        // $register_success = session('register_success');
        
        
        
        return view('home.index', compact(
            /*'help_explanations',*/
            'home_dashboard',
            /*'date_filters',*/
            /*'sells_chart_1',
            'sells_chart_2',*/
            /*'widgets',*/
            /*'customer_name_payment',
            'all_locations',*/
            'pump_operator_dashboard',
            'property_module',
            'enable_petro_module',
            'enable_petro_dashboard',
            'enable_petro_task_management',
            'enable_petro_pump_management',
            'enable_petro_management_testing',
            'enable_petro_meter_reading',
            'enable_petro_meter_resetting',
            'enable_petro_pump_dashboard',
            'enable_petro_pumper_management',
            'enable_petro_daily_collection',
            'enable_petro_settlement',
            'enable_petro_list_settlement',
            'enable_petro_dip_management',
            /*'register_success',*/
            'report_module',
            'product_report',
            'payment_status_report',
            'report_daily',
            'report_daily_summary',
            'report_profit_loss',
            'report_credit_status',
            'activity_report',
            'contact_report',
            'trending_product',
            'user_activity',
            'report_verification',
            'report_table',
            'report_staff_service',
            'report_register',
            'contact_module',
            'contact_supplier',
            'contact_customer',
            'contact_group_customer',
            'contact_group_supplier',
            'import_contact',
            'customer_reference',
            'customer_statement',
            'customer_payment',
            'outstanding_received',
            'issue_payment_detail',
            'edit_received_outstanding',
            'pos_sale',
            'subscription',
            'cheque_templates',
            'write_cheque',
            'manage_stamps',
            'manage_payee',
            'cheque_number_list',
            'deleted_cheque_details',
            'printed_cheque_details',
            'default_setting',
            'currency'
        ));
    }
    
    public function getLinkedCardsIds($parent_id){
        $cards = Account::where('parent_account_id', $parent_id)->pluck('id');
        return $cards;
    }
    
    public function getLayeredchart($filter,$start,$end,$start_prev,$end_prev,$divide){
        
       $business_id = request()->session()->get('user.business_id');
        $incomeGrp_accounts = Account::leftjoin('account_groups', 'accounts.asset_type', 'account_groups.id')->where('accounts.business_id', $business_id)->where('account_groups.name', 'Sales Income Group')->select('accounts.id')->get()->pluck('id');
             
         $receivables = Account::leftjoin('account_groups', 'accounts.asset_type', 'account_groups.id')->where('accounts.business_id', $business_id)->where('account_groups.name', 'Accounts Receivable')->select('accounts.id')->get()->pluck('id');
         
        $fga_id = $this->transactionUtil->account_exist_return_id('Finished Goods Account');
            
        $chartdata = array();  
        
        $sales = $this->totalDebitsTotalCredits($business_id,$incomeGrp_accounts,$start,$end)['credit'];
        $sales_prev = $this->totalDebitsTotalCredits($business_id,$incomeGrp_accounts,$start_prev,$end_prev)['credit'];
        
                     
        $purchases = $this->getTotalPurchases($business_id, $start, $end);
        $purchases_prev = $this->getTotalPurchases($business_id, $start_prev, $end_prev);
        
        
        $filters = array("start_date" => $start,"end_date" => $end);
        $filters_prev = array("start_date" => $start_prev,"end_date" => $end_prev);
        
        
        $expenses = $this->transactionUtil->getExpenseReport($business_id, $filters,"total");
        $expenses_prev = $this->transactionUtil->getExpenseReport($business_id, $filters_prev,"total");
        
        
        $stock_acount_balance_pre = Account::getAccountBalance($fga_id, $start, $end, true, true, false);
        $stock_acount_balance_pre_prev = Account::getAccountBalance($fga_id, $start_prev, $end_prev, true, true, false);
        
        
        $todaysStockSummary = $this->totalDebitsTotalCredits($business_id,[$fga_id],$start,$end);
        $todaysStockSummary_prev = $this->totalDebitsTotalCredits($business_id,[$fga_id],$start_prev,$end_prev);
        
        $stocks = ($stock_acount_balance_pre + $purchases - $sales)/1000;
        $stocks_prev = ($stock_acount_balance_pre_prev + $purchases_prev - $sales_prev) /1000;
        
        
        $credit_received = $this->totalDebitsTotalCredits($business_id,$receivables,$start,$end)['credit'];
        $credit_received_prev = $this->totalDebitsTotalCredits($business_id,$receivables,$start_prev,$end_prev)['credit'];
        
        $credit_OB = $this->getcreditOpeningBalance($start,$receivables,$end);
        
         $credit_OB_prev = $this->getcreditOpeningBalance($start_prev,$receivables,$end_prev);
        
        $credit_given = $this->totalDebitsTotalCredits($business_id,$receivables,$start,$end)['debit'];
        
        $credit_given_prev = $this->totalDebitsTotalCredits($business_id,$receivables,$start_prev,$end_prev)['debit'];
        
        
        // {
        //   "country": "USA",
        //   "year2004": 3.5,
        //   "year2005": 4.2
        // },
        
        if($divide == "1"){
             $stocks *=1000;
             $stocks_prev *=1000;
         }
         
        $chartdata = array(
                ["type" => "Purchases", "This" => $purchases, "Last" => $purchases_prev,"color" => '#bfbffd', "color2" => '#7474F0'],
                
                ["type" => "Sales", "This" => $sales, "Last" => $sales_prev,"color" => '#bfbffd', "color2" => '#7474F0'],
                
                ["type" => "Stocks", "This" => $stocks, "Last" => $stocks_prev,"color" => '#bfbffd', "color2" => '#7474F0'],
                
                ["type" => "Expenses", "This" => $expenses, "Last" => $expenses_prev,"color" => '#bfbffd', "color2" => '#7474F0'],
                
                ["type" => "Credit Given", "This" => $credit_given, "Last" => $credit_given_prev,"color" => '#bfbffd', "color2" => '#7474F0'],
                
                ["type" => "Credit Received", "This" => $credit_received, "Last" => $credit_received_prev,"color" => '#bfbffd', "color2" => '#7474F0']
            );
        
        return json_encode($chartdata);
            
    }
    
    public function getcreditOpeningBalance($start_date,$id,$end_date){
        $balance = 0;
        $opening_balance = DB::table('account_transactions')
                            ->join('transactions', 'transactions.id', '=', 'account_transactions.transaction_id')
                            ->whereDate('account_transactions.operation_date', '>=',$start_date)
                            ->whereDate('account_transactions.operation_date','>=', $end_date)
                            ->whereIn('account_transactions.account_id', $id)
                            ->where('account_transactions.type', '=', 'debit')
                            ->where('transactions.type', '=', 'opening_balance')
                            ->select(DB::raw('SUM(account_transactions.amount) as total'))
                            ->orderBy('account_transactions.id', 'ASC')
                            ->get();
        
        $balance = $opening_balance->first()->total;
        
        return $balance;
    }
    

    /**
     * Retrieves purchase and sell details for a given time period.
     *
     * @return \Illuminate\Http\Response
     */
     private function getTotalPurchases($business_id, $start = null, $end = null) {
        $purchases = Transaction::leftJoin('contacts', 'transactions.contact_id', '=', 'contacts.id')
            ->join(
                'business_locations AS BS',
                'transactions.location_id',
                '=',
                'BS.id'
            )
            ->leftJoin(
                'transaction_payments AS TP',
                'transactions.id',
                '=',
                'TP.transaction_id'
            )
            ->leftJoin(
                'transactions AS PR',
                'transactions.id',
                '=',
                'PR.return_parent_id'
            )
            ->leftJoin('users as u', 'transactions.created_by', '=', 'u.id')
            ->leftJoin('purchase_lines as pl', 'pl.transaction_id', '=', 'transactions.id')
            ->where('transactions.business_id', $business_id)
            ->where('transactions.type', 'purchase')
            ->select(
                'transactions.id',
                'transactions.document',
                'transactions.transaction_date',
                'transactions.ref_no',
                'transactions.invoice_no',
                'transactions.purchase_entry_no',
                'contacts.name',
                'transactions.status',
                'transactions.payment_status',
                'transactions.final_total',
                'BS.name as location_name',
                'transactions.pay_term_number',
                'transactions.pay_term_type',
                'PR.id as return_transaction_id',
                'TP.method',
                'TP.account_id',
                'TP.cheque_number',
                'pl.lot_number',
                DB::raw('SUM(TP.amount) as amount_paid'),
                DB::raw('(SELECT SUM(TP2.amount) FROM transaction_payments AS TP2 WHERE
                    TP2.transaction_id=PR.id ) as return_paid'),
                DB::raw('COUNT(PR.id) as return_exists'),
                DB::raw('COALESCE(PR.final_total, 0) as amount_return'),
                DB::raw("CONCAT(COALESCE(u.surname, ''),' ',COALESCE(u.first_name, ''),' ',COALESCE(u.last_name,'')) as added_by")
            )
            ->groupBy('transactions.id');

        $permitted_locations = auth()->user()->permitted_locations();
        if ($permitted_locations != 'all') {
            $purchases->whereIn('transactions.location_id', $permitted_locations);
        }

        if (!empty(request()->supplier_id)) {
            $purchases->where('contacts.id', request()->supplier_id);
        }
        if (!empty(request()->location_id)) {
            $purchases->where('transactions.location_id', request()->location_id);
        }
        if (!empty(request()->input('payment_status')) && request()->input('payment_status') != 'overdue') {
            $purchases->where('transactions.payment_status', request()->input('payment_status'));
        } elseif (request()->input('payment_status') == 'overdue') {
            $purchases->whereIn('transactions.payment_status', ['due', 'partial'])
                ->whereNotNull('transactions.pay_term_number')
                ->whereNotNull('transactions.pay_term_type')
                ->whereRaw("IF(transactions.pay_term_type='days', DATE_ADD(transactions.transaction_date, INTERVAL transactions.pay_term_number DAY) < CURDATE(), DATE_ADD(transactions.transaction_date, INTERVAL transactions.pay_term_number MONTH) < CURDATE())");
        }

        if (!empty(request()->status)) {
            $purchases->where('transactions.status', request()->status);
        }

        if (!empty($start)) {
            $purchases->whereDate('transactions.transaction_date', '>=', $start);
        }
        if(!empty($end)) {
            $purchases->whereDate('transactions.transaction_date', '<=', $end);
        }
        $purchasesArr = $purchases->get();
        $tot = 0;
        foreach($purchasesArr as $p) $tot += $p->final_total;
        return $tot;
    }
     
        public function totalDebitsTotalCredits($business_id,$id,$start_date,$end_date){
                    $accounts = AccountTransaction::join(
                'accounts as A',
                'account_transactions.account_id',
                '=',
                'A.id'
            )
                ->leftJoin('users AS u', 'account_transactions.created_by', '=', 'u.id')
                ->leftjoin(
                    'account_types as ats',
                    'A.account_type_id',
                    '=',
                    'ats.id'
                )
                ->leftJoin('transaction_payments AS TP', 'account_transactions.transaction_payment_id', '=', 'TP.id')
                ->where('A.business_id', $business_id)
                ->whereIn('A.id', $id)
                ->where(function ($query) {
                    $query->whereNull('account_transactions.transaction_payment_id')
                          ->orWhere(function ($query2) {
                                $query2->whereNotNull('account_transactions.transaction_payment_id')
                                        ->whereNotNull('TP.id');
                          });
                })
                ->with(['transaction', 'transaction.contact', 'transfer_transaction'])
                ->select([
                     'type',
                    'account_transactions.account_id',
                    'account_transactions.amount',
                    'account_transactions.interest',
                    'account_transactions.reconcile_status',
                    'account_transactions.sub_type as at_sub_type',
                    'operation_date', 'account_transactions.note',
                    'journal_deleted',
                    'deleted_by',
                    'journal_entry',
                    'account_transactions.transaction_sell_line_id',
                    'account_transactions.income_type',
                    'account_transactions.attachment',
                    'account_transactions.cheque_number as dep_trans_cheque_number',
                    'account_transactions.transaction_payment_id as tp_id',
                    'TP.cheque_number', 'TP.bank_name', 'TP.cheque_date',
                    'TP.card_type',
                    'TP.method',
                    'TP.paid_on',
                    'TP.payment_ref_no',
                    'TP.account_id as bank_account_id',
                     'updated_type',
                    'updated_by',
                    'account_transactions.updated_at',
                    'A.name as account_name',
                    'sub_type',
                    'transfer_transaction_id',
                    'ats.name as account_type_name',
                    'account_transactions.transaction_id',
                    'account_transactions.id',
                    DB::raw("CONCAT(COALESCE(u.surname, ''),' ',COALESCE(u.first_name, ''),' ',COALESCE(u.last_name,'')) as added_by")
                ])
                ->withTrashed()
                ->orderBy('account_transactions.operation_date', 'asc'); // 
                
            if (!empty($start_date) && !empty($end_date)) {
                $accounts->whereBetween(DB::raw('date(operation_date)'), [$start_date, $end_date]);
            }
            
            $debits = 0;
            $credits = 0;
            foreach($accounts->get()->toArray() as $one){
                
                if($one['type'] == "debit"){
                    if($one['at_sub_type'] == "ledger_show" AND $one['sub_type'] == "ledger_show"){
                    }
                    $debits += $one['amount'];
                }elseif($one['type'] == "credit"){
                    $credits += $one['amount'];
                }
            }
            
            
            
            return array("debit" => $debits,"credit" => $credits);
    }
    
    public function getTotals()
    {
        if (request()->ajax()) {
            $start = request()->start;
            $end = request()->end;
            $business_id = request()->session()->get('user.business_id');
            $purchase_details = $this->transactionUtil->getPurchaseTotals($business_id, $start, $end);
            $sell_details = $this->transactionUtil->getSellTotals($business_id, $start, $end);
            $transaction_types = [
                'purchase_return', 'stock_adjustment', 'sell_return'
            ];
            $transaction_totals = $this->transactionUtil->getTransactionTotals(
                $business_id,
                $transaction_types,
                $start,
                $end
            );
            $total_purchase_inc_tax = !empty($purchase_details['total_purchase_inc_tax']) ? $purchase_details['total_purchase_inc_tax'] : 0;
            $total_purchase_return_inc_tax = $transaction_totals['total_purchase_return_inc_tax'];
            $total_adjustment = $transaction_totals['total_adjustment'];
            $total_purchase = $total_purchase_inc_tax - $total_purchase_return_inc_tax - $total_adjustment;
            $output = $purchase_details;
            $output['total_purchase'] = $total_purchase;
            $output['total_purchase_due'] = !empty($allpurchase_details['total_purchase_due']) ? $allpurchase_details['total_purchase_due'] : 0;
            $total_sell_inc_tax = !empty($sell_details['total_sell_inc_tax']) ? $sell_details['total_sell_inc_tax'] : 0;
            $total_sell_return_inc_tax = !empty($transaction_totals['total_sell_return_inc_tax']) ? $transaction_totals['total_sell_return_inc_tax'] : 0;
            $output['total_sell'] = $total_sell_inc_tax - $total_sell_return_inc_tax;
            $output['total_sell_due'] = !empty($allsell_details['total_sell_due']) ? $allsell_details['total_sell_due'] : 0;
            $output['invoice_due'] = $sell_details['invoice_due'];
            return $output;
        }
    }

    /**
     * Retrieves sell products whose available quntity is less than alert quntity.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductStockAlert()
    {
        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');
            $query = VariationLocationDetails::join(
                'product_variations as pv',
                'variation_location_details.product_variation_id',
                '=',
                'pv.id'
            )
                ->join(
                    'variations as v',
                    'variation_location_details.variation_id',
                    '=',
                    'v.id'
                )
                ->join(
                    'products as p',
                    'variation_location_details.product_id',
                    '=',
                    'p.id'
                )
                ->leftjoin(
                    'business_locations as l',
                    'variation_location_details.location_id',
                    '=',
                    'l.id'
                )
                ->leftjoin('units as u', 'p.unit_id', '=', 'u.id')
                ->where('p.business_id', $business_id)
                ->where('p.enable_stock', 1)
                ->where('p.is_inactive', 0)
                ->whereRaw('variation_location_details.qty_available <= p.alert_quantity');
            //Check for permitted locations of a user
            $permitted_locations = auth()->user()->permitted_locations();
            if ($permitted_locations != 'all') {
                $query->whereIn('variation_location_details.location_id', $permitted_locations);
            }
            $products = $query->select(
                'p.name as product',
                'p.type',
                'pv.name as product_variation',
                'v.name as variation',
                'l.name as location',
                'variation_location_details.qty_available as stock',
                'u.short_name as unit'
            )
                ->groupBy('variation_location_details.id')
                ->orderBy('stock', 'asc');
            return Datatables::of($products)
                ->editColumn('product', function ($row) {
                    if ($row->type == 'single') {
                        return $row->product;
                    } else {
                        return $row->product . ' - ' . $row->product_variation . ' - ' . $row->variation;
                    }
                })
                ->editColumn('stock', function ($row) {
                    $stock = $row->stock ? $row->stock : 0;
                    return '<span data-is_quantity="true" class="display_currency" data-currency_symbol=false>' . (float)$stock . '</span> ' . $row->unit;
                })
                ->removeColumn('unit')
                ->removeColumn('type')
                ->removeColumn('product_variation')
                ->removeColumn('variation')
                ->rawColumns([2])
                ->make(false);
        }
    }

    /**
     * Retrieves payment dues for the purchases.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPurchasePaymentDues()
    {
        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');
            $today = \Carbon::now()->format("Y-m-d H:i:s");
            $query = Transaction::join(
                'contacts as c',
                'transactions.contact_id',
                '=',
                'c.id'
            )
                ->leftJoin(
                    'transaction_payments as tp',
                    'transactions.id',
                    '=',
                    'tp.transaction_id'
                )
                ->where('transactions.business_id', $business_id)
                ->where('transactions.type', 'purchase')
                ->where('transactions.payment_status', '!=', 'paid')
                ->whereRaw("DATEDIFF( DATE_ADD( transaction_date, INTERVAL IF(c.pay_term_type = 'days', c.pay_term_number, 30 * c.pay_term_number) DAY), '$today') <= 7");
            //Check for permitted locations of a user
            $permitted_locations = auth()->user()->permitted_locations();
            if ($permitted_locations != 'all') {
                $query->whereIn('transactions.location_id', $permitted_locations);
            }
            $dues = $query->select(
                'transactions.id as id',
                'c.name as supplier',
                'ref_no',
                'final_total',
                DB::raw('SUM(tp.amount) as total_paid')
            )
                ->groupBy('transactions.id');
            return Datatables::of($dues)
                ->addColumn('due', function ($row) {
                    $total_paid = !empty($row->total_paid) ? $row->total_paid : 0;
                    $due = $row->final_total - $total_paid;
                    return '<span class="display_currency" data-currency_symbol="true">' .
                        $due . '</span>';
                })
                ->editColumn('ref_no', function ($row) {
                    if (auth()->user()->can('purchase.view')) {
                        return '<a href="#" data-href="' . action('PurchaseController@show', [$row->id]) . '"
                                    class="btn-modal" data-container=".view_modal">' . $row->ref_no . '</a>';
                    }
                    return $row->ref_no;
                })
                ->removeColumn('id')
                ->removeColumn('final_total')
                ->removeColumn('total_paid')
                ->rawColumns([1, 2])
                ->make(false);
        }
    }

    /**
     * Retrieves payment dues for the purchases.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSalesPaymentDues()
    {
        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');
            $today = \Carbon::now()->format("Y-m-d H:i:s");
            $query = Transaction::join(
                'contacts as c',
                'transactions.contact_id',
                '=',
                'c.id'
            )
                ->leftJoin(
                    'transaction_payments as tp',
                    'transactions.id',
                    '=',
                    'tp.transaction_id'
                )
                ->where('transactions.business_id', $business_id)
                ->where('transactions.type', 'sell')
                ->where('transactions.payment_status', '!=', 'paid')
                ->whereNotNull('transactions.pay_term_number')
                ->whereNotNull('transactions.pay_term_type')
                ->whereRaw("DATEDIFF( DATE_ADD( transaction_date, INTERVAL IF(transactions.pay_term_type = 'days', transactions.pay_term_number, 30 * transactions.pay_term_number) DAY), '$today') <= 7");
            //Check for permitted locations of a user
            $permitted_locations = auth()->user()->permitted_locations();
            if ($permitted_locations != 'all') {
                $query->whereIn('transactions.location_id', $permitted_locations);
            }
            $dues = $query->select(
                'transactions.id as id',
                'c.name as customer',
                'transactions.invoice_no',
                'final_total',
                DB::raw('SUM(tp.amount) as total_paid')
            )
                ->groupBy('transactions.id');
            return Datatables::of($dues)
                ->addColumn('due', function ($row) {
                    $total_paid = !empty($row->total_paid) ? $row->total_paid : 0;
                    $due = $row->final_total - $total_paid;
                    return '<span class="display_currency" data-currency_symbol="true">' .
                        $due . '</span>';
                })
                ->editColumn('invoice_no', function ($row) {
                    if (auth()->user()->can('sell.view')) {
                        return '<a href="#" data-href="' . action('SellController@show', [$row->id]) . '"
                                    class="btn-modal" data-container=".view_modal">' . $row->invoice_no . '</a>';
                    }
                    return $row->invoice_no;
                })
                ->removeColumn('id')
                ->removeColumn('final_total')
                ->removeColumn('total_paid')
                ->rawColumns([1, 2])
                ->make(false);
        }
    }

    public function loadMoreNotifications()
    {
        $notifications = auth()->user()->notifications()->orderBy('created_at', 'DESC')->paginate(10);
        if (request()->input('page') == 1) {
            auth()->user()->unreadNotifications->markAsRead();
        }
        $notifications_data = [];
        foreach ($notifications as $notification) {
            $data = $notification->data;
            if (in_array($notification->type, [\App\Notifications\RecurringInvoiceNotification::class])) {
                $msg = '';
                $icon_class = '';
                $link = '';
                if (
                    $notification->type ==
                    \App\Notifications\RecurringInvoiceNotification::class
                ) {
                    $msg = !empty($data['invoice_status']) && $data['invoice_status'] == 'draft' ?
                        __(
                            'lang_v1.recurring_invoice_error_message',
                            ['product_name' => $data['out_of_stock_product'], 'subscription_no' => !empty($data['subscription_no']) ? $data['subscription_no'] : '']
                        ) :
                        __(
                            'lang_v1.recurring_invoice_message',
                            ['invoice_no' => !empty($data['invoice_no']) ? $data['invoice_no'] : '', 'subscription_no' => !empty($data['subscription_no']) ? $data['subscription_no'] : '']
                        );
                    $icon_class = !empty($data['invoice_status']) && $data['invoice_status'] == 'draft' ? "fa fa-exclamation-triangle text-warning" : "fa fa-recycle text-green";
                    $link = action('SellPosController@listSubscriptions');
                }
                $notifications_data[] = [
                    'msg' => $msg,
                    'icon_class' => $icon_class,
                    'link' => $link,
                    'read_at' => $notification->read_at,
                    'created_at' => $notification->created_at->diffForHumans()
                ];
            } else {
                $module_notification_data = $this->moduleUtil->getModuleData('parse_notification', $notification);
                if (!empty($module_notification_data)) {
                    foreach ($module_notification_data as $module_data) {
                        if (!empty($module_data)) {
                            $notifications_data[] = $module_data;
                        }
                    }
                }
            }
        }
        return view('layouts.partials.notification_list', compact('notifications_data'));
    }

    private function __chartOptions($title)
    {
        return [
            'yAxis' => [
                'title' => [
                    'text' => $title
                ]
            ],
            'legend' => [
                'align' => 'right',
                'verticalAlign' => 'top',
                'floating' => true,
                'layout' => 'vertical'
            ],
        ];
    }

    public function loginPayroll(Request $request)
    {
        $connection = DB::connection('mysql2');
        $users = $connection->select("SELECT id,business_id FROM users WHERE email='" . \Auth::user()->email . "'");
        if (!empty($users)) {
            $user_id = $users[0]->id;
        } else {
            $user_id = $connection->table('users')->insertGetId([
                'email' => \Auth::user()->email,
                'first_name' => \Auth::user()->first_name,
                'last_name' => \Auth::user()->last_name,
                'password' => \Auth::user()->password,
                'status_id' => 1,
                'is_in_employee' => 1,
                'business_id' => \Auth::user()->business_id,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
            if ($user_id) {
                if (\Auth::user()->getRoleNameAttribute() == "Admin") {
                    $userRole = $connection->table('role_user')->insert([
                        'user_id' => $user_id,
                        'role_id' => 1,
                    ]);
                } else {
                    $userRole = $connection->table('role_user')->insert([
                        'user_id' => $user_id,
                        'role_id' => 4,
                    ]);
                }
            }
        }
        return response()->json(['login_url' => env('PAYROLL_LOGIN') . "/" . base64_encode($user_id)]);
    }
}
