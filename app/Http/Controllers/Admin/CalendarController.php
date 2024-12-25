<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\LeaveSchedule; 
use App\Models\User; 
use App\Models\Holiday; 
use App\Models\Department; 
use App\Models\EmployeeLeaveHistory; 
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash; 
use DataTables;
use DB;
use Spatie\Permission\Models\Role;


class CalendarController extends Controller
{
     

     public function index(): View
        { 
           
            $data['nav'] = 'calender'; 
            $data['title'] = 'Calendar'; 
            $data['employees'] = User::get(); 
            $data['departments'] = Department::where('status',1)->get(); 
            $data['leaveDates'] = [[
                'id' => '1',
                'title'=> 'All Day Event1',
                'start'=> '2023-10-01',
                'end' =>'2023-10-23',
            ]]; 


            return view('admin.calendar.index',$data);
        }


        public function getEmployee(Request $request)
        {
             
            $depId = $request->depId;
            $todayLeaves = LeaveSchedule::with('employees')
                                        ->where('date', date('Y-m-d'))
                                        ->whereHas('employees', function ($query) use($depId) {
                                            $query->where('department_id', $depId);
                                            })
                                        ->get();
                                            $empData = '';
                                        foreach ($todayLeaves as $todayLeave){
                                            $emp = '<div class="btn-sm btn btn-primary mb-2 remove-class active-class-'.$todayLeave->employees->id.'" data-class="bg-primary"
                                            onclick="NewEventData('.$todayLeave->employees->id.')">
                                            <i class="mdi mdi-checkbox-blank-circle me-2 vertical-middle"></i>'.$todayLeave->employees->name.'
                                        </div><br>';
                                        $empData .= $emp;

                                        } 
                                        if(count($todayLeaves) !=0){
                                            foreach($todayLeaves as $data){
                                                $leaveDates[] = [
                                                            'title' => $data->employees->name,
                                                            'start' => $data->date,
                                                ];
                                            } 
                                            return response()->json([
                                                'empData' => $empData, 
                                                'leaveDates' => $leaveDates, 
                                            ]); 
                                        }
                                        return response()->json([
                                            'empData' => $empData, 
                                            'leaveDates' => '', 
                                        ]);       
           
        }
        
          public function getLeaveDates(Request $request){
            $data['nav'] = 'calender'; 
            $data['title'] = 'Calendar'; 
            $data['employees'] = User::get(); 
            $data['public_holidays'] = Holiday::where('status',1)->get();
            $data['departments'] = Department::where('status',1)->get();

            $data['leavedata'] = LeaveRequest::with('leaveType', 'user', 'leaveSchedules')
            ->where('is_leave', 1)
            ->whereHas('leaveSchedules', function($query) {
                $query->whereNull('start_time');
            })
            ->get();
             
            $data['leaveschedule'] = LeaveSchedule::with('leaveRequests.leaveType','employees')
            ->whereHas('leaveRequests', function($query) {
                $query->where('is_leave',1);
            })
            ->get();
          
            return view('admin.calendar.calendershow',$data);
        }



     
//     public function showdates(Request $request)
//     {
//         //  echo "<pre>";print_r($request->toArray());die;
   
//        $startDate = new \DateTime($request->startDate);
//        $endDate = new \DateTime($request->endDate);

//        $startTime = Carbon::parse($request->startTime);
//        $endTime = Carbon::parse($request->endTime);
//     //    $totalDuration = $finishTime->diffForHumans($startTime);


//        $data['start_time'] = date("h:i A", strtotime($startTime));
//       $data['end_time'] = date("h:i A", strtotime($endTime));

//        $endDate->add(new \DateInterval('P1D')); 
//        $period = new \DatePeriod($startDate, new \DateInterval('P1D'), $endDate);

//              $data['slot'] = $request->slot;
//            $data['period'] = $period;
//            $data['holiday'] = Holiday::where(['status' => 1])->get()->toArray();
//            $view =  view('admin.calendar.showdate',$data)->render();
         
//            return response()->json([
//                'success'=> 1,
//                'view' => $view,
//                'message'=>"Leave deleted successfully."
//            ]);
//    }

public function showdates(Request $request)
{ 
    $startDate = new \DateTime($request->startDate);
    $endDate = new \DateTime($request->endDate);

    $startTime = Carbon::parse($request->startTime);
    $endTime = Carbon::parse($request->endTime);

    $data['start_time'] = $start = date("h:i A", strtotime($startTime));
    $data['end_time'] = $end = date("h:i A", strtotime($endTime));
   
    $isDifferentDate = $startDate->format('Y-m-d') !== $endDate->format('Y-m-d') ? 1 : 2; 
  
    $leaveTypev= 0;
    $timeDifference = $endTime->diffInMinutes($startTime);
    $formattedTimeDifference = $endTime->diff($startTime)->format('%h hours %i minutes');

    $isDifferentDate = $startDate->format('Y-m-d') !== $endDate->format('Y-m-d') ? 5 : 1; 
    $leaveType = $isDifferentDate;
    if($isDifferentDate  == 1){
        if ($start == '08:00 AM' && $end == '12:00 PM') {
        $leaveType = '2';
        } else if ($start == '12:00 PM' && $end == '04:00 PM') {
            $leaveType = '3';
        } else if (($request->slot == 'day' || $request->slot == 'resourceTimelineTenDay') &&
        (strtotime($start) > strtotime('08:00 AM') || strtotime($end) < strtotime('04:00 PM'))) {
        $leaveType = '4';
    } elseif (strtotime($start) == strtotime('08:00 AM') && strtotime($end) == strtotime('04:00 PM')) {
        $leaveType = '1'; 
    }
    
    }else{
        $leaveType = $isDifferentDate;
    }

    $data['leaveType'] = $leaveType;
    $endDate->add(new \DateInterval('P1D')); 
    $period = new \DatePeriod($startDate, new \DateInterval('P1D'), $endDate);

    $data['slot'] = $request->slot;
    $data['period'] = $period;
    $data['holiday'] = Holiday::where(['status' => 1])->get()->toArray();

    $view = view('admin.calendar.showdate', $data)->render();

    return response()->json([
        'success' => 1,
        'view' => $view,
        'isDifferentDate' => $isDifferentDate, 
        'timeDifference' => $timeDifference,
        'formattedTimeDifference' => $formattedTimeDifference, 
        'message' => "Leave processed successfully."
    ]);
}


   public function fullcalender(Request $request){
            
    // echo "<pre>";print_r($request->toArray());die;
    $data['nav'] = 'calender'; 
    $data['title'] = 'Calendar'; 
    $data['employee_data'] = User::find($request->employeeId);  
    $data['users'] = User::get();  
    $data['leave_type'] = LeaveType::where('status', 1)->get();
     

    $startDate = $endDate = $startTime = $endTime = '';
    $slot = $request->defaltView;

    if($slot == 'day'){
        $data['startDate'] =  Carbon::parse($request->startTime)->format('Y-m-d');
        $data['endDate'] =  Carbon::parse($request->endTime)->format('Y-m-d');
        $data['startTime'] =  Carbon::parse($request->startTime)->format('H:i:s');
        $data['endTime'] =  Carbon::parse($request->endTime)->format('H:i:s');
    }
    else if($slot == 'resourceTimelineTenDay'){
        $data['startDate'] =  Carbon::parse($request->startTime)->format('Y-m-d');
        $data['endDate'] =  Carbon::parse($request->endTime)->format('Y-m-d');
        $data['startTime'] =  Carbon::parse($request->startTime)->format('H:i:s');
        $data['endTime'] =  Carbon::parse($request->endTime)->format('H:i:s');
    } else if($slot == 'resourceTimelineTwentyDay'){
        $data['startDate'] =  Carbon::parse($request->startTime)->format('Y-m-d');
        $data['endDate'] =  Carbon::parse($request->endTime)->subDay()->format('Y-m-d');
    }else if($slot == 'month'){
        $data['startDate'] =  Carbon::parse($request->startTime)->format('Y-m-d');
        $data['endDate'] =  Carbon::parse($request->endTime)->subDay()->format('Y-m-d');
    }else if($slot == 'year'){
        $data['startDate'] =  Carbon::parse($request->startTime)->format('Y-m-d');
        $data['endDate'] =  Carbon::parse($request->endTime)->subDay()->format('Y-m-d');
    }

    $data['slot'] = $request->defaltView;
    $data =  view('admin.calendar.fullcalendar',$data)->render();
    return $data;
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


public function filterEmployees(Request $request)
{ 
    // $userid =  Auth::guard('web')->user()->id;  
    $depId = $request->depId;
    $departmentId = $request->input('departmentId');
    $user = User::where('department_id', $depId)->get();
    return response()->json(['user' => $user]);
}
      

 
}