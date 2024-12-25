<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\User;
use App\Models\LeaveType;
use App\Models\EmployeeLeaveHistory;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class CronExpireCarryOverLeaveCron extends BaseController
{
    
    public function index()
    { 
        $sessions = Session::where('is_default', 1)->first();
        $employeesLeaves = EmployeeLeaveHistory::where('session_id',$sessions->id)->where('carried_over_is_expire',1)->get();
        foreach($employeesLeaves as $employeesLeave){
          $emplyeeshistories = EmployeeLeaveHistory::where('id',$employeesLeave->id)->first();
          $carriedOverExpire = $employeesLeave->carried_over_expire;
          $expireDate = Carbon::parse($carriedOverExpire);
          $currentDate = Carbon::now();
          if ($currentDate->equalTo($expireDate)) {  
               $emplyeeshistories->carried_over_leave_active = 1;          
               $emplyeeshistories->carried_over_leave = 0;
               $emplyeeshistories->save();
          }          
        }
        
    }                     
       
    

}



