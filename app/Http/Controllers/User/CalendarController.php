<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\LeaveSchedule;  
use App\Models\Holiday; 
use App\Models\User; 
use Carbon\Carbon;
use App\Models\Department; 
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Hash; 
use DataTables;
use DB;
use Spatie\Permission\Models\Role;


class CalendarController extends Controller
{
     

     public function index(): View
        { 
           
            $data['nav'] = 'calender'; 
            $data['title'] = 'Leave Calendar'; 
            $data['employees'] = User::get(); 
            $data['departments'] = Department::where('status',1)->get(); 
            $data['leaveDates'] = [[
                'id' => '1',
                'title'=> 'All Day Event1',
                'start'=> '2023-10-01',
                'end' =>'2023-10-23',
            ]]; 


            return view('user.calendar.index',$data);
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
                                            $emp = '<div class="btn btn-primary mb-2 remove-class active-class-'.$todayLeave->employees->id.'" data-class="bg-primary"
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
                                                            'id' => 1,
                                                            // 'url' => 'www.google.com',
                                                            'editable' => true,
                                                            'textColor' => 'white',  
                                                            'description' => 'This is a crucial meeting with the team.',
                                                            'extendedProps' => 'extendedProps',
                                                            'className' => 'open-model',
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
        
        
        public function getLeaveDates(Request $request)
        {
            $userid =  Auth::guard('web')->user()->id;  

            $data['nav'] = 'calender'; 
            $data['title'] = 'Calendar';
            if((auth('web')->user()->hasPermissionTo('hr-leave-calender'))){
                $data['employees'] = User::get(); 
            }else{
                $data['employees'] = User::where('manager_id',$userid)->get(); 
            }
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
          
            return view('user.calendar.calendershow',$data);
        }
        
        
        public function filterEmployees(Request $request)
        { 
            $userid =  Auth::guard('web')->user()->id;  
            $depId = $request->depId;
            $departmentId = $request->input('departmentId');
            $user = User::where('manager_id',$userid)->where('department_id', $depId)->get();
            return response()->json(['user' => $user]);
        }
        
        public function showdates(Request $request)
        {
           $startDate = new \DateTime($request->startDate);
           $endDate = new \DateTime($request->endDate);
    
           $startTime = Carbon::parse($request->startTime);
           $endTime = Carbon::parse($request->endTime);
       
          $data['start_time'] = date("h:i A", strtotime($startTime));
          $data['end_time'] = date("h:i A", strtotime($endTime));
    
           $endDate->add(new \DateInterval('P1D')); 
           $period = new \DatePeriod($startDate, new \DateInterval('P1D'), $endDate);
    
                 $data['slot'] = $request->slot;
               $data['period'] = $period;
               $data['holiday'] = Holiday::where(['status' => 1])->get()->toArray();
               $view =  view('user.calendar.showdate',$data)->render();
             
               return response()->json([
                   'success'=> 1,
                   'view' => $view,
                   'message'=>"Leave deleted successfully."
               ]);
        }
       
       
        public function fullcalender(Request $request)
       {        
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
        $data =  view('user.calendar.fullcalendar',$data)->render();
        return $data;
    }




    // public function getLeaveDates(Request $request)
    //     {
             
    //         $id = $request->id;
    //         if($id){  
    //             $datas = LeaveSchedule::with('leaveType')->where('employee_id', $id)->get();
 
    //             $leaveDates = [];

    //             foreach($datas as $data){
    //                 $leaveDates[] = [
    //                             'title' => $data->leaveType->type,
    //                             'start' => $data->date,
    //                 ];
    //             } 
    //             return response()->json($leaveDates); 
    //         }else{ 
 
    //             $datas = Holiday::get();
    //             $leaveDates = [];

    //             foreach($datas as $data){
    //                 $leaveDates[] = [
    //                             'title' => $data->title,
    //                             'start' => $data->date,
    //                             'backgroundColor' => 'red',
    //                             // 'id' => 1,
    //                             // 'url' => 'www.google.com',
    //                             // 'editable' => true,
    //                             // 'textColor' => 'white',  
    //                             // 'description' => 'This is a crucial meeting with the team.',
    //                             // 'extendedProps' => 'extendedProps',
    //                             // 'className' => 'ok',
    //                 ];
    //             } 
    //             return response()->json($leaveDates); 
    //         }
 
            
       
    //     }
 
 
}