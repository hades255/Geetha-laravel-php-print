<?php

namespace App\Console\Commands;

use App\AdPage;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class AddAdPageRecordCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add_ad_pages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $arr = ['Purchase Add Page', 'Petro Settlement Page', 'Patient Page'];
        foreach ($arr as $key => $value) {
            AdPage::create([
                'name' => $value,
                'code' => Str::slug($value, '_')
            ]);
        }
    }
}
