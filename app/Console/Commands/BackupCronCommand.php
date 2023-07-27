<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Http\Controllers\BackUpController;

use App\Utils\Util;

class BackupCronCommand extends Command
{
    protected $signature = 'backup:cron';

    protected $description = 'Run backup cron job';

    public function handle() : void
    {
        $util = new Util();
        $backupController = new BackUpController($util);
        $backupController->cronBackup();
        $this->info('Backup cron job executed successfully.');
    }
    
}
