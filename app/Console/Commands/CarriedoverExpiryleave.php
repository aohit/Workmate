<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\MyController;

class CarriedoverExpiryleave extends Command
{
    protected $signature = 'cron:carryover-expire-leave-job';
    protected $description = 'Run the carried over expiry leave cron job';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $controller = new \App\Http\Controllers\Admin\LeaveTypeController();
        $controller->carriedOverExpiryLeave(); 

        $this->info('Status cron job executed successfully.');
    }
}

