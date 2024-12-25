<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider; 
use Illuminate\Support\Facades\View;
use App\Models\LeaveRequest; 
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{

    
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
       
        
        // $employee_id = auth('web')->user(); 
        // echo '<pre>';print_r($employee_id);die;

        // View::composer('*', function ($view) { 

        //     $employee_id =  Auth::guard('web')->user()->id; 
        //     // $employee_id =  1; 
           
        //     $pendingRequest = LeaveRequest::with('employee','leaveType')->where('is_leave',0)->whereHas('employee', function ($query) use($employee_id){
        //                     $query->where('reporting_to', $employee_id);
        //                    })->get();  
        //     $leaveRequests =LeaveRequest::with('employee','leaveType')->whereHas('employee', function ($query) use($employee_id){
        //                     $query->where('reporting_to', $employee_id);
        //                    })->get();  

        //     $view->with([
        //         'employee_id' => $employee_id,
        //         'pendingRequest' => $pendingRequest, 
        //         'leaveRequests' => $leaveRequests, 
        //     ]);
        // }); 
    }
}
