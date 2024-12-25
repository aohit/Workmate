<?php

namespace App\Console\Commands;

use App\Mail\EmpAppraisalReminderMail;
use App\Models\Appraisal;
use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AppraisalMailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:appraisal-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send appraisal reminder emails to users';
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
        
        $users = Appraisal::with('User','Manager','reviewcycle')->where('self_review',0)->where('self_review_deadline','=', $oneDayBefore)
                 ->get();
        $userID = '';
        foreach ($users as $user) {
            $usersData = Appraisal::with('User','Manager','reviewcycle')->where('user_id','=', $user->user_id)
                 ->first();

            Mail::to($usersData->User?->email)->send(new EmpAppraisalReminderMail($usersData));
            $this->info(string: "Reminder sent to: " . $usersData->User?->email);
        }
    }

}






 

   
  

