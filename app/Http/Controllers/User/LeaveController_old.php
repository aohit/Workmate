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
        
            $data['title'] = 'Administration';
            $data['sub_title'] = 'Leave List';
            $data['leave'] = LeaveRequest::get();
            return view('user.leave.index',$data);
        }
 
        public function list(Request $request)
        { 
             
            if ($request->ajax()) {
     
                $data = LeaveRequest::orderBy('id','asc')->get(); 
             
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('employee', function($row){
                            if($row->employee_id){
                                $name =  $row->user->name;
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
                                $is_leave =  '<span class="badge badge-outline-primary">Pending</span>';
                            }elseif($row->is_leave == 1){
                                $is_leave =  '<span class="badge badge-outline-success">Approved</span>';
                            }else{
                                $is_leave =  '<span class="badge badge-outline-danger">Rejected</span>';
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
                          


                            return $action;
                        })
                       
                        ->rawColumns(['employee','leave_type','start_date','end_date','status','action'])
                        ->make(true);
            }
        }

        public function create(): View
        {  
            $data['title'] = 'Administration';
            $data['sub_title'] = 'Create';  
            $data['employee_data'] = User::get();  
            $data['leave_type'] = LeaveType::where('status', 1)->get();  

            return view('user.leave.create',$data); 
        }

        public function update(Request $request, $id): View
        {  
           
            $data['title'] = 'Administration';
            $data['sub_title'] = 'Update';  
            $data['uinfo'] = $uinfo = LeaveRequest::with('leaveSchedules')->find($id);  

            // echo '<pre>';print_r($uinfo->leaveSchedules);die;
            $data['upload_files'] = UploadFile::where('file_uid', $uinfo->file_id)->get(); 
            $data['employee_data'] = User::get();  
            $data['leave_type'] = LeaveType::where('status', 1)->get();  
            return view('user.leave.update',$data); 
        }

        public function store(Request $request)
        { 
            
            $currentDate = Carbon::now()->toDateString();
            if($request->id){
              
                request()->validate([
                    'leave_type' => 'required', 
                    'employee_id' => 'required',  
                    'start_date' => 'required|date',
                    'end_date' => 'required|date|after_or_equal:start_date',     
                    ]);
                    $leaveRequest = LeaveRequest::find($request->id); 
                        $leaveRequest->update([
                            'leave_type' => $request->leave_type,    
                            'employee_id' => $request->employee_id, 
                            'description' => $request->description, 
                            'start_date' => $request->start_date, 
                            'end_date' => $request->end_date, 
                            'file_id' => $request->file_id, 
                        ]);

                        $leaveSchedule = LeaveSchedule::where('leave_request_id',$request->id)->delete(); 
                       
//for date validation in leave schedule
                        $leaveScheduleData = LeaveSchedule::where('employee_id',$request->employee_id)->get()->toArray(); 
                        foreach($request->dates as $key => $val){
                            $key = array_search($val, array_column($leaveScheduleData, 'date'));
                            if(!empty($key) || $key == 0 && $key != ''){
                                return response()->json([
                                    'success'=> 0,
                                    'message'=>"You have already applied for ". date('d-M-Y',strtotime($val))."."
                                ]);
                            }
                        } 

                        $dates = $request->dates;

                foreach($dates as $key=>$date){


                    if($request->leave_timing_type[$key]){
                        $leave_timing_type = $request->leave_timing_type[$key];
                    }else{
                        $leave_timing_type = 0;
                    }
                    if($leave_timing_type != 0){
                    if($leave_timing_type == 4){
                        $start_time = $request->start_time[$key];
                        $end_time = $request->end_time[$key];
                    }else{
                        $start_time = null;
                        $end_time = null;
                    }

                    LeaveSchedule::create([
                        'date' => $date,    
                        'employee_id' => $request->employee_id, 
                        'leave_request_id' => $request->id, 
                        'type' => $leave_timing_type, 
                        'start_time' => $start_time, 
                        'end_time' => $end_time, 
                    ]);
                }
            }

 
                    if($request->editfile_id){
                        foreach($request->editfile_id as $uploadFile){
                            $upload = UploadFile::find($uploadFile);
                            if(isset($upload) && !empty($upload)){
                                $upload->update([
                                    'file_uid' => $request->file_id,    
                                ]);
                            } 
                        }
                    }
                       
                return response()->json([
                    'success'=> 1,
                    'message'=>"Leave Updated successfully."
                ]);
               
            }else{


    //for date validation in leave schedule
                $leaveScheduleData = LeaveSchedule::where('employee_id',$request->employee_id)->get()->toArray(); 
                foreach($request->dates as $key => $val){
                    $key = array_search($val, array_column($leaveScheduleData, 'date'));
                    if(!empty($key) || $key == 0 && $key != ''){
                        return response()->json([
                            'success'=> 0,
                            'message'=>"You have already applied for ". date('d-M-Y',strtotime($val))."."
                        ]);
                    }
                } 
                request()->validate([
                    'leave_type' => 'required', 
                    'employee_id' => 'required',   
                    'start_date' => 'required|date|after_or_equal:' . $currentDate,
                    'end_date' => 'required|date|after_or_equal:start_date', 
                ]);
                
                $leaveRequest = LeaveRequest::create([
                    'leave_type' => $request->leave_type,    
                    'employee_id' => $request->employee_id, 
                    'description' => $request->description, 
                    'start_date' => $request->start_date, 
                    'end_date' => $request->end_date, 
                    'file_id' => $request->file_id, 
                ]);

                $dates = $request->dates;

                foreach($dates as $key=>$date){


                    if($request->leave_timing_type[$key]){
                        $leave_timing_type = $request->leave_timing_type[$key];
                    }else{
                        $leave_timing_type = 0;
                    }
                    if($leave_timing_type != 0){
                    if($leave_timing_type == 4){
                        $start_time = $request->start_time[$key];
                        $end_time = $request->end_time[$key];
                    }else{
                        $start_time = null;
                        $end_time = null;
                    }

                    LeaveSchedule::create([
                        'date' => $date,    
                        'employee_id' => $request->employee_id, 
                        'leave_request_id' => $leaveRequest->id, 
                        'type' => $leave_timing_type, 
                        'start_time' => $start_time, 
                        'end_time' => $end_time, 
                    ]);
                }
            }
                
                return response()->json([
                    'success'=> 1,
                    'message'=>"Leave created successfully."
                ]);
            }
           
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