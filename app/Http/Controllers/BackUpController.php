<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Storage;
use Log;
use Modules\Superadmin\Entities\Subscription;
use Modules\Superadmin\Entities\Package;
use Carbon\Carbon;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Sarfraznawaz2005\BackupManager\Facades\BackupManager;
class BackUpController extends Controller
{
    /**
     * All Utils instance.
     *
     */
    protected $commonUtil;

    public function __construct(Util $commonUtil)
    {
        $this->commonUtil = $commonUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('backup')) {
            abort(403, 'Unauthorized action.');
        }
        
        
        $business_id = request()->session()->get('user.business_id');
        $subscription = Subscription::active_subscription($business_id);
        $cron_job_command = $this->commonUtil->getCronJobCommand();
        $backups = BackupManager::getBackups();
        return view("backup.index")
            ->with(compact('backups', 'cron_job_command'));
    }
    
    public function cronBackup(){
        $result = BackupManager::cron_backupDatabase();
    }

    /**
     * Create a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         set_time_limit(-1);
   
        if (!auth()->user()->can('backup')) {
            abort(403, 'Unauthorized action.');
        }

        //Disable in demo
        $notAllowed = $this->commonUtil->notAllowedInDemo();
        if (!empty($notAllowed)) {
            return $notAllowed;
        }
        $business_id = request()->session()->get('user.business_id');
        $subscription = Subscription::active_subscription($business_id);
        
        if($subscription){}
        $result = BackupManager::createBackup();
        $message = 'Files Backup Failed';
        $messages[] = [
                    'success' => 0,
                    'msg' => $message
                ];
        if ($result['f'] === true) {
            $message = 'Files Backup Taken Successfully';
            $messages[] = ['success' => 1,
                'msg' => __('lang_v1.success')
            ];
        } 
        return back()->with('status', $messages);
    }

    /**
     * Downloads a backup zip file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function download($file)
    {
        if (!auth()->user()->can('backup')) {
            abort(403, 'Unauthorized action.');
        } 
        
        $filename = $file;

        $path = config('backupmanager.backups.backup_path') . DIRECTORY_SEPARATOR . $file;

        $file = Storage::disk(config('backupmanager.backups.disk'))->path('') . $path;
        
       
        $headers = array('Content-Type: application/gzip');
        $response = response()->download($file,$filename,$headers);
        ob_end_clean();
        return $response;

    }
    
    public function restore($file)
    {
        if (!auth()->user()->can('backup')) {
            abort(403, 'Unauthorized action.');
        }

        $result = BackupManager::restoreBackups([$file]);
        
        if ($result[0]['d'] === true) {
            $message = 'Restored Successfully';
            $messages[] = ['success' => 1,
                'msg' => __('lang_v1.success')
            ];
        } 
        return back()->with('status', $messages);
    }

    /**
     * Deletes a backup file.
     */
    public function delete($file)
    {
        
        if (!auth()->user()->can('backup')) {
            abort(403, 'Unauthorized action.');
        }
        $results = BackupManager::deleteBackups(array($file));
        return redirect()->back();
    }
    function store(Request $request)
    {
        $uploadedFile = $request->file('backup');
        
        $backups = BackupManager::getBackups();
        
        $backupsNames = collect($backups)->pluck('name')->toArray();
        
        $backupSuffix = date(strtolower(config('backupmanager.backups.backup_file_date_suffix')));
        
        foreach($backupsNames as $backup){
            if(explode('.',$backup)[sizeof(explode('.',$backup))-1] == $uploadedFile->getClientOriginalExtension()){
                BackupManager::deleteBackups(array($backup));
            }
        }
        
        
        if($uploadedFile->getClientOriginalExtension() == 'tar'){
            $filename = "f_$backupSuffix.tar";
        }elseif($uploadedFile->getClientOriginalExtension() == 'gz'){
            $filename = "d_$backupSuffix.gz";
        }else{
            $filename = "d_$backupSuffix.$uploadedFile->getClientOriginalExtension()";
        }
        
        Storage::disk(config('backupmanager.backups.disk'))->putFileAs(
            config('backupmanager.backups.backup_path'),
            $uploadedFile,
            $filename
        );
        $message = 'Files Backup Upload Successfully';
        $messages[] = ['success' => 1,
            'msg' => __('lang_v1.success')
        ];
        return back()->with('status', $messages);
    }
         
    
}
