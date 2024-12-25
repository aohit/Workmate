<?php

namespace App\Console\Commands;

use App\Mail\EmpAppraisalReminderMail;
use App\Mail\ManagerAppraisalReminderMail;
use App\Models\Appraisal;
use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class ManagerAppraisalMailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:manager-appraisal-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send appraisal reminder emails to Manager';
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $oneDayBefore = Carbon::now()->addDay()->toDateTimeString();
        $oneDayBefore = Carbon::now()->addDay()->format('Y-m-d');
        
        $users = Appraisal::with('User','Manager','reviewcycle')->where('self_review',1)->where('manager_review',0)->where('manager_review_deadlin','=', $oneDayBefore)
                 ->get();
        $userID = '';
        foreach ($users as $user) {
            $usersData = Appraisal::with('User','Manager','reviewcycle')->where('manager_id', $user->manager_id)
                 ->first();

            Mail::to($usersData->Manager?->email)->send(new ManagerAppraisalReminderMail($usersData));
            $this->info(string: "Reminder sent to: " . $usersData->Manager?->email);
        }
         \Log::info($usersData);
    }

}






 

   
  

