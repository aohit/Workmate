<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('demo:cron')->everyMinute();
       
        $schedule->command('cron:second-job')->everyMinute();

        $schedule->command('cron:status-job')->everyMinute();

        $schedule->command('cron:accumulate-leave')->everyMinute();

        $schedule->command('cron:carryover-leave-job')->everyMinute();

        $schedule->command('cron:carryover-expire-leave-job')->everyMinute();

        $schedule->command('cron:appraisal-reminder')->everyMinute(); 

        $schedule->command('cron:manager-appraisal-reminder')->everyMinute(); 

        $schedule->command('cron:appraisal-overdue')->everyMinute(); 

        $schedule->command('cron:manager-appraisal-overdue')->everyMinute(); 
        
        $schedule->command('cron:goalreview-dataupdate-job')->everyMinute(); 

        // $schedule->command('cron:appraisal-ratingupdate')->everyMinute(); 
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
