<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\{Performance, Role, User, ReviewTemplate, PerformanceGoal, LeaveRequest,AssessPotential}; 
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
            return view('user.performance.index',$data);
        }


    public function create(): View
        {  
            $data['title'] = 'Performance';
            $data['sub_title'] = 'Employee Performance Review'; 
            $data['employee_data'] = User::get();  
            $data['review_temp'] = ReviewTemplate::get();  
            $data['roles'] = Role::get();
            return view('user.performance.create',$data); 
        }

    public function list(Request $request)
        { 
             
            $userId = Auth::guard('web')->user()->id; 
           
            if ($request->ajax()) {
    
                
                    $data = Performance::where('employee_id', $userId)->get(); 
              
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
                            $showUrl = route('performance.show');
                               

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
     
                    $data = new Performance; 
                    $data->employee_id = Auth::guard('web')->user()->id;   
                    $data->review_temp = $request->review_template;     
                    $data->start_date = $request->start_date;
                    $data->end_date = $request->end_date; 
                    $data->assing_manager_id = Auth::guard('web')->user()->reporting_to; 
                    $data->status = 0;
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
            $data['performance'] = $performance = Performance::with('user','reviewTemp')->find($request->id); 
            $data['sub_title'] = 'Start Performance Review Confirmation '.$performance->reviewTemp->temp_name." : ".$performance->user->name;   
            return view('user.performance.show',$data); 
        }


        public function performanceReviewRequest(Request $request, $id)
        {  

             $employee_id =  Auth::guard('web')->user()->id; 
             $data['performance'] = $performanceReview = Performance::with('employee','reviewTemp')->where('id',$id)->first();
             $data['title'] = 'Performance Review';
             $data['sub_title'] = 'Assess Potential '.$performanceReview->employee->name;  
            return view('user.performance.accept_manager',$data);

 
        }

        public function acceptEmployee(Request $request)
        {  
            $data = Performance::find($request->performance_id); 
            $data->status = $request->status;
            $data->save(); 
            return response()->json([
                'success'=> 1,
                'message'=>"Employee has completed his evaluation."
            ]); 
        }

        public function acceptManager(Request $request)
        {  
            

           

         
            $performance = Performance::find($request->performance_id); 

            $assessPotential = AssessPotential::where('performance_id',$request->performance_id)->first(); 
                if(empty($assessPotential)){
                    request()->validate([
                        'potential' => 'required',  
                        'retention' => 'required',   
                        'achievable_level' => 'required',
                        'loss_impact' => 'required',   
                    ]);

                    $data = new AssessPotential;
                    $data->performance_id = $request->performance_id;
                    $data->potential = $request->potential;
                    $data->retention = $request->retention;
                    $data->achievable_level = $request->achievable_level;
                    $data->loss_impact = $request->loss_impact;
                    $data->status = 1; 
                    $data->save(); 
 
                    return response()->json([
                        'success'=> 1,
                        'message'=>"Manager evaluation has completed.",
                        'performance_id' => $request->performance_id
                    ]); 
                }
                return response()->json([
                    'success'=> 1,
                    'message'=>"You have already completed manager evaluation.",
                    'performance_id' => $request->performance_id
                ]); 
          

        }
        public function performanceReviewRequestComplete(Request $request, $id)
        {  
            $data['performance'] = $performanceReview = Performance::with('employee','reviewTemp')->where('id',$id)->first();
            $data['title'] = 'Performance Review';
            $data['sub_title'] = 'Complete Manager Evaluation '.$performanceReview->reviewTemp->temp_name." : ".$performanceReview->employee->name;  
            return view('user.performance.complete_manager_evaluation',$data);
        }


        
  
     public function performanceTab(Request $request) 
        { 

            $data['performance'] = $performanceReview = Performance::with('employee','reviewTemp')->where('id',$request->performance_id)->first();
               if($request->tab == 'goals'){
                $data['goal'] = PerformanceGoal::where('performance_id', $request->performance_id)->first();
                $view = view('user.performance.tabs.goals',$data)->render();
                return response()->json([
                    'success'=> 1,
                    'message'=>"Manager evaluation has completed.",
                    'view' => $view
                ]); 
    
               }elseif($request->tab == 'compet'){
                $view = view('user.performance.tabs.competencies',$data)->render();
                return response()->json([
                    'success'=> 1,
                    'message'=>"Manager evaluation has completed.",
                    'view' => $view
                ]); 
               }elseif($request->tab == 'develop'){
                $view = view('user.performance.tabs.development_item',$data)->render();
                return response()->json([
                    'success'=> 1,
                    'message'=>"Manager evaluation has completed.",
                    'view' => $view
                ]); 
               }elseif($request->tab == 'overall'){
                $view = view('user.performance.tabs.overall',$data)->render();
                return response()->json([
                    'success'=> 1,
                    'message'=>"Manager evaluation has completed.",
                    'view' => $view
                ]); 
               }elseif($request->tab == 'summary'){
                $view = view('user.performance.tabs.summary',$data)->render();
                return response()->json([
                    'success'=> 1,
                    'message'=>"Manager evaluation has completed.",
                    'view' => $view
                ]); 
               }
        }


        public function updateGoal(Request $request) 
                {  
 
                      request()->validate([
                            'title' => 'required',  
                            'status' => 'required',   
                            'description' => 'required',
                            'due_date' => 'required',   
                            'category' => 'required',   
                        ]);
                        $data['performance'] = $performance = Performance::with('employee','reviewTemp')->where('id',$request->performance_id)->first(); 
                        $goal = PerformanceGoal::where('performance_id', $request->performance_id)->first();
                    if(empty($goal)){
                       
                        $data = new PerformanceGoal; 
                        $data->employee_id = $performance->employee_id;    
                        $data->manager_id = Auth::guard('web')->user()->id;   
                        $data->title =  $request->title;
                        $data->status =  $request->status;
                        $data->description =  $request->description;
                        $data->due_date =  $request->due_date;
                        $data->category_id =  $request->category;
                        $data->performance_id = $request->performance_id;
                        $data->save();
                        return response()->json([
                            'success'=> 1,
                            'message'=>"Goal created successfully.",
                            
                        ]); 
                    }else{
                      
                        $goal->employee_id = $performance->employee_id;    
                        $goal->manager_id = Auth::guard('web')->user()->id;   
                        $goal->title =  $request->title;
                        $goal->status =  $request->status;
                        $goal->description =  $request->description;
                        $goal->due_date =  $request->due_date;
                        $goal->category_id =  $request->category;
                        $goal->performance_id = $request->performance_id;
                        $goal->save(); 
                        return response()->json([
                            'success'=> 1,
                            'message'=>"Goal udpated successfully.",
                           
                        ]); 
                    }
                         
                }
      
        
      

        // public function update(Request $request): View
        // {  
        //     $data['title'] = 'Performance';
        //     $data['sub_title'] = 'Update';  
        //     $data['uinfo'] = Performance::find($request->id); 
        //     // echo '<pre>';print_r($data['uinfo']);die;  
        //     $data['roles'] = Role::get();
        //     return view('user.Performance.update',$data); 
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

      

        

 
}