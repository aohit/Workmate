<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\EmployeeLeaveHistory;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;


class CronNewLeaveHistory extends BaseController
{
    
    public function index()
    { 
        $sessions = Session::where('is_default', 1)->first();

        $lastLeaveTypes = LeaveType::where('status',1)->get();
        foreach($lastLeaveTypes as $lastLeaveType){
            $users = User::get();
                foreach($users as $user){
                    $existingLeaveHistory = EmployeeLeaveHistory::where('employee_id',$user->id)->where('leave_type_id',$lastLeaveType->id)->exists();
                    if (!$existingLeaveHistory) {
                        if($lastLeaveType->status == 1){
                            $carried_over_is_expire = 1;
                            $carried_over_expire = '';
                            if($lastLeaveType->expire_after == 0){
                                $carried_over_is_expire = 0;
                            }
                            if($lastLeaveType->expire_after == 1){           
                                $startDateString = \DateTime::createFromFormat('m-Y', $sessions->end_year)->format('Y-m-d');                               
                                $startDate = Carbon::createFromFormat('Y-m-d', $startDateString);
                                $endDate = $startDate->addDays($lastLeaveType->expire_number);
                                $carried_over_expire = $endDate->toDateString();
                            }elseif($lastLeaveType->expire_after == 2){
                                $startDateString = \DateTime::createFromFormat('m-Y', $sessions->end_year)->format('Y-m-d');                               
                                $startDate = Carbon::createFromFormat('Y-m-d', $startDateString);
                                $endDate = $startDate->addMonths($lastLeaveType->expire_number);
                                $carried_over_expire = $endDate->toDateString();

                            }



                    $accumulated_leave = 1.75*date('m');
                    EmployeeLeaveHistory::create([
                        'employee_id' => $user->id,
                        'leave_type_id' => $lastLeaveType->id,
                        'total_leave_days' => $lastLeaveType->leave_days,
                        'booked' => 0,
                        'remaining' => $lastLeaveType->leave_days,
                        'accumulated_leave' => $accumulated_leave,
                        'session_id' => $sessions->id,
                        'carried_over_leave' => abs($lastLeaveType->leave_days - 0),
                        'carried_over_expire' => $carried_over_expire,
                        'carried_over_is_expire' => $carried_over_is_expire,
                    ]); 
                }
            }
            }
        
    }                     
}   
    

}



