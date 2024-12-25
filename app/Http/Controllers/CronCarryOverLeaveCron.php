<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\User;
use App\Models\LeaveType;
use App\Models\EmployeeLeaveHistory;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class CronCarryOverLeaveCron extends BaseController
{
    
    public function index()
    { 
        $sessions = Session::where('is_default', 1)->first();

        $users = User::where('session_id','!=',$sessions->id)->get();
        $currentYear = date('Y');
        $remainingData = 0;
        foreach($users as $user){
          if ($user->carried_over_leave_year == $currentYear) {
              continue; 
          }
           $lastLeaveType = LeaveType::where('is_checked',1)->first();
          // echo '<pre>'; print_r($lastLeaveType);die;
            
          $totalAccumulatedLeave = \App\Models\AccumulatedLeave::where('employee_id', $user->id)
          ->sum('accumulated_leave');
            
              $userData = User::where('id', $user->id)->first();
              $carried_over_leave = $userData->total_accumulated_leave - $userData->total_used;
              $carried_over_is_expire = 1;
              if($carried_over_leave == 0){
                $carried_over_is_expire = 0;
              }
              $total_leave = $user->total_accumulated_leave + $user->carried_over_leave;
              $total_reamining = $user->total_accumulated_leave - $user->total_used;
              $userData->update([
                        'carried_over_leave' => $carried_over_leave,
                        'session_id' => $sessions->id,
                       
                      ]);
          } 
        
    }                     
       
    

}



