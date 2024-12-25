<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\MyController;

class LeaveTypeStatus extends Command
{
    protected $signature = 'cron:status-job';
    protected $description = 'Run the Status cron job';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $controller = new \App\Http\Controllers\Admin\LeaveTypeController();
        $controller->leaveTypeStatusChange(); 

        $this->info('Status cron job executed successfully.');
    }
}

