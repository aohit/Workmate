<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\MyController;

class NewLeaveHistory extends Command
{
    protected $signature = 'cron:second-job';
    protected $description = 'Run the second cron job';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $controller = new \App\Http\Controllers\Admin\LeaveTypeController();
        $controller->leaveHistoryCron($parameter = null); // Controller ka doosra function call karein

        $this->info('Second cron job executed successfully.');
    }

}

