<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Performance;  
use App\Models\Role;  
use App\Models\User; 
use App\Models\ReviewTemplate;  
use App\Models\LeaveRequest; 
use Illuminate\Support\Facades\Hash; 
use DataTables;

class PerformanceController extends Controller
{
    /**
     * Display the login view.
     */
    
     function __construct()
        {
           
        }


    public function index(): View
        {  
            $data['title'] = 'Performance Review'; 
            $data['performances'] = Performance::get(); 
            return view('admin.performance.index',$data);
        }


    public function create()
        {  
            
            
            $data['title'] = 'Performance';
            $data['sub_title'] = 'Start Performance Review For Employee'; 
            $data['employee_data'] = User::get();  
            $data['review_temp'] = ReviewTemplate::get();  
            $data['roles'] = Role::get();
            return view('admin.performance.create',$data); 
        }

    public function list(Request $request)
        { 
             
            
            if ($request->ajax()) {
    
                
                    $data = Performance::get(); 
              
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('employee', function($row){
                            if($row->employee_id){
                                $name =  $row->employee->name;
                            }else{
                                $name =  '-';
                            }
                              
                            return $name;
                        })

                        ->addColumn('review_temp', function($row){
                            if($row->review_temp){
                                $name =  $row->reviewTemp->temp_name;
                            }else{
                                $name =  '-';
                            }
                              
                            return $name;
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
                        
                        ->addColumn('status', function($row){ 
 
                            if($row->status == 0){
                                $status =  '<span class="badge badge-outline-primary">Pending</span>';
                            }elseif($row->status == 1){
                                $status =  '<span class="badge badge-outline-success">Accepted By Employee</span>';
                            }elseif($row->status == 2){
                                $status =  '<span class="badge badge-outline-success">Accepted By Manager</span>';
                            }else{
                                $status =  '<span class="badge badge-outline-danger">Rejected</span>';
                            }
                            return $status;
                        })

                        ->addColumn('action', function($row){ 

                            // $editUrl = route('performance.update');
                            // $deleteUrl = route('performance.delete'); 
                            $showUrl = route('admin.performance.show');
                               

                                // $action =  '<button type="button" onclick = editForm(this,"'.$row->id.'","'. $editUrl .'") class="btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;'; 
                                $action =  '<button type="button" onclick = showForm(this,"'.$row->id.'","'. $showUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Show</button>&nbsp;&nbsp;&nbsp;';
                                // $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="d-none btn btn-outline-danger waves-effect waves-light">Delete</button>'; 
                            return $action;
                        })
                       
                        ->rawColumns(['employee','review_temp','status','action'])
                        ->make(true);
            }
        }

        public function store(Request $request)
        {
           
            if($request->id){ 
                return response()->json([
                    'success'=> 1,
                    'message'=>"Performance updated successfully."
                ]);
            }else{
 
                request()->validate([
                    'employee' => 'required',  
                    'review_template' => 'required',   
                    'start_date' => 'required|date',
                    'end_date' => 'required|date|after_or_equal:start_date',   
                ]);

                    $employeeData = User::find($request->employee);
  
                    $data = new Performance; 
                    $data->employee_id =$request->employee;   
                    $data->review_temp = $request->review_template;     
                    $data->start_date = $request->start_date;
                    $data->end_date = $request->end_date; 
                    $data->assign_manager_id =$employeeData->manager_id; 
                    $data->status = 0;
                    // echo '<pre>';print_r($data);die;
                    $data->save(); 
            
    
                return response()->json([
                    'success'=> 1,
                    'message'=>"Performance created successfully."
                ]);
            }
           
        }


        
        public function show(Request $request): View
        {  
            $data['title'] = 'Performance';
            $data['sub_title'] = 'View';  
            $data['Performance'] = Performance::find($request->id); 
            return view('admin.performance.show',$data); 
        }


        public function performanceReviewRequest(Request $request)
        { 
            
             $employee_id =  Auth::guard('web')->user()->id; 
             $data['title'] = 'Performance Review';
             $data['sub_title'] = 'Manager Evalution';
            //  $data['leaveRequests'] = LeaveRequest::with('employee','leaveType','leaveSchedules')->where('id',$request->reqId)->first();   
             $performanceReview = Performance::with('user','reviewTemp')->where('id',$request->reqId)->first();
             echo '<pre>';print_r($performanceReview->toArray());die; 
            return view('admin.performance.show.performance_request',$data);
 
        }

        



  
//      public function tabClick(Request $request): View
//         { 
// echo $request->tab;die;
//         }
 
      

      

        // public function update(Request $request): View
        // {  
        //     $data['title'] = 'Performance';
        //     $data['sub_title'] = 'Update';  
        //     $data['uinfo'] = Performance::find($request->id); 
        //     // echo '<pre>';print_r($data['uinfo']);die;  
        //     $data['roles'] = Role::get();
        //     return view('admin.Performance.update',$data); 
        // }



       

        // public function destroy(Request $request)
        // {
           
        //     $data = Performance::find($request->id); 
        //     $data->delete(); 

        //     return response()->json([
        //         'success'=> 1,
        //         'message'=>"Performance deleted successfully."
        //     ]);
         
          
        // }

        // public function status(Request $request)
        // {
           
        //     $data = Performance::find($request->id); 
        //     $data->status = $request->status;
        //     $data->save(); 
        //     return response()->json([
        //         'success'=> 1,
        //         'message'=>"Performance status changed successfully."
        //     ]);
         
          
        // }

        

 
}