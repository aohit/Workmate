<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\User;

class CronAnnualLeave extends BaseController
{
    
    public function index()
    { 
        $users = User::where('id',25)->get();
        $sessions = Session::where('is_default', 1)->first();
       
        foreach ($users as $user) {
            $leaveEntryExists = \App\Models\AccumulatedLeave::where('employee_id', $user->id)
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->exists();
    
            $hours = 1.75*8;
            $minutes = 1.75*480;
            if (!$leaveEntryExists) {
               
                \App\Models\AccumulatedLeave::create([
                    'employee_id' => $user->id,
                    'accumulated_leave' => 1.75,
                    'accumulate_leave_hours' => $hours,
                    'accumulate_leave_minutes' => $minutes,
                    'leave_type_id' => 1,
                    'session_id' => $sessions->id,
                    // 'accumulate_leave_minutes' => now()->year,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);        
            }

            $totalAccumulatedLeave = \App\Models\AccumulatedLeave::where('employee_id', $user->id)
            ->sum('accumulated_leave');
           
            
            // echo $total_leave;die;
            $user->update([
                'total_accumulated_leave' => $totalAccumulatedLeave
            ]);


            // $employeehistory = EmployeeLeaveHistory::where('employee_id',$user->id)->where('leave_type_id',1)->first()
            // $total_leave = $user->total_accumulated_leave + $user->carried_over_leave;
            // $total_reamining = $user->total_accumulated_leave - $user->total_used;
            // $employeehistory->update([
            //     'total_leave' => $total_leave,
            //     'total_used' => 0,
            //     'total_reamining' => $total_reamining,
            // ]);
        }
        
    }                     
       
    

}



