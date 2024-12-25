<?php

namespace App\Http\Controllers\Admin;

use App\Models\GoalReview;
use App\Http\Controllers\Controller;
use App\Models\InputType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Role;
use App\Models\LeaveRequest;
use App\Models\{Goal, RatingScale,ReviewCycle,Department};
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DataTables;
use App\Mail\ManagerReviewMail;
use App\Mail\GoalReviewMail;
use Illuminate\Support\Facades\Mail;

class GoalReviewController extends Controller
{
    public function index():View
    { 
        $data['title'] = 'Goal Review';
        $data['sub_title'] = 'Goal Review';
        $data['departments'] = Department::get();
       return view('admin.goalreview.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Goal Review';
        $data['sub_title'] = 'Goal Review'; 
        $data['employees'] = User::get();
        $data['user']  = auth()->user();
        $data['types'] = InputType::get();
        $data['reviewcycles'] = ReviewCycle::get();
        $data['ratings'] = RatingScale::with('ratingScaleOption')->get();
        return view('admin.goalreview.create',$data); 
    }


    public function list(Request $request)
    {
      
        if ($request->ajax()) {
            
            $departmentId = $request->departmentId; 
            if(!empty($request->departmentId) && isset($request->departmentId)){
            
                $data = GoalReview::with(['user' => function ($query) use ($departmentId) {
                    $query->where('department_id', $departmentId);
                }])->whereHas('user', function ($query) use ($departmentId) {
                    $query->where('department_id', $departmentId);
                })->get();
            } else {
                $data = GoalReview::with(['user','user.department','Goals','reviewCycle','InputTypesData'])->get(); 
              
            }

            // echo "<pre>";print_r($data);die;

            // $data = GoalReview::with(['user','Goals','reviewCycle','InputTypesData'])->get(); 
        // echo "<pre>";print_r($data->toArray());die;
              return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('employee_id', function($row){
                    $user = User::where('id',$row->employee_id)->select('name')->first();
                    return $user->name;
                })
                ->addIndexColumn()
                ->addColumn('input_type_id', function($row){
                    $formattype =  $row->InputTypesData->title;
                    return $formattype;
                }) 
                ->addIndexColumn()
                ->addColumn('review_cycle_id', function($row){
                    $reviewcycle = ReviewCycle::where('id',$row->review_cycle_id)->select('title')->first();
                    $reviewcyclename =  $reviewcycle->title;
                    return $reviewcyclename;
                })
                ->addIndexColumn()
                ->addColumn('rating_id', function($row){
                    $goalsrating = RatingScale::where('id',$row->rating_id)->select('label')->first();
                    $ratingname =  $goalsrating->label;
                    return $ratingname;
                })
                ->addIndexColumn()
                ->addColumn('departments', function($row){
                    $departments =  $row->user->department?->name;
                    return $departments;
                })
                ->addIndexColumn()
                ->addColumn('job_title', function($row){
                    $departments =  $row->user?->job_title;
                    return $departments;
                })
              
                ->addColumn('action', function($row){ 
                    $editUrl = route('admin.goal-review.update');
                    $deleteUrl = route('admin.goal-review.delete');
                    
                    $action = '<div class="flexblockclass gap-1">';
                    $action .= '<button type="button" onclick="editForm(this, \'' . $row->id . '\', \'' . $editUrl . '\')" class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>';
                    $action .= '<button type="button" onclick="deleteRow(this, \'' . $row->id . '\', \'' . $deleteUrl . '\')" class="btn-sm btn btn-outline-danger waves-effect waves-light mb-0">Delete</button>';
                    $action .= '</div>';
                
                    return $action;
                })
               
                ->rawColumns(['employee_id','input_type_id','review_cycle_id','rating_id','departments','job_title','action'])
                ->make(true);
    }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = Goal::where('user_id',$request->employee)->get();
        if($request->id){ 
            $id = $request->id;
              request()->validate([
                  'employee' => 'required', 
                  'reviewcycle' => 'required',  
                  'type' => 'required', 
                  'rating' => 'required', 
                //   'comment' => 'required', 
          
                  ]);

              $admin = GoalReview::find($request->id);
             
                  $admin->update([
                  'employee_id' => $request->employee,    
                  'review_cycle_id' => $request->reviewcycle,
                  'input_type_id' => $request->type,
                  'rating_id' => $request->rating,
                  'goalcomment_id' => $request->comment,
                  ]);     
             
              return response()->json([
                  'success'=> 1,
                  'message'=>"Goal Review Updated successfully."
              ]);

          }else{ 
              request()->validate([
                'employee' => 'required', 
                'reviewcycle' => 'required',  
                'type' => 'required', 
                'rating' => 'required', 
                // 'comment' => 'required', 
              ]);
  
        
             $employeeId = $request->employee;
             foreach($employeeId as $key =>  $employee){

                $user = User::where('id', $employee)->first();
                        $emp = GoalReview::create([
                            'employee_id' => $employee,    
                            'review_cycle_id' => $request->reviewcycle,
                            'input_type_id' => $request->type,
                            'rating_id' => $request->rating,
                            'goalcomment_id' => $request->comment,
                            'sendmail' => $request->sendmail,
                            'manager_id' => $user->manager_id,
                        ]);

                        $userdetails = GoalReview::with('user','Manager','reviewCycle','rating','Goals')->where('employee_id' ,$user->id)->first();
                        
                        if (!empty($userdetails->user?->email)) {
                            if($request->sendmail == 1){
                                Mail::to($userdetails->user?->email)->send(new GoalReviewMail($userdetails));
                            }    
                        }    
            }


              return response()->json([
                  'success'=> 1,
                  'message'=>"Goal Review Insert Successfully."
              ]);
          }
    }

    /**
     * Display the specified resource.
     */
    public function show(GoalReview $goalReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GoalReview $goalReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GoalReview $goalReview)
    {
        $data['title'] = 'Goal Review';
        $data['sub_title'] = 'Update';  
        $data['employees'] = User::get();   
        $data['reviewcycles'] = ReviewCycle::get();   
        $data['ratings'] = RatingScale::get();   
        $data['inputtype'] = InputType::get();

        $data['uinfo'] = GoalReview::with(['user','Goals','reviewCycle'])->find($request->id);
        // echo "<pre>";print_r($data['uinfo']->toArray());die;
        return view('admin.goalreview.update',$data); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = GoalReview::find($request->id); 
        $data->delete(); 

        return response()->json([
            'success'=> 1,
            'message'=>"Goal Review deleted successfully."
        ]);
    }
}
