<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\MyController;

class CarryOverLeaveCron extends Command
{
    protected $signature = 'cron:carryover-leave-job';
    protected $description = 'Run the remaining leave cron job';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $controller = new \App\Http\Controllers\Admin\LeaveTypeController();
        $controller->carriedOverRemainingLeave(); 

        $this->info('Status cron job executed successfully.');
    }
}

