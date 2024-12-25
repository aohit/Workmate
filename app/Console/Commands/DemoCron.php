<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Log;

class DemoCron extends Command
{
    /**

     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';
    protected $description = 'Command description';
    /**

     * Execute the console command.

     */

     public function handle(): void
     {
        //  info("Cron Job running at " . now());
        $controller = new \App\Http\Controllers\Admin\LeaveTypeController();
        $controller->leaveHistoryData($parameter = null);
        info('Controller function executed successfully.');
     }

}