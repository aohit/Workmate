<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\EmployeeLeaveHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Models\UploadFile;  
use App\Models\Holiday;  
use App\Models\LeaveSchedule; 
use App\Models\User;
use App\Models\Session;
use Illuminate\Support\Facades\Hash; 
use DataTables;
use Validator;
use Carbon\Carbon; 
use Carbon\CarbonPeriod;
class UserLeaveController extends Controller
{
    /**
     * Display the login view.
     */

     function __construct()
     {
      
       
     }

     public function index(): View
        { 
        
            $data['title'] = 'Book Leave';
            $data['sub_title'] = 'Request Leave List';
            $data['leave'] = LeaveRequest::get();
            return view('user.user-leave.index',$data);
        }
 
        public function list(Request $request)
        { 
           
            if ($request->ajax()) {
     
                $data = LeaveRequest::orderBy('leave_requests.id','DESC')->where('employee_id',Auth::guard('web')->user()->id)->get(); 
                // echo '<pre>';print_r($data);die;
                return DataTables::of($data)
                        ->addIndexColumn() 
                        ->addColumn('leave_type', function($row){

                            if($row->leave_type){
                                $leaveType =  $row->leaveType->type;
                            }else{
                                $leaveType =  '-';
                            } 
                            return $leaveType;
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
                        ->addColumn('is_leave', function($row){
 
                            if($row->is_leave == 0){
                                $is_leave =  '<span class="badge rounded-pill bg-primary">Pending</span>';
                            }elseif($row->is_leave == 1){
                                $is_leave =  '<span class="badge rounded-pill bg-success">Approved</span>';
                            }else{
                                $is_leave =  '<span class="badge rounded-pill bg-danger">Rejected</span>';
                            }
 
                            return $is_leave;
                        })

                        ->addColumn('action', function($row){ 
 
                            if($row->is_leave == 0){   
                                 
                                    $editUrl = 'userleave/update/'.$row->id; 
                                $action =  "<a href='". $editUrl ."'  class='btn-sm btn btn-outline-dark waves-effect waves-light mr-1'>Edit</a>&nbsp;&nbsp;&nbsp;";
                              
                            }elseif($row->is_leave == 1){ 
                                    $msg = "You can not update approved leave.";
                                    $action =  '';  
                            }else{
                                $msg = "You can not update rejected leave.";
                                $action =  '<button type="button" onclick = "rejectView(`'.$row->id.'`)" class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Comment</button>&nbsp;&nbsp;&nbsp;'; 
                            } 
                            return $action;
                        })
                       
                        ->rawColumns(['start_date','end_date','leave_type','is_leave','action'])
                        ->make(true);
            }
        }

        public function create(): View
        {  
            // echo auth('web')->user()->reporting_to;die;
            $data['title'] = 'Book Leave';
            $data['sub_title'] = 'Create';  
            $data['employee_data'] = User::with('manager')->find(auth('web')->user()->id);  

            $data['leave_type'] = LeaveType::where('status',1)->get();  

            return view('user.user-leave.create',$data); 
        }

        public function update(Request $request, $id): View
        {  
           
            $data['title'] = 'Book Leave';
            $data['sub_title'] = 'Update';  
            $data['uinfo'] = $uinfo = LeaveRequest::with('leaveSchedules')->find($id);  

            // echo '<pre>';print_r($uinfo->leaveSchedules);die;
            $data['upload_files'] = UploadFile::where('file_uid', $uinfo->file_id)->whereNotNull('file_uid')->get();
            $data['employee_data'] = User::with('manager')->find(auth('web')->user()->id); 
            $data['leave_type'] = LeaveType::where('status',1)->get();  
            return view('user.user-leave.update',$data); 
        }

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
            // $view = view('admin.user-leave.upload_temp', $data)->render(); 
            
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
                
                $view =  view('user.user-leave.show_date',$data)->render();
              
                return response()->json([
                    'success'=> 1,
                    'view' => $view,
                    'message'=>"Leave deleted successfully."
                ]);
        }


        public function userLeaveRequest(Request $request)
        { 
            
             $employee_id =  Auth::guard('web')->user()->id; 
             $data['title'] = 'Leave Overview';
             $data['sub_title'] = 'Leave Request';
             $data['leaveRequests'] = $leaveRequest  = LeaveRequest::with('employee','leaveType','leaveSchedules')->where('id',$request->reqId)->first();  
             $data['leaveHistories'] = LeaveType::with(['leaveHistory' => function ($query) use ($leaveRequest) {
                $query->where('employee_id', $leaveRequest->employee->id);
            }])
            ->where('id', $leaveRequest->leaveType->id)
            ->get();
             $view = view('user.user-leave.leave_request',$data)->render();
            return $view;
 
        }

    //     public function leaveTypeData(Request $request){
    //     $userid =  Auth::guard('web')->user()->id; 
    //     $leaveTypes =LeaveType::with(['leaverequest'=> function($query) use($userid) {
    //         $query->where('employee_id',$userid);
    //     }])->where('status',1)->find($request->id);
        
    //     $weekendsCount= $totalDays = $weekendsTotal = $days = 0;
    //     foreach($leaveTypes->leaverequest as $leaveRequest){
    //         $weekendData = $this->countWeekends($leaveRequest->start_date, $leaveRequest->end_date);
    //         $days = $weekendData['totalDays'];
    //         $weekends = $weekendData['weekends'];
            
    //         $totalDays += $days;
    //         $weekendsTotal += $weekends;
    //     }
    //     $leaveTypes->weekendsCount = $weekendsTotal;
    //     $leaveTypes->totalLeavesrequest = ($totalDays - $weekendsTotal);
    //     $leaveTypes->remainingLeaves = ($leaveTypes->leave_days - ($totalDays - $weekendsTotal));

    //     $view =  view('user.myleave.quicksummary',compact('leaveTypes'))->render();
    //     return response()->json([
    //         'success'=> 1,
    //         'view'=>$view,
    //     ]);
    // }

        // public function leaveApproveReject(Request $request)
        // {   
        //     //  echo '<pre>';print_r($request->toArray());die;
            
        //     $data =LeaveRequest::find($request->reqId); 
        //                 $data->update([
        //                     'is_leave' => $request->is_leave,  
        //                     'comment' => $request->comment,  
        //                 ]);
                     

        //         if($request->is_leave == 1){
        //             $status = "Leave approved successfully.";
        //         }else{
        //             $status = "Leave rejected successfully.";
        //         }
                 
        //         return response()->json([
        //             'success'=> 1,
        //             'message'=> $status
        //         ]);
               
        //     }


        public function countWeekends($startDate, $endDate)
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        
        $period = CarbonPeriod::create($start, $end);
        $weekends = $totalDays = 0;
        foreach ($period as $date) {
            $totalDays++;
            if ($date->isWeekend()) { 
                $weekends++;
            }
        }

        return [
            'totalDays' => $totalDays,
            'weekends' => $weekends,
        ];
    }

        public function leaveApproveReject(Request $request)
        {   
            $data = LeaveRequest::with('leaveType')->find($request->reqId); 

            $data->update([
                'is_leave' => $request->is_leave,  
                'comment' => $request->comment,  
            ]);

            if ($request->is_leave == 1) {
                $status = "Leave approved successfully.";
                
                $employeeId = $data->employee_id;
                $leaveType = $data->leave_type;
                $sessions = Session::where('is_default', 1)->first();
                $leaveHistory = EmployeeLeaveHistory::where('employee_id', $employeeId)
                                            ->where('leave_type_id', $leaveType)->where('session_id',$sessions->id)
                                            ->first();

                // $allLeaveRequest = leaveRequest::with('leaveSchedules')->where('employee_id',$employeeId)->where('leave_type',$leaveType)->get();

                $allLeaveRequest = leaveRequest::with('leaveSchedules')
                ->where('employee_id', $employeeId)
                ->where('leave_type', $leaveType)->where('is_leave' ,1)
                ->get();
                // echo "<pre>";print_r($allLeaveRequest->toArray());die;

                $totalDaysInHours = $allLeaveRequest->sum(function ($leaveRequest) {
                    return $leaveRequest->leaveSchedules->sum('days_in_hours');
                });

                $totalLeaveHour = $totalDaysInHours /480;

                if ($leaveHistory) {
                    $leavetype = $data->leaveType?->type;
                    $leavedays = $data->leaveType?->leave_days;
                    $leaveMinuts = $data->leaveType?->days_in_minutes;
                    $leaveHours = $data->leaveType?->days_in_hours;
                    $totalLeaveDaysInHistory = $data->total_leave_days;
                    $RemainingHour = $leaveHistory->remaining;
                    $totalRemainingHour = $leaveHistory->remaining*8;
                    $totalLeaveRemaining = $totalRemainingHour*60;//total leave day 21
                    $weekendData = $this->countWeekends($data->start_date, $data->end_date);
                    $booked = $weekendData['totalDays']; 
                    $bookedLeave = $weekendData['totalDays']*8; 
                   
                    $finaltotalMinutes = $leaveMinuts - $totalDaysInHours;
                    $finaltotalhours = $finaltotalMinutes/480;  
                    $leaveHistory->booked = $totalLeaveHour;
                    $leaveHistory->remaining = $finaltotalhours;

                    if ($finaltotalhours <= 0) {
                        $advanceLeave = abs($finaltotalhours); // Calculate the advance leave
                        $leaveHistory->advance_leave  = $advanceLeave;
                        $leaveHistory->remaining = 0; // Set remaining to 0
                    } else {
                        $leaveHistory->remaining = $finaltotalhours;
                    }
                    
                    if (($leaveHistory->carried_over_is_expire == 1) && ($leaveHistory->carried_over_leave_active == 0)) {
                        // Subtract carry_over_days from the total leave hours
                        if($data->leaveType?->carry_over_days >= $totalLeaveHour){
                            $leaveHistory->carried_over_leave = abs($totalLeaveHour - $data->leaveType?->carry_over_days); // Convert days to hours
                        }elseif($leaveHistory->carried_over_leave <= 0.00){
                            $leaveHistory->carried_over_leave_active =1;
                        }
                       
                    }                  



                    $leaveHistory->save();
                    
                }
            } else {
                $status = "Leave rejected successfully.";
            }

            return response()->json([
                'success' => 1,
                'message' => $status
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