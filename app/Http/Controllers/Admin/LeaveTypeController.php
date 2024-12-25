<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeLeaveHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\LeaveType; 
use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash; 
use DataTables;
use DB;

class LeaveTypeController extends Controller
{
   
     public function index(): View
        { 
           
            $data['title'] = 'Leave Type';
            $data['sub_title'] = 'Leave Type List'; 
            return view('admin.leave-type.index',$data);
        }
 
        public function list(Request $request)
        { 
            
            if ($request->ajax()) {
    
                
                    $data = LeaveType::get(); 
              
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('type', function($row){
                            $type =  $row->type;
                            return $type;
                        })

                        ->addColumn('color_code', function($row){
                            $color_code = '<span class="" style="display: block; border: 1px solid; border-radius: 50%; width: 25px; height: 25px; background-color: ' . $row->color_code . ';"></span>';
                            return $color_code;
                        }) 
                        ->addColumn('leave_days', function($row){
                            $leave_days = $row->leave_days . ' Days';
                            return $leave_days;
                        })  

                        ->addColumn('status', function($row){ 
 
                            $statusUrl = route('admin.leavetype.status'); 
                            if($row->status == 1){
                                $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",0) class="btn-sm btn btn-success waves-effect waves-light">Active</button>';
                            }else{
                                $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",1) class="btn-sm btn btn-outline-danger waves-effect waves-light">Inactive</button>';
                            }
                             
                            return $status;
                        })

                        ->addColumn('action', function($row){ 

                            $editUrl = route('admin.leavetype.update');
                            $action =  '<button type="button" onclick = editForm(this,"'.$row->id.'","'. $editUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;';

                            $deleteUrl = route('admin.leavetype.delete');
                            // $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="d-none btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
                            $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
                            return $action;
                        })
                       
                        ->rawColumns(['type','status','action','color_code','leave_days'])
                        ->make(true);
            }
        }

        public function create(): View
        {  
            $data['title'] = 'Leave Type';
            $data['sub_title'] = 'Create';  
            return view('admin.leave-type.create',$data); 
        }

        public function update(Request $request): View
        {  
            $data['title'] = 'Leave Type';
            $data['sub_title'] = 'Update';  
            $data['uinfo'] = LeaveType::find($request->id);   
            return view('admin.leave-type.update',$data); 
        }

        public function store(Request $request)
        {
            if($request->id){
                $leaveDay = $request->leave_day;
               $totalhours = $leaveDay*480;
               $daysInHours = $leaveDay*8;
               
                request()->validate([
                    'name' => 'required',
                    'status' => 'required', 
                    'color' => 'required', 
                    'leave_day' => 'required',  
                    'allow_exceed' => 'required', 
                    ]);
                    $datas = LeaveType::find($request->id); 
                    $data = LeaveType::find($request->id); 
                    
                   
                        $data->update([
                            'type' => ucfirst($request->name),    
                            'status' => $request->status,
                            'color_code' => $request->color, 
                            'leave_days' => $request->leave_day, 
                            'days_in_minutes' => $totalhours,
                            'days_in_hours' => $daysInHours,
                            'leave_accurals' => $request->leave_accurals,
                            'carry_over_days' => $request->carry_over_days,
                            'expire_after' => $request->type, 
                            'expire_number' => $request->days_or_month, 
                            'is_exceed' => $request->allow_exceed, 
                        ]);
                        if($datas->status == 1  || $request->status == 1){
                            $this->leaveTypeStatusChange();
                        }
                        // $leaveStatus = LeaveType::find($request->id);
                    
                        // $this->leaveHistoryCron($data);

                return response()->json([
                    'success'=> 1,
                    'message'=>"Leave Type Updated successfully."
                ]);
               
            }else{
                request()->validate([
                    'name' => 'required',
                    'color' => 'required',
                    'leave_day' => 'required',  
                    'allow_exceed' => 'required',  
                ]);
                $leaveDay = $request->leave_day;
                $totalhours = $leaveDay*480;
                $daysInHours = $leaveDay*8;
    
                $data = LeaveType::create([
                    'type' => ucfirst($request->name), 
                    'status' => $request->status,
                    'color_code' => $request->color,
                    'leave_days' => $request->leave_day,
                    'days_in_minutes' => $totalhours,
                    'days_in_hours' => $daysInHours,
                    'leave_accurals' => $request->leave_accurals,
                    'carry_over_days' => $request->carry_over_days,
                    'expire_after' => $request->type,
                    'expire_number' => $request->days_or_month,
                    'is_exceed' => $request->allow_exceed,
                ]);
                // $id = $data->id;
                // $this->leaveHistoryCron($data);

                return response()->json([
                    'success'=> 1,
                    'message'=>"Leave Type created successfully."
                ]);
            }
           
        }

    //   public function leaveHistoryCron($data)
    //    { 
    //     // $lastLeaveType = LeaveType::get()->latest();
    //     $lastLeaveType = LeaveType::where('id',$data->id)->latest()->first();
    //         $users = User::get();
    //             foreach($users as $user){
    //                 $existingLeaveHistory = EmployeeLeaveHistory::where('employee_id',$user->id)->where('leave_type_id',$data->id)->exists();
    //                 if (!$existingLeaveHistory) {
    //                 EmployeeLeaveHistory::create([
    //                     'employee_id' => $user->id,
    //                     'leave_type_id' => $lastLeaveType->id,
    //                     'total_leave_days' => $lastLeaveType->leave_days,
    //                     'booked' => 0,
    //                     'remaining' => $lastLeaveType->leave_days,
    //                 ]); 
    //             }
    //         }
    //             // $this->leaveHistoryData($data);
    //     } 

      public function leaveHistoryCron($data)
      { 
        $lastLeaveTypes = LeaveType::where('status',1)->get();
        foreach($lastLeaveTypes as $lastLeaveType){
            $users = User::get();
                foreach($users as $user){
                    $existingLeaveHistory = EmployeeLeaveHistory::where('employee_id',$user->id)->where('leave_type_id',$lastLeaveType->id)->exists();
                    if (!$existingLeaveHistory) {
                        if($lastLeaveType->status == 1){
                    EmployeeLeaveHistory::create([
                        'employee_id' => $user->id,
                        'leave_type_id' => $lastLeaveType->id,
                        'total_leave_days' => $lastLeaveType->leave_days,
                        'booked' => 0,
                        'remaining' => $lastLeaveType->leave_days,
                    ]); 
                }
            }
            }
        }
    } 

        public function leaveHistoryData($parameter = null)
        { 
            $lastLeaveTypes = LeaveType::where('status' , 1)->get();
            foreach($lastLeaveTypes as $lastLeaveType){
                $users = User::get();
                foreach($users as $user){
                    $existingLeaveHistory = EmployeeLeaveHistory::where('employee_id',$user->id)->where('leave_type_id',$lastLeaveType->id)->exists();

                    if (!$existingLeaveHistory) {
                        
                    EmployeeLeaveHistory::Create([
                        'employee_id' => $user->id,
                        'leave_type_id' => $lastLeaveType->id,
                        'total_leave_days' => $lastLeaveType->leave_days,
                        'booked' => 0,
                        'remaining' => $lastLeaveType->leave_days,
                    ]); 
                }else{
                    $data = EmployeeLeaveHistory::where('employee_id',$user->id)->where('leave_type_id',$lastLeaveType->id)->first(); 
                        $data->update([
                        'employee_id' => $user->id,
                        'leave_type_id' => $lastLeaveType->id,
                        'total_leave_days' => $lastLeaveType->leave_days,
                        'booked' => 0,
                        'remaining' => $lastLeaveType->leave_days,
                    ]); 
                }
            }
          }
        } 

        public function leaveTypeStatusChange()
        { 
            $lastLeaveTypes = LeaveType::where('status' , 1)->get();
            foreach($lastLeaveTypes as $lastLeaveType){
                $users = User::get();
                foreach($users as $user){
                    $existingLeaveHistory = EmployeeLeaveHistory::where('employee_id',$user->id)->where('leave_type_id',$lastLeaveType->id)->exists();
                    
                    // echo "<pre>";print_r($existingLeaveHistory->toArray());die;
                    if (!$existingLeaveHistory) {
                    EmployeeLeaveHistory::Create( [
                        'employee_id' => $user->id,
                        'leave_type_id' => $lastLeaveType->id,
                        'total_leave_days' => $lastLeaveType->leave_days,
                        // 'booked' => 0,
                        // 'remaining' => $lastLeaveType->leave_days,
                    ]); 
                }
            }
          }
        } 

        public function destroy(Request $request)
        {
           
            $data = LeaveType::find($request->id); 
            $data->delete();
            $LeaveRequest = EmployeeLeaveHistory::where('leave_type_id',$request->id)->delete();

            return response()->json([
                'success'=> 1,
                'message'=>"Leave Type deleted successfully."
            ]);
         
          
        }

        public function status(Request $request)
        {
           
            $data = LeaveType::find($request->id); 
            $data->status = $request->status;
            $data->save(); 
            $this->leaveHistoryCron($data);
            return response()->json([
                'success'=> 1,
                'message'=>"Leave Type status changed successfully."
            ]);
          
        }

        public function carriedOverRemainingLeave()
        { 
              $users = User::get();
              $currentYear = date('Y');
              $remainingData = 0;
              foreach($users as $user){
                if ($user->carried_over_leave_year == $currentYear) {
                    continue; 
                }
                  $remainingLeaves = EmployeeLeaveHistory::where('employee_id',$user->id)->sum('remaining');
                  
                    $userData = User::where('id', $user->id)->first();
                    $userData->update([
                              'carried_over_leave' => $remainingLeaves,
                              'carried_over_leave_year' => $currentYear,
                            ]);
                } 
        }

      
}