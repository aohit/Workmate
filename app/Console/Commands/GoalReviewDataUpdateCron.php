<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\MyController;

class GoalReviewDataUpdateCron extends Command
{
    protected $signature = 'cron:goalreview-dataupdate-job';
    protected $description = 'Run the carried over expiry leave cron job';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $controller = new \App\Http\Controllers\User\GoalReviewController();
        $controller->goalReviewDataUpdate(); 

        $this->info('Status cron job executed successfully.');
    }
}

