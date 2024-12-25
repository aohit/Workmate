<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\MyController;

class AppraisalRatingUpdateCron extends Command
{
    protected $signature = 'cron:appraisal-ratingupdate';
    protected $description = 'Run the carried over expiry leave cron job';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $controller = new \App\Http\Controllers\User\AppraisalController();
        $controller->AppraisalRatingData(); 

        $this->info('cron job executed successfully.');
    }
}

