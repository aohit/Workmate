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
use App\Models\LeaveSchedule; 
use App\Models\User;
use App\Models\EmployeeLeaveHistory;
use Illuminate\Support\Facades\Hash; 
use DataTables;
use Validator;
use Carbon\Carbon;

class LeaveController extends Controller
{
    /**
     * Display the login view.
     */

     function __construct()
     {
       
     }

     public function index(): View
        { 
        
            $data['title'] = 'My Team Leave';
            $data['sub_title'] = 'My Leave List';
            $data['leave'] = LeaveRequest::get();
            return view('user.leave.index',$data);
        }
 
        public function list(Request $request)
        { 
             
            if ($request->ajax()) {
                if(auth('web')->user()->hasPermissionTo('manager-leave')){
                    $data = LeaveRequest::with(['user'])->orderBy('id','asc') 
                    ->whereHas('user', function ($query) {
                        $query->where('manager_id', Auth::guard('web')->user()->id);
                    })->get();   
                } else{
                    $data = LeaveRequest::orderBy('id','asc')->get(); 
                } 
               
             
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('employee', function($row){
                            if($row->employee_id){
                                $name =  ucwords($row->user->name);
                            }else{
                                $name =  '-';
                            }
                              
                            return $name;
                        })
                        ->addColumn('leave_type', function($row){

                            if($row->leave_type){
                                $leaveType =  $row->leaveType->type;
                            }else{
                                $leaveType =  '-';
                            }
                             
                            return $leaveType;
                        })
                        ->addColumn('status', function($row){
 
                            if($row->is_leave == 0){
                                $is_leave =  '<span class="badge rounded-pill bg-primary">Pending</span>';
                            }elseif($row->is_leave == 1){
                                $is_leave =  '<span class="badge rounded-pill bg-success">Approved</span>';
                            }else{
                                $is_leave =  '<span class="badge rounded-pill bg-danger">Rejected</span>';
                            }
 
                            return $is_leave;
                        })

                        ->addColumn('start_date', function($row){

                            if($row->start_date){
                                $start_date =  date('d-M-Y',strtotime($row->start_date));
                            }else{
                                $start_date =  '-';
                            } 
                            return $start_date;
                        })

                        ->addColumn('end_date', function($row){

                            if($row->end_date){
                                $end_date =  date('d-M-Y',strtotime($row->end_date));
                            }else{
                                $end_date =  '-';
                            } 
                            return $end_date;
                        })

                        ->addColumn('action', function($row){ 

                            if($row->is_leave == 0){   
                               
                                $editUrl = 'leave/update/'.$row->id; 
                                $action =  "<a href='". $editUrl ."'  class='btn-sm btn btn-outline-dark waves-effect waves-light mr-1'>Edit</a>&nbsp;&nbsp;&nbsp;";
                               
                           
                        }elseif($row->is_leave == 1){ 
                                $msg = "You can not update approved leave.";
                                $action =  '';  
                        }else{
                            $msg = "You can not update rejected leave.";
                            $action =  '<button type="button" onclick = "rejectView(`'.$row->id.'`)" class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Comment</button>&nbsp;&nbsp;&nbsp;'; 
                        }
                           
                            //     $editUrl = 'leave/update/'.$row->id; 
                            // $action =  "<a href='". $editUrl ."'  class='btn btn-outline-dark waves-effect waves-light mr-1'>Edit</a>&nbsp;&nbsp;&nbsp;";
                            
                            //     $deleteUrl = route('leave.delete');
                            //     $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="btn btn-outline-danger waves-effect waves-light">Delete</button>';
                          
                            if (auth('web')->user()->hasPermissionTo('view-team-leave')){
                                $action .=  '<button type="button"  onclick="viewLeaveRequest(`'.$row->id.'`);return;false;" class="btn-sm btn btn-outline-warning waves-effect waves-light mr-1">View</button>&nbsp;&nbsp;&nbsp;';
                                }
    

                            return $action;
                        })
                       
                        ->rawColumns(['employee','leave_type','start_date','end_date','status','action'])
                        ->make(true);
            }
        }

        public function create(): View
        {  
            $data['title'] = 'Team Leave';
            $data['sub_title'] = 'Create'; 
            if(auth('web')->user()->hasPermissionTo('manager-leave')){
                $data['employee_data'] = User::where('manager_id',Auth::guard('web')->user()->id)->get();  
            } else{
                $data['employee_data'] = User::get(); 
            } 
            $data['leave_type'] = LeaveType::where('status', 1)->get();  

            return view('user.leave.create',$data); 
        }

        public function update(Request $request, $id): View
        {  
           
            $data['title'] = 'Team Leave';
            $data['sub_title'] = 'Update';  
            $data['uinfo'] = $uinfo = LeaveRequest::with('leaveSchedules')->find($id);  

            // echo '<pre>';print_r($uinfo->leaveSchedules);die;
            $data['upload_files'] = UploadFile::where('file_uid', $uinfo->file_id)->get(); 
            if(auth('web')->user()->hasPermissionTo('manager-leave')){
                $data['employee_data'] = User::where('manager_id',Auth::guard('web')->user()->id)->get();  
            } else{
                $data['employee_data'] = User::get(); 
            }   
            $data['leave_type'] = LeaveType::where('status', 1)->get();  
            return view('user.leave.update',$data); 
        }

//         public function store(Request $request)
//         { 
            
//             $currentDate = Carbon::now()->toDateString();
//             if($request->id){
              
//                 request()->validate([
//                     'leave_type' => 'required', 
//                     'employee_id' => 'required',  
//                     'start_date' => 'required|date',
//                     'end_date' => 'required|date|after_or_equal:start_date',     
//                     ]);
//                     $leaveRequest = LeaveRequest::find($request->id); 
//                         $leaveRequest->update([
//                             'leave_type' => $request->leave_type,    
//                             'employee_id' => $request->employee_id, 
//                             'description' => $request->description, 
//                             'start_date' => $request->start_date, 
//                             'end_date' => $request->end_date, 
//                             'file_id' => $request->file_id,
//                             'session_id' => session('sessionId'), 
//                         ]);

//                         $leaveSchedule = LeaveSchedule::where('leave_request_id',$request->id)->delete(); 
                       
// //for date validation in leave schedule
//                         $leaveScheduleData = LeaveSchedule::where('employee_id',$request->employee_id)->get()->toArray(); 
//                         foreach($request->dates as $key => $val){
//                             $key = array_search($val, array_column($leaveScheduleData, 'date'));
//                             if(!empty($key) || $key == 0 && $key != ''){
//                                 return response()->json([
//                                     'success'=> 0,
//                                     'message'=>"You have already applied for ". date('d-M-Y',strtotime($val))."."
//                                 ]);
//                             }
//                         } 

//                         $dates = $request->dates;
//                         foreach($dates as $key=>$date){
//                             $hours = 0;
//                             if($request->leave_timing_type[$key]){
//                                 $leave_timing_type = $request->leave_timing_type[$key];
//                             }else{
//                                 $leave_timing_type = 0;
//                             }
//                             if($leave_timing_type != 0){
//                                 if($leave_timing_type == 4){
                                
//                                     $start_time = $request->start_time[$key];
//                                     $end_time = $request->end_time[$key];
                                    
//                                     $startDateTime =   new \DateTime($start_time);
//                                     $endDateTime =  new \DateTime($end_time);
                                    
//                                     $interval = $startDateTime->diff($endDateTime);
                                    
                                   
//                                     $hours = ($interval->h * 60) + $interval->i;
//                                 }else if($leave_timing_type == 2){
//                                     $hours = 240;
//                                         $start_time = '08:00 AM';
//                                         $end_time = '12:00 PM';
//                                     }else if($leave_timing_type == 3){
//                                         $hours = 240;
//                                         $start_time = '12:00 PM';
//                                         $end_time = '04:00 PM';
//                                     } else{
//                                     $start_time = null;
//                                     $end_time = null;
//                                 }
//                                 if($leave_timing_type == 1){
//                                     $hours = 480; 
//                                 }
        
//                                 LeaveSchedule::create([
//                                     'date' => $date,    
//                                     'employee_id' => $request->employee_id, 
//                                     'leave_request_id' => $request->id, 
//                                     'type' => $leave_timing_type, 
//                                     'start_time' => $start_time, 
//                                     'end_time' => $end_time, 
//                                     'days_in_hours' => $hours
//                                 ]);
                            
                           
//                         }
//                     }


 
//                     if($request->editfile_id){
//                         foreach($request->editfile_id as $uploadFile){
//                             $upload = UploadFile::find($uploadFile);
//                             if(isset($upload) && !empty($upload)){
//                                 $upload->update([
//                                     'file_uid' => $request->file_id,    
//                                 ]);
//                             } 
//                         }
//                     }
                       
//                 return response()->json([
//                     'success'=> 1,
//                     'message'=>"Leave Updated successfully."
//                 ]);
               
//             }else{
//                 $leavetype = LeaveType::where('id',$request->leave_type)->where('is_exceed',0)->first();
//                 if(!empty($leavetype)){
//                     $employeehistory = EmployeeLeaveHistory::where('employee_id',$request->employee_id)->where('leave_type_id',$request->leave_type)->first();
                    
//                     if(!empty($employeehistory)) {
//                         $booked = (int)$employeehistory->booked;
//                         if($employeehistory->total_leave_days <= $booked){
//                             return response()->json([
//                                 'success'=> 3,
//                                 'message'=>"Annual leave is complete."
//                             ]);
//                         }
//                      }

//                 $remaining =  $employeehistory->remaining; 

            
//             $dates = $request->dates;
//                     $totalHours = 0; 
//                     foreach ($dates as $key => $date) {
//                         $hours = 0;
//                         if ($request->leave_timing_type[$key]) {
//                             $leave_timing_type = $request->leave_timing_type[$key];
//                         } else {
//                             $leave_timing_type = 0;
//                         }

//                         if ($leave_timing_type != 0) {
//                             if ($leave_timing_type == 4) {
                                
//                                 $start_time = $request->start_time[$key];
//                                 $end_time = $request->end_time[$key];
//                                 $startDateTime = new \DateTime($start_time);
//                                 $endDateTime = new \DateTime($end_time);
//                                 $interval = $startDateTime->diff($endDateTime);
//                                 $hours = ($interval->h * 60) + $interval->i;
//                             } else if ($leave_timing_type == 2) {
//                                 $hours = 240; 
//                             } else if ($leave_timing_type == 3) {
//                                 $hours = 240; 
//                             } else {
//                                 $hours = 480; 
//                             }
//                         }
//                         $totalHours += $hours;
//                     }

//                     $totalDays = $totalHours / 480; 
  
//                     $minutesPerDay = 8 * 60;
    
//                     $days = floor($totalHours / $minutesPerDay);
//                     $remainingMinutes = $totalHours % $minutesPerDay;
    
//                     $hours = floor($remainingMinutes / 60);
//                     $minutes = $remainingMinutes % 60;

//                     if ($totalDays > $remaining) {
//                         $rem = (int)$remaining;
//                         return response()->json([
//                             'success' => 0,
//                             'message' => "Insufficient leave balance. You can only apply for $rem days, but you requested $days days, $hours hours, and $minutes minutes."
//                         ]);
//                     }
//                 }
                    
//             $leaveScheduleData = LeaveSchedule::where('employee_id', $request->employee_id)->get()->toArray();
//                 foreach ($request->dates as $key => $val) {
//                     $key = array_search($val, array_column($leaveScheduleData, 'date'));
//                     if (!empty($key) || $key == 0 && $key != '') {
//                         return response()->json([
//                             'success' => 0,
//                             'message' => "You have already applied for " . date('d-M-Y', strtotime($val)) . "."
//                         ]);
//                     }
//                 }

             

//                 request()->validate([
//                     'leave_type' => 'required',
//                     'employee_id' => 'required',
//                     'start_date' => 'required|date|after_or_equal:' . $currentDate,
//                     'end_date' => 'required|date|after_or_equal:start_date',
//                 ]);

//                 $leaveRequest = LeaveRequest::create([
//                     'leave_type' => $request->leave_type,
//                     'employee_id' => $request->employee_id,
//                     'description' => $request->description,
//                     'start_date' => $request->start_date,
//                     'end_date' => $request->end_date,
//                     'file_id' => $request->file_id,
//                     'session_id' => session('sessionId'),
//                 ]);

//                 $dates = $request->dates;

//                 foreach($dates as $key=>$date){

//                     $hours = 0;
//                     if($request->leave_timing_type[$key]){
//                         $leave_timing_type = $request->leave_timing_type[$key];
//                     }else{
//                         $leave_timing_type = 0;
//                     }
//                     if($leave_timing_type != 0){
//                     if($leave_timing_type == 4){
//                         // $start_time = $request->start_time[$key];
//                         // $end_time = $request->end_time[$key];
//                         $start_time = $request->start_time[$key];
//                         $end_time = $request->end_time[$key];
                        
//                        $startDateTime =   new \DateTime($start_time);
//                         $endDateTime =  new \DateTime($end_time);
                        
//                         $interval = $startDateTime->diff($endDateTime);
                        
//                        $hours =  ($interval->h * 60) + $interval->i;
//                     }else if($leave_timing_type == 2){
//                         $hours = 240;
//                             $start_time = '08:00 AM';
//                             $end_time = '12:00 PM';
//                         }else if($leave_timing_type == 3){
//                             $hours = 240;
//                             $start_time = '12:00 PM';
//                             $end_time = '04:00 PM';
//                         } else{
//                             $hours = 480;
//                         $start_time = null;
//                         $end_time = null;
//                     }

//                     LeaveSchedule::create([
//                         'date' => $date,    
//                         'employee_id' => $request->employee_id, 
//                         'leave_request_id' => $leaveRequest->id, 
//                         'type' => $leave_timing_type, 
//                         'start_time' => $start_time, 
//                         'end_time' => $end_time, 
//                         'days_in_hours' => $hours
//                     ]);
//                 }
//             }
                
//                 return response()->json([
//                     'success'=> 1,
//                     'message'=>"Leave created successfully."
//                 ]);
//             }
           
//         }

public function store(Request $request)
        {
            $currentDate = Carbon::now()->toDateString();
        
            $validationRules = [
                'leave_type' => 'required',
                'employee_id' => 'required',
                'start_date' => 'required|date',
                // 'end_date' => 'required',
            ];
            $request->validate($validationRules);
        
            $leaveRequest = $request->id ? LeaveRequest::find($request->id) : new LeaveRequest;
        
            $end_date = $request->leave_timing_type[0] == 5 ? $request->end_date : $request->start_date;
        
            $leaveRequest->fill([
                'leave_type' => $request->leave_type,
                'employee_id' => $request->employee_id,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'end_date' => $end_date,
                'file_id' => $request->file_id,
                'session_id' => session('sessionId'),
            ])->save();
        
            if ($request->id) {
                LeaveSchedule::where('leave_request_id', $request->id)->delete();
            }
        
            $leaveScheduleData = LeaveSchedule::where('employee_id', $request->employee_id)->pluck('date')->toArray();
            $dates = $request->leave_timing_type[0] == 5 ? $request->dates : [$request->start_date];
        
            foreach ($dates as $date) {
                if (in_array($date, $leaveScheduleData)) {
                    return response()->json(['success' => 0, 'message' => "You have already applied for " . date('d-M-Y', strtotime($date)) . "."]);
                }
            }
        
            $totalHours = 0;
            foreach ($dates as $index => $date) {
                $leaveTimingType = $request->leave_timing_type[0];
              
                $hours = $this->calculateLeaveHours($leaveTimingType, $request, $index);
                $carbonDate = Carbon::parse($date);
                if ($leaveTimingType == 3) {
                    if ($request->inlineRadioOptions == 2) {
                        $leaveTimingType = 2;
                     
                    } elseif ($request->inlineRadioOptions == 3) {
                        $leaveTimingType = 3;
                    }
                }

                if($leaveTimingType == 5){
                    if ($carbonDate->isSaturday() || $carbonDate->isSunday()) {
                        $leaveTimingType = 0; 
                       } else {
                        $leaveTimingType = 5; 
                      }
                }
        
                LeaveSchedule::create([
                    'date' => $date,
                    'employee_id' => $request->employee_id,
                    'leave_request_id' => $leaveRequest->id,
                    'type' => $leaveTimingType,
                    'start_time' => $hours['start_time'],
                    'end_time' => $hours['end_time'],
                    'days_in_hours' => $hours['hours'],
                ]);
        
                $totalHours += $hours['hours'];
            }
        
            // if ($leaveType = LeaveType::where('id', $request->leave_type)->where('is_exceed', 0)->first()) {
            //     if ($employeeHistory = EmployeeLeaveHistory::where('employee_id', $request->employee_id)->where('leave_type_id', $request->leave_type)->first()) {
            //         if ($totalHours / 480 > $employeeHistory->remaining) {
            //             return response()->json(['success' => 0, 'message' => "Insufficient leave balance."]);
            //         }
            //     }
            // }
            $leavetype = LeaveType::where('id',$request->leave_type)->where('is_exceed',0)->first();
            if(!empty($leavetype)){
                $employeehistory = EmployeeLeaveHistory::where('employee_id',$request->employee_id)->where('leave_type_id',$request->leave_type)->first();
                
                if(!empty($employeehistory)) {
                    $booked = (int)$employeehistory->booked;
                    if($employeehistory->total_leave_days <= $booked){
                        return response()->json([
                            'success'=> 3,
                            'message'=>"Annual leave is complete."
                        ]);
                    }
                 }

            $remaining =  $employeehistory->remaining; 

        
                $dates = $request->dates;
                        $totalHours = 0; 
                        if(is_array($dates)){
                            foreach ($dates as $key => $date) {
                                $hours = 0;
                                if ($request->leave_timing_type[0]) {
                                    $leave_timing_type = $request->leave_timing_type[0];
                                } else {
                                    $leave_timing_type = 0;
                                }
    
                                if ($leave_timing_type != 0) {
                                    if ($leave_timing_type == 4) {
                                        
                                        $start_time = $request->start_time[$key];
                                        $end_time = $request->end_time[$key];
                                        $startDateTime = new \DateTime($start_time);
                                        $endDateTime = new \DateTime($end_time);
                                        $interval = $startDateTime->diff($endDateTime);
                                        $hours = ($interval->h * 60) + $interval->i;
                                    } else if ($leave_timing_type == 2) {
                                        $hours = 240; 
                                    } else if ($leave_timing_type == 3) {
                                        $hours = 240; 
                                    } else {
                                        $hours = 480; 
                                    }
                                }
                                $totalHours += $hours;
                            }   
    
                        }else{
                            $hours = 0;
                            if ($request->leave_timing_type[0]) {
                                $leave_timing_type = $request->leave_timing_type[0];
                            } else {
                                $leave_timing_type = 0;
                            }

                            if ($leave_timing_type != 0) {
                                if ($leave_timing_type == 4) {
                            
                                    $start_time = $request->start_time;
                                    $end_time = $request->end_time;
                                    $startDateTime = new \DateTime($start_time);
                                    $endDateTime = new \DateTime($end_time);
                                    $interval = $startDateTime->diff($endDateTime);
                                    $hours = ($interval->h * 60) + $interval->i;
                                } else if ($leave_timing_type == 2) {
                                    $hours = 240; 
                                } else if ($leave_timing_type == 3) {
                                    $hours = 240; 
                                } else {
                                    $hours = 480; 
                                }
                            }
                            $totalHours += $hours;
                        }
                       
                $totalDays = $totalHours / 480; 

                $minutesPerDay = 8 * 60;

                $days = floor($totalHours / $minutesPerDay);
                $remainingMinutes = $totalHours % $minutesPerDay;

                $hours = floor($remainingMinutes / 60);
                $minutes = $remainingMinutes % 60;

                if ($totalDays > $remaining) {
                    $rem = (int)$remaining;
                    return response()->json([
                        'success' => 0,
                        'message' => "Insufficient leave balance. You can only apply for $rem days, but you requested $days days, $hours hours, and $minutes minutes."
                    ]);
                }
            }

            // Update related files
            if ($request->editfile_id) {
                UploadFile::whereIn('id', $request->editfile_id)->update(['file_uid' => $request->file_id]);
            }
        
            return response()->json(['success' => 1, 'message' => $request->id ? "Leave updated successfully." : "Leave created successfully."]);
        }
        
        private function calculateLeaveHours($leaveTimingType, $request, $index)
        {
            $hours = ['start_time' => null, 'end_time' => null, 'hours' => 480];
        
            if ($leaveTimingType == 4) {
                $start = new \DateTime($request->start_time[$index]);
                $end = new \DateTime($request->end_time[$index]);
                $interval = $start->diff($end);
                $hours['hours'] = ($interval->h * 60) + $interval->i;
                $hours['start_time'] = $request->start_time[$index];
                $hours['end_time'] = $request->end_time[$index];
            } elseif ($leaveTimingType == 3) {
                if ($request->inlineRadioOptions == 2) {
                    $leaveTimingType = 2;
                    $hours = [
                        'hours' => 240,
                        'start_time' => '08:00 AM',
                        'end_time' => '12:00 PM',
                    ];
                } elseif ($request->inlineRadioOptions == 3) {
                    $leaveTimingType = 3;
                    $hours = [
                        'hours' => 240,
                        'start_time' => '12:00 PM',
                        'end_time' => '04:00 PM',
                    ];
                }
            }
            
            return $hours;
        }

        public function upload(Request $request)
        {
           
            $request->validate([
                'file' => 'required|file|max:2048', // You can adjust the file size limit
            ]);
            $file = $request->file('file'); 
            $extension = $file->getClientOriginalExtension();
            // if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/uploads/leave-files'), $filename);
    
                $uploadedFile = new UploadFile();
                $uploadedFile->file = $filename; 
                $uploadedFile->file_uid = $request->file_uid; 
                $uploadedFile->save();

            // } else {
            //     return response()->json(['error' => 1, 'message' => 'Invalid file extension.']);
            // }
            $data['file_id'] = $uploadedFile->id;
            // $view = view('admin.leave.upload_temp', $data)->render(); 
            
            return response()->json([
                'success'=> 1,
                'message'=>"File uploaded successfully.",
                'file_id' => $uploadedFile->id,
                // 'view' => $view
            ]);
        }

        public function removeUpload(Request $request)
        {
             
            $file = UploadFile::find($request->fileId);
            $file->delete(); 
            return response()->json([
                'success'=> 1,
                'message'=>"File removed successfully.", 
            ]);
        }
        
         
        public function destroy(Request $request)
        {
           
            $leave = LeaveRequest::find($request->id); 
            $leave->delete();

            $file_id = $leave->file_id;
            $uploadFile = UploadFile::where('employee_id',$file_id); 
            $uploadFile->delete();


            return response()->json([
                'success'=> 1,
                'message'=>"Leave deleted successfully."
            ]);
        }

        public function dates(Request $request)
         {
 
            $startDate = new \DateTime($request->startDate);
            $endDate = new \DateTime($request->endDate);
 
            $endDate->add(new \DateInterval('P1D')); 
            $period = new \DatePeriod($startDate, new \DateInterval('P1D'), $endDate);


                $data['period'] = $period;
                $data['holiday'] = Holiday::where(['status' => 1])->get()->toArray();
                $view =  view('user.leave.show_date',$data)->render();
               
                return response()->json([
                    'success'=> 1,
                    'view' => $view,
                    'message'=>"Leave deleted successfully."
                ]);
        }

        public function comment(Request $request)
        { 
           
            $data['title'] = 'Comment';
            $data['sub_title'] = 'Comment';
            $data['leaveRequests'] = LeaveRequest::find($request->reqId);  

            //  echo '<pre>';print_r($data['leaveRequests']);die;
            
            return view('user.user-leave.comment',$data);
        }


 
}