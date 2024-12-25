<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Models\UploadFile;  
use App\Models\Holiday;
use App\Models\Department; 
use App\Models\User;
use App\Models\EmployeeLeaveHistory;
use Illuminate\Support\Facades\Hash; 
use DataTables;
use Validator;
use Carbon\Carbon;

class EmployeeLeaveController extends Controller
{
    /**
     * Display the login view.
     */

     function __construct()
     {
       
     }

    public function index(): View
    { 
        $data['title'] = 'Employee Leave Report ';
        $managerId =  Auth::guard('web')->user()->id;
        $data['departments'] = User::where('manager_id',$managerId)->orderBy('name', 'asc')->get();
        return view('user.employeeleave.index', $data); 
    }
 
     
    public function leaveProfileTab(Request $request)
    { 
        $data['title'] = 'Employee Leave Report';
        $data['team'] =  User::with('department','reportingTo','manager','Image','county')->whereId($request->id)->first();
        $view = view('user.employeeleave.components.profile', $data)->render(); 
        return response()->json([
              'success'=> 1, 
              'view' => $view
        ]); 
    }
        
       
        public function leaveTypeTab(Request $request)
        { 
            if ($request->ajax()) {
                $data['department_id'] = $request->id;
                $dep_id = $request->id;
               $managerId =  Auth::guard('web')->user()->id;
                $data['teams'] = $users = EmployeeLeaveHistory::with('leaveType','employeeId')->where('leave_type_id',$request->id)->get(); 
                $data['users'] = EmployeeLeaveHistory::with('leaveType', 'employeeId')
                        ->where('employee_id', $dep_id)
                        ->whereHas('employeeId', function ($query) use ($managerId) {
                            $query->where('manager_id', $managerId);
                        })->get();
            // echo "<pre>";print_r( $users->count());die;
                        if($users){
                            $i=1;
                            $user_id = 1;
                            foreach($users as $val){
                                if($i==1){
                                    $user_id = $val->id;
                                }
                                $i++;
                            }
                            $data['user_id'] = $user_id;
                            
                    $view = view('user.employeeleave.components.tabs', $data)->render();  
                    return response()->json([
                        'success'=> 1, 
                        'view' => $view
                    ]);
                }else{
                    return response()->json([
                        'success'=> 0, 
                        'view' => 'Not Found'
                    ]);
                }
                
            }
        }

        
            
}