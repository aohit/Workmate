<?php

namespace App\Http\Controllers\User;

use App\Models\GoalReview;
use App\Http\Controllers\Controller;
use App\Models\InputType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Role;
use App\Models\LeaveRequest;
use App\Models\{Appraisal, Goal, GoalReviewStore, QueForm, RatingScale,ReviewCycle};
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Illuminate\Support\Facades\Validator;
use PDF;
use App\Mail\ManagerGoalReviewMail;
use Illuminate\Support\Facades\Mail;
class GoalReviewController extends Controller
{
    public function index():View
    { 
        $data['title'] = 'Goal Review';
        $data['sub_title'] = 'Goal Review';
       return view('user.goalreview.index',$data);
    }

    public function managerIndex()
    { 
        $data['title'] = 'Team Goal Review';
        $data['sub_title'] = 'Team Goal Review';
        return view('user.goalreview.managerindex',$data);
    }
    
    public function pendingReview()
    {
        $data['title'] = 'Tasks';
        $data['sub_title'] = 'Tasks List';
       return view('user.goalreview.pendingtab',$data);
    }

    public function completedReview(){
        $data['title'] = 'Tasks';
        $data['sub_title'] = 'Tasks List';
       return view('user.goalreview.completedtab',$data);
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
        return view('user.goalreview.create',$data); 
    }


    public function list(Request $request)
    { 
        // echo "<pre>";print_r($user->id);die;
        if ($request->ajax()) {
            $user_id = Auth::guard('web')->user()->id;     
            
            // echo "<pre>";print_r($user_id);die;
            $data = GoalReview::with(['user','Goals','reviewCycle','InputTypesData'])->where('employee_id', $user_id)->get(); 
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
                    //  echo "<pre>";print_r($goalsrating);die;
                    $ratingname =  $goalsrating->label;
                    return $ratingname;
                })
                ->addColumn('action', function($row){ 
                    $user = auth()->user();
                    $action = '';
                    if($user->id == $row->employee_id){
                    if($row->self_review == 0){
                        $action = '<a href="'.route('goal-review.respond',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Response</a>';
                    }else{
                        $action = '<a href="'.route('goal-review.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                    }
                }else{
                    if($row->manager_review == 0){
                    $action = '<a href="'.route('goal-review-manager.respond',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Response</a>';
                    }else{
                    $action = '<a href="'.route('goal-review.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                    }
                }

                    // $action = '<a href="'.route('goal-review.respond',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';

                    // $editUrl = route('goal-review.update');
                    // $action =  '<button type="button" onclick = editForm(this,"'.$row->id.'","'. $editUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;';

                    // $deleteUrl = route('goal-review.delete');
                    // $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
                    return $action;
                })
               
                ->rawColumns(['employee_id','input_type_id','review_cycle_id','rating_id','action'])
                ->make(true);
    }
    }
    
     public function Pendinglist(Request $request)
    { 
        if ($request->ajax()) {
            $user_id = Auth::guard('web')->user()->id;     
            
            // echo "<pre>";print_r($user_id);die;
            $data = GoalReview::with(['user','Goals','reviewCycle','InputTypesData'])->where('employee_id', $user_id)->where('self_review', 0)->get(); 
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
                    //  echo "<pre>";print_r($goalsrating);die;
                    $ratingname =  $goalsrating->label;
                    return $ratingname;
                })
                ->addColumn('action', function($row){ 
                    $user = auth()->user();
                    $action = '';
                    if($user->id == $row->employee_id){
                    if($row->self_review == 0){
                        $action = '<a href="'.route('goal-review.respond',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Response</a>';
                    }else{
                        $action = '<a href="'.route('goal-review.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                    }
                }else{
                    if($row->manager_review == 0){
                    $action = '<a href="'.route('goal-review-manager.respond',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Response</a>';
                    }else{
                    $action = '<a href="'.route('goal-review.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                    }
                }
                 return $action;
                })
               
                ->rawColumns(['employee_id','input_type_id','review_cycle_id','rating_id','action'])
                ->make(true);
    }
    }

    public function Completedlist(Request $request)
    {
        if ($request->ajax()) {
            $user_id = Auth::guard('web')->user()->id;     
            
            // $data = GoalReview::with(['user','Goals','reviewCycle','InputTypesData'])->where('employee_id', $user_id)->where('self_review', 1)->get(); 

            $data = GoalReview::with(['User:id,name,manager_id,file_id','User.Profile','reviewcycle','rating.ratingScaleOption','Goals.keyresult','Goals.goalCategory','Goals.reviewCycle','User.Manager:id,name','Competency','responsibility','InputTypesData','development','rating','GoalReviewStore'])->where('employee_id', $user_id)->where('self_review', 1)->get(); 

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
                ->addColumn('manager_rating', function($row){
                    $managerGoalRating = 0;
                    if($row->total_rating_number){
                            $managerGoalRating = $row->total_rating_number;
                    }
                    
                    $manager_rating = number_format($row->manager_average_rating,2) . ' Out of ' .  $managerGoalRating;
                    return $manager_rating;
                })
                ->addColumn('action', function($row){ 
                    $user = auth()->user();
                    $action = '';
                    if($user->id == $row->employee_id){
                    if($row->self_review == 0){
                        $action = '<a href="'.route('goal-review.respond',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Response</a>';
                    }else{
                        if($row->self_review == 1 && $row->manager_review == 1){
                            $action = '<a href="'.route('goal-review.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                        }else{
                            $action = '<a href="#"  class="btn-sm btn btn-outline-warning waves-effect waves-light mr-1">Result Pending</a>';   
                        }
                    }
                }else{
                    if($row->manager_review == 0){
                    $action = '<a href="'.route('goal-review-manager.respond',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Response</a>';
                    }else{
                    $action = '<a href="'.route('goal-review.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                    }
                }
                 return $action;
                })
               
                ->rawColumns(['employee_id','input_type_id','manager_rating','review_cycle_id','rating_id','action'])
                ->make(true);
    }
    }



    public function teamGoalReviewList(Request $request)
    {  
           if ($request->ajax()) {
            $user_id = Auth::guard('web')->user()->id;      
            $data = GoalReview::with(['user','Goals','reviewCycle','InputTypesData'])->where('manager_id',$user_id)->get(); 
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
                    //  echo "<pre>";print_r($goalsrating);die;
                    $ratingname =  $goalsrating->label;
                    return $ratingname;
                })
                ->addColumn('action', function($row){ 
                    $user = auth()->user();
                    $action = '';
                    if($user->id == $row->employee_id){
                    if($row->self_review == 0){
                        $action = '<a href="'.route('goal-review.respond',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Response</a>';
                    }else{
                        $action = '<a href="'.route('goal-review.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                    }
                }else{
                    if($row->manager_review == 0){
                    $action = '<a href="'.route('goal-review-manager.respond',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Response</a>';
                    }else{
                    $action = '<a href="'.route('goal-review.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                    }
                
                }

                    return $action;
                })
               
                ->rawColumns(['employee_id','input_type_id','review_cycle_id','rating_id','action'])
                ->make(true);
    }
    }


    
    /**
     * Store a newly created resource in storage.
     */
   
     public function store(Request $request)
    { //echo "<pre>";print_r($request->toArray());die;
       
        $data['questionnaires'] = $queData =  GoalReview::with(['User:id,name,manager_id','Manager','reviewcycle','rating.ratingScaleOption','Goals.keyresult','Goals.goalCategory','Goals.reviewCycle','Competency','responsibility'])->find($request->gaolreviewID);
        
        $totalGoals = $queData->Goals->where('user_id',$queData->employee_id)->where('review_cycle',$queData->review_cycle_id)->count();
        $totalRatingOption = $queData->rating?->ratingScaleOption->count();
       
        $user_id = Auth::guard('web')->user()->id;

        $goalreview = GoalReview::find($request->gaolreviewID);
        $goals = $request->input('goals'); 
        if (!$request->has('goals') || !is_array($request->input('goals'))) {
            return back()->withErrors(['goals' => 'No goals were submitted. Please fill out the form.']);
        }

        $rules = [];
        foreach ($request->input('goalId') as $goalId) {
            $rules["goals.$goalId.ratings"] = 'required';
        }
        $message = [
            'required' => 'Please select a rating for each goal.',
        ];
        
        $request->validate($rules, $message);
        $validated = $request->validate($rules, $message);
        
        $user_id = Auth::guard('web')->user()->id;
      
            if ($queData->employee_id == $user_id) {
              
                $goals = $request->input('goals');
                $comments = $request->input('comment');
                $totalSumAllGoals = 0;
                foreach($goals as $goalId => $goalrating) {
                    $goalComment = isset($comments[$goalId]['comments']) ? $comments[$goalId]['comments'] : null;                   
                   $ratingEmpDataArray = []; 

                    foreach ($queData->rating->ratingScaleOption as $ratingKey => $Rating) {
                        if ($Rating->option_label == $goalrating['ratings']) {
                            $ratingEmpData = ++$ratingKey;
                            $ratingEmpDataArray[] = $ratingEmpData;
                            break;
                        } else {
                            $ratingEmpData = 0;
                        }
                    }
                    foreach($ratingEmpDataArray as $ratingEmpData){
                        GoalReviewStore::create([
                                'que_employ_value' => $goalrating['ratings'],
                                'employ_id' => $user_id,
                                'goal_id' => $goalId,
                                'manager_id' => $request->managerid,
                                'goal_review_id' => $request->gaolreviewID,
                                'rating_id' => $request->rating_id,
                                'que_self_rating' => $ratingEmpData,
                                'goal_comments' => $goalComment, 
                            ]);
                    }
                  
                    $totalSum = array_sum($ratingEmpDataArray);
                    $totalSumAllGoals += $totalSum;
                    $goalreview->self_review = 1;
                    $goalreview->manager_id = $request->managerid;
                    $goalreview->input_type_name = $request->goal_input_type;
                    $goalreview->self_review_submitted = date("Y-m-d h:i:s A");
                    $goalreview->total_self_rating = $totalSumAllGoals;
                    $goalreview->total_goals = $totalGoals;
                    $goalreview->total_rating_number = $totalGoals;
                    $goalreview->save();
                }
               
                $userdetails = GoalReview::with('user', 'Manager', 'reviewcycle', 'rating','Goals')->where('id', $request->gaolreviewID)->first();
                if (!empty($userdetails->Manager?->email) && $userdetails->sendmail == 1) {
                                Mail::to($userdetails->Manager?->email)->send(new ManagerGoalReviewMail($userdetails));
                                // $emailSent = true; 
                }
                        

                    }elseif ($queData->user->manager_id == $user_id) {    
                        $goals = $request->input('goals');
                        $comments = $request->input('comment');
                        $totalSumAllGoals = 0;
                        foreach ($goals as $goalId => $goalrating) {
                            $goalComment = isset($comments[$goalId]['comments']) ? $comments[$goalId]['comments'] : null;
                            
                            $ratingEmpDataArray = []; 

                            foreach ($queData->rating->ratingScaleOption as $ratingKey => $Rating) {
                                if ($Rating->option_label == $goalrating['ratings']) {
                                    $ratingEmpData = ++$ratingKey;
                                    $ratingEmpDataArray[] = $ratingEmpData;
                                    break;
                                } else {
                                    $ratingEmpData = 0;
                                }
                            }
                            
                            $adminRecords = GoalReviewStore::where('goal_review_id', $queData->id)->where('goal_id' ,$goalId)->where('employ_id',$queData->employee_id)->get();
                            foreach ($adminRecords as $admin) {
                                foreach($ratingEmpDataArray as $ratingEmpData){
                                    $total_ratings = abs($ratingEmpData - $admin->que_self_rating);
                                    $admin->update([
                                        'que_manager_value' => $goalrating['ratings'],
                                        'que_manager_rating' => $ratingEmpData,
                                        'manager_comment' => $goalComment,
                                        'manager_id' => $user_id,
                                        'total_gaps' => $total_ratings
                                    ]);
                                }
                               
                               
                                $goalreview->manager_id = $user_id;
                                $goalreview->manager_review = 1;
                                $goalreview->manager_review_submitted = date("Y-m-d h:i:s A");
                            }
                            $totalSum = array_sum($ratingEmpDataArray);
                            $totalSumAllGoals += $totalSum;
                            $totalRating = $goalreview->total_self_rating;
                            $finalTotalRating = $totalSumAllGoals - $totalRating;
                            $goalreview->total_manager_rating = $totalSumAllGoals;
                            $goalreview->total_gap = abs($finalTotalRating);
                            
                            $totalGoals = $goalreview->total_goals;
                            $average_rating =  $totalSumAllGoals / $totalGoals;
                            $goalreview->manager_average_rating = number_format($average_rating,2);
                            
                            //$ = $goalreview->$totalSumAllGoals;
                            
                            
                        }
                        
                    $goalreview->save();
                 }
                   
         return response()->json([
                'success'=> 1,
                'message'=>"Self-review successfully submit."
            ]);
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
        return view('user.goalreview.update',$data); 
    }

    public function managerResponse(Request $request,$id)
    { 
        $id = decrypt($id);
        $data['title'] = 'Team Goal Review';
        $data['sub_title'] = 'Update';  
        $data['employees'] = User::get();   
        $data['reviewcycles'] = ReviewCycle::get();   
        $data['ratings'] = RatingScale::get();   
        $data['inputtype'] = InputType::get();
        $GoalReviewDataData = GoalReview::find($id);
        // $data['questionnaires'] = $queData =  GoalReview::with(['User:id,name,manager_id,file_id','User.Profile','reviewcycle','rating.ratingScaleOption','Goals.keyresult','Goals.goalCategory','Goals.reviewCycle','User.Manager:id,name,file_id','Competency','InputTypesData'])->find($id);
        $data['questionnaires'] = $queData = GoalReview::with(['User:id,name,manager_id,file_id','User.Profile','reviewcycle','rating.ratingScaleOption','Goals.keyresult','Goals.goalCategory','Goals.reviewCycle','User.Manager:id,name','Competency','responsibility','InputTypesData','development','Goals' => function($query) use ($GoalReviewDataData) {
            $query->whereHas('reviewCycle', function($query) use ($GoalReviewDataData) {
                $query->where('review_cycles.id', $GoalReviewDataData->review_cycle_id);
            });
        }])->find($id);
        $data['uinfo'] = GoalReview::with(['user','Goals','reviewCycle'])->find($id);
        $data['goalreviewstore'] = GoalReviewStore::with('goalsReview')->where('goal_review_id',$id)->get();
        return view('user.goalreview.managerResponse',$data); 
    }

    public function goalResult(Request $request,$id )
    {
        $id = decrypt($id);
       
        $data['title'] = 'Goal Review';
        $data['sub_title'] = 'Update';  
        $data['employees'] = User::get();   
        $data['reviewcycles'] = ReviewCycle::get();   
        $data['ratings'] = RatingScale::get();   
        $data['inputtype'] = InputType::get();
        $data['goalReviewID'] = GoalReviewStore::where('goal_review_id',$id)->get();

        $GoalReviewDataData = GoalReview::find($id);
        // $data['goalresults'] = $queData =  GoalReview::with(['User:id,name,manager_id,file_id','User.Profile','reviewcycle','rating.ratingScaleOption','Goals.keyresult','Goals.goalCategory','Goals.reviewCycle','User.Manager:id,name','Competency','responsibility','InputTypesData','development','rating'])->find($id);
        $data['goalresults'] = $queData = GoalReview::with(['User:id,name,manager_id,file_id','User.Profile','reviewcycle','rating.ratingScaleOption','Goals.keyresult','Goals.goalCategory','Goals.reviewCycle','User.Manager:id,name','Competency','responsibility','InputTypesData','development','Goals' => function($query) use ($GoalReviewDataData) {
            $query->whereHas('reviewCycle', function($query) use ($GoalReviewDataData) {
                $query->where('review_cycles.id', $GoalReviewDataData->review_cycle_id);
            });
        }])->find($id);
        
       
        $data['appraisal_id'] = $id; 
        $data['todayDate'] = Carbon::today()->format("Y-m-d");
        $data['user']  = $userid = Auth::guard('web')->user()->id;
        
        $data['questionnaires'] = $queData = GoalReview::with([
            'User:id,name,manager_id,file_id',
            'User.Profile',
            'reviewcycle',
            'rating.ratingScaleOption',
            'Goals.keyresult',
            'Goals.goalCategory',
            'Goals.reviewCycle',
            'Goals.GoalReviewStore' => function ($query) use ($id) {
                $query->where('goal_review_id', $id);
            },
            'User.Manager:id,name',
            'Competency',
            'responsibility',
            'InputTypesData',
            'development','rating',
            'Goals' => function($query) use ($GoalReviewDataData) {
                $query->whereHas('reviewCycle', function($query) use ($GoalReviewDataData) {
                    $query->where('review_cycles.id', $GoalReviewDataData->review_cycle_id);
                });
            }])->find($id);

          //  echo '<pre>';print_r($queData->toArray());die;
        
        $data['goals'] = Goal::where('user_id',$userid)->get();
        $data['inputtype'] = InputType::get();
    
        return view('user.goalreview.result',$data);
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



    public function result(Request $request, $id )
    { 
        $id = decrypt($id);
         $data['title'] = 'Self-Review';
        $data['sub_title'] = 'Self-Review'; 
        $data['appraisal_id'] = $id; 
        $data['todayDate'] = Carbon::today()->format("Y-m-d");
        $data['user']  = $userid = Auth::guard('web')->user()->id;
        
        // $data['questionnaires'] = $queData =  GoalReview::with(['User:id,name,manager_id,file_id','User.Profile','reviewcycle','rating.ratingScaleOption','Goals.keyresult','Goals.goalCategory','Goals.reviewCycle','User.Manager:id,name','Competency','responsibility','InputTypesData','development'])->find($id);
        $GoalReviewDataData = GoalReview::find($id);

        $data['questionnaires'] = $queData = GoalReview::with(['User:id,name,manager_id,file_id','User.Profile','reviewcycle','rating.ratingScaleOption','Goals.keyresult','Goals.goalCategory','Goals.reviewCycle','User.Manager:id,name','Competency','responsibility','InputTypesData','development','Goals' => function($query) use ($GoalReviewDataData) {
            $query->whereHas('reviewCycle', function($query) use ($GoalReviewDataData) {
                $query->where('review_cycles.id', $GoalReviewDataData->review_cycle_id);
            });
        }])->find($id);
        

        // echo "<pre>";print_r($queData->toArray());die;
        $data['goals'] = Goal::where('user_id',$userid)->get();
        $data['inputtype'] = InputType::get();
        $data['goalreviewstores'] = GoalReviewStore::with('goalsReview')->where('goal_review_id',$id)->get();
         return view('user.goalreview.response',$data); 
            
    }

    public function hrindex()
    {
        $data['title'] = 'Goal Review';
        $data['sub_title'] = 'Goal Review';
       return view('user.hr-goal-review.index',$data);
    }

    public function hrAddGoalReview()
    {
        $data['title'] = 'Goal Review';
        $data['sub_title'] = 'Goal Review'; 
        $data['employees'] = User::get();
        $data['user']  = auth()->user();
        $data['types'] = InputType::get();
        $data['reviewcycles'] = ReviewCycle::get();
        $data['ratings'] = RatingScale::with('ratingScaleOption')->get();
        return view('user.hr-goal-review.create',$data); 
    }

    public function employeelist(Request $request)
    {
      
        if ($request->ajax()) {
            
            $data = GoalReview::with(['user','Goals','reviewCycle','InputTypesData'])->get(); 
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
              
                ->addColumn('action', function($row){ 
                    $editUrl = route('hr.goal-review.update');
                    $action =  '<button type="button" onclick = editForm(this,"'.$row->id.'","'. $editUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;';

                     $deleteUrl = route('goal-review.delete');
                    $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
                    return $action;
                })
               
                ->rawColumns(['employee_id','input_type_id','review_cycle_id','rating_id','action'])
                ->make(true);
    }
    }


    public function hrstoredata(Request $request)
    {
        $user_id = Goal::where('user_id',$request->employee)->get();
        if($request->id){ 
            $id = $request->id;
              request()->validate([
                  'employee' => 'required', 
                  'reviewcycle' => 'required',  
                  'type' => 'required', 
                  'rating' => 'required', 
                
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
              ]);
  
              $emp = GoalReview::create([
                  'employee_id' => $request->employee,    
                  'review_cycle_id' => $request->reviewcycle,
                  'input_type_id' => $request->type,
                  'rating_id' => $request->rating,
                  'goalcomment_id' => $request->comment,
              ]);

              return response()->json([
                  'success'=> 1,
                  'message'=>"Goal Review Insert Successfully."
              ]);
          }
    }

    public function hrUpdateData(Request $request, GoalReview $goalReview)
    {
        $data['title'] = 'Goal Review';
        $data['sub_title'] = 'Update';  
        $data['employees'] = User::get();   
        $data['reviewcycles'] = ReviewCycle::get();   
        $data['ratings'] = RatingScale::get();   
        $data['inputtype'] = InputType::get();

        $data['uinfo'] = GoalReview::with(['user','Goals','reviewCycle'])->find($request->id);
        return view('user.hr-goal-review.update',$data); 
    }



    public function employeePendingReview()
    {
        $data['title'] = 'Tasks';
        $data['sub_title'] = 'Tasks List';
       return view('user.goalreview.managertab.pendinggoaltab',$data);
    }

    public function employeeCompletedReview(){
        $data['title'] = 'Tasks';
        $data['sub_title'] = 'Tasks List';
       return view('user.goalreview.managertab.completedgoaltab',$data);
    }


    public function EmployeeGaolPendinglist(Request $request)
    {  
        if ($request->ajax()) {
            $user_id = Auth::guard('web')->user()->id;     
            
            // echo "<pre>";print_r($user_id);die;
      
            if (auth('web')->user()->hasPermissionTo('hr-employee-goal-review')){
                $data = GoalReview::with(['user','Goals','reviewCycle','InputTypesData'])->where('manager_review',1)
                ->where('self_review',1)->get(); 
            }else{
                $data = GoalReview::with(['user','Goals','reviewCycle','InputTypesData'])->where('manager_id',$user_id)->where('self_review',1)->where('manager_review',0)->get(); 
            }
            
              
            // $data = GoalReview::with(['user','Goals','reviewCycle','InputTypesData'])->where('employee_id', $user_id)->where('self_review', 0)->get(); 
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
                    //  echo "<pre>";print_r($goalsrating);die;
                    $ratingname =  $goalsrating->label;
                    return $ratingname;
                })
                ->addColumn('action', function($row){ 
                    $user = auth()->user();
                    $action = '';
                    if (auth('web')->user()->hasPermissionTo('hr-employee-goal-review')){
                        $action = '<a href="'.route('goal-review.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                    }else{
                    if($user->id == $row->employee_id){
                    if($row->self_review == 0 ){
                        $action = '<a href="'.route('goal-review.respond',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Response</a>';
                    }else{
                        $action = '<a href="'.route('goal-review.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                    }
                }else{
                    if($row->manager_review == 0){
                    $action = '<a href="'.route('goal-review-manager.respond',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Response</a>';
                    }else{
                    $action = '<a href="'.route('goal-review.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                    }
                }
               

                }
                
                 return $action;
                })
               
                ->rawColumns(['employee_id','input_type_id','review_cycle_id','rating_id','action'])
                ->make(true);
    }
    }


    public function EmployeeGoalCompletedlist(Request $request)
    { 
        if ($request->ajax()) {
            $user_id = Auth::guard('web')->user()->id;     
            
            if (auth('web')->user()->hasPermissionTo('hr-employee-goal-review')){
                $data = GoalReview::with(['User:id,name,manager_id,file_id','User.Profile','reviewcycle','rating.ratingScaleOption','Goals.keyresult','Goals.goalCategory','Goals.reviewCycle','User.Manager:id,name','Competency','responsibility','InputTypesData','development','rating','GoalReviewStore'])->where('manager_review',1)->where('self_review', 1)->get(); 
            }else{
                $data = GoalReview::with(['User:id,name,manager_id,file_id','User.Profile','reviewcycle','rating.ratingScaleOption','Goals.keyresult','Goals.goalCategory','Goals.reviewCycle','User.Manager:id,name','Competency','responsibility','InputTypesData','development','rating','GoalReviewStore'])->where('manager_id', $user_id)->where('manager_review',1)->get(); 
            }
         
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
                    //  echo "<pre>";print_r($goalsrating);die;
                    $ratingname =  $goalsrating->label;
                    return $ratingname;
                })
                ->addColumn('manager_rating', function($row){
                    $managerGoalRating = 0;
                    if($row->total_rating_number){
                            $managerGoalRating = $row->total_rating_number;
                    }
                    $manager_rating = number_format($row->manager_average_rating,2) . ' Out of ' .  $managerGoalRating  ?? 0;
                    return $manager_rating;
                })
                ->addColumn('action', function($row){ 
                    $user = auth()->user();
                    $action = '';
                    if($user->id == $row->employee_id){
                    if($row->self_review == 0){
                        $action = '<a href="'.route('goal-review.respond',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Response</a>';
                    }else{
                        if($row->manager_review == 0){
                            $action = '<a href="'.route('goal-review-manager.respond',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Response</a>';
                            }else{
                            $action = '<a href="'.route('goal-review.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                            }
                    }
                }else{
                    if($row->manager_review == 0){
                    $action = '<a href="'.route('goal-review-manager.respond',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Response</a>';
                    }else{
                    $action = '<a href="'.route('goal-review.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                    }
                }
                 return $action;
                })
               
                ->rawColumns(['employee_id','input_type_id','manager_rating','review_cycle_id','rating_id','action'])
                ->make(true);
    }
    }


    public function updatePopStatus(Request $request)
    {
        if($request->type == 0){
            $appraisalData=  GoalReview::find($request->appraisalId);
            $appraisalData->self_popup_date = date('Y/m/d');
            $appraisalData->save();
        }else if($request->type == 1){
            $appraisalData=  GoalReview::find($request->appraisalId);
            $appraisalData->manager_popup_date = date('Y/m/d');
            $appraisalData->save();
        }
    }

    public function goalResultPDF(Request $request)
    { 
      $id = $request->id;
       $data['title'] = 'Goal Review Result';
       $data['goalReviewID'] = GoalReviewStore::where('goal_review_id',$request->id)->get();

       $data['goalresults'] = $queData =  GoalReview::with(['User:id,name,manager_id,file_id','User.Profile','reviewcycle','rating.ratingScaleOption','Goals.keyresult','Goals.goalCategory','Goals.reviewCycle','User.Manager:id,name','Competency','responsibility','InputTypesData','development','rating'])->find($request->id);
       $data['user']  = $userid = Auth::guard('web')->user()->id;
       
       $data['questionnaires'] = $queData = GoalReview::with([
           'User:id,name,manager_id,file_id',
           'User.Profile',
           'reviewcycle',
           'rating.ratingScaleOption',
           'Goals.keyresult',
           'Goals.goalCategory',
           'Goals.reviewCycle',
           'Goals.GoalReviewStore' => function ($query) use ($id) {
               $query->where('goal_review_id', $id);
           },
           'User.Manager:id,name',
           'Competency',
           'responsibility',
           'InputTypesData',
           'development','rating'
       ])->where('self_review',1)->where('manager_review',1)->find($id);
       
       $data['goals'] = Goal::where('user_id',$userid)->get();
      // return view('user.goalreview.pdf.result',$data);
	   
        $pdf = PDF::loadView('user.goalreview.pdf.result',$data);
        // return $pdf->stream('goal-review.pdf');
        return $pdf->download('goal-review.pdf');
      
    }




}



