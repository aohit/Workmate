<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\{Appraisal, QueForm, Questionnaire, User};
use Carbon\Carbon;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use App\Mail\EmployeeMail;
use PDF;
use Mail;
use App\Mail\ManagerReviewMail;

class AppraisalController extends Controller
{
    //
    public function index(): View
    {
         $data['title'] = 'Performance Questionnaires';
        $data['sub_title'] = 'My Performance List';
       return view('user.appraisal.index',$data);
    }

    public function appraisalindex()
    {
        $data['title'] = 'Team Performance';
        $data['sub_title'] = 'Team Performance List';
       return view('user.appraisal.appraisalIndex',$data);
    }

    public function pendingTask()
    {
        $data['title'] = 'Tasks';
        $data['sub_title'] = 'Tasks List';
       return view('user.appraisal.task.pending',$data);
    }

    public function completedTask(){
        $data['title'] = 'Tasks';
        $data['sub_title'] = 'Tasks List';
       return view('user.appraisal.task.completed',$data);
    }

    public function AppraisalList(Request $request)
    {
        if ($request->ajax()) {
            $user = auth()->user();
            if(auth('web')->user()->HasRole('HR')){
                $data = Appraisal::where('self_review',1)->orderBy('updated_at','DESC')->get();
              } else{ 
              if(auth('web')->user()->hasPermissionTo('creat-appraisal') || (auth('web')->user()->hasPermissionTo('respond-on-appraisal'))){
                $data = Appraisal::where('user_id',$user->id)->orwhere('manager_id',$user->id)->where('self_review',1)->orderBy('updated_at','DESC')->get();
              }else{ 
                    $data = Appraisal::where('user_id',$user->id)->orderBy('updated_at','DESC')->get();
               }
            }
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function($row){
                   $user = User::where('id',$row->user_id)->select('name')->first();
                    return ucwords($user->name);
                })

                ->addColumn('reviewcycle', function($row){
                    if($row->review_cycle == 1){
                        $reviewcycle = '<span> Mid year review </span>';
                    }else{
                        $reviewcycle = '<span>Yearly review</span>';
                    }
                    return $reviewcycle;
                })
           
                 ->addColumn('deadline', function($row){
                    if(auth('web')->user()->hasPermissionTo('respond-on-appraisal')){  
                        return $row->manager_review_deadlin;
                    }else{
                        return $row->self_review_deadline;
                    }
                 })
                
                 ->addColumn('updated_at', function($row){
                     $updated_at = '<p class="badge bg-dark">'.$row->updated_at->diffForHumans().'</p>';
                     return $updated_at;
                 })
                ->addColumn('action', function($row) use($user) { 
                    $edit='';  $action='';
                        // if(auth('web')->user()->hasPermissionTo('edit-appraisal')){

                        //     if($user->id == $row->user_id){

                        //         if($row->self_review == 1){

                        //                 if($row->results_shared == 1){
                        //                     $action = '<a href="'.route('user.appraisal.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                        //                 }else{
                        //                     $action = '<a href="#"  class="btn-sm btn btn-outline-warning waves-effect waves-light mr-1">Result Pending</a>';   
                        //                 }

                        //             }else{
                        //                 $action = '<a href="'.route('user.appraisal.create',encrypt($row->id)).'"  class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Respond</a>';
                        //             }

                        //     }else{
                        //         if($row->self_review == 0){
                        //             $editUrl = route('user.appraisal.update');
                        //             $edit =  '<button type="button" onclick = editForm("'.$row->id.'","'. $editUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;';
                        //         }else{
                        //             $action = '<a href="'.route('user.appraisal.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                        //         }

                        //     }
                        // }else 
                        if(auth('web')->user()->hasPermissionTo('respond-on-appraisal')){

                            if($user->id == $row->user_id){

                                if($row->self_review == 1){

                                    if($row->results_shared == 1){
                                        $action = '<a href="'.route('user.appraisal.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                                    }else{
                                        if($user->id == $row->manager_id){
                                            if($row->manager_review == 1){
                                                $action = '<a href="'.route('user.appraisal.result', encrypt($row->id)).'" class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">'. ($row->results_shared == 1 ? 'Response' : 'Share Response') .'</a>';
                                            }else{
                                                $action = '<a href="'.route('user.appraisal.create',encrypt($row->id)).'"  class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Response</a>';
                                                }
                                        }else{
                                            $action = '<a href="#"  class="btn-sm btn btn-outline-warning waves-effect waves-light mr-1">Result Pending</a>';   
                                        }
                                    }

                                }else{
                                    $action = '<a href="'.route('user.appraisal.create',encrypt($row->id)).'"  class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">manager</a>';
                                    }

                            }else{
                                
                                if($row->manager_review == 1){
                                    $action = '<a href="'.route('user.appraisal.result', encrypt($row->id)).'" class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">'. ($row->results_shared == 1 ? 'Response' : 'Share Response') .'</a>';
                                }else{
                                    $action = '<a href="'.route('user.appraisal.create',encrypt($row->id)).'"  class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Response</a>';
                                    }
                            } 
                            
                        }else{
                            if($row->self_review == 1)
                            {
                                if($row->results_shared == 1){
                                    $action = '<a href="'.route('user.appraisal.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                                }else{
                                    $action = '<a href="#"  class="btn-sm btn btn-outline-warning waves-effect waves-light mr-1">Result Pending</a>';   
                                }
                            }else{
                                // $action = '<a href="'.route('user.appraisal.create',encrypt($row->id)).'"  class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Respond</a>';
                                if (auth('web')->user()->hasPermissionTo('hr-team-performance')){
                                    $action = '<a href="'.route('user.appraisal.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                                }else{
                                    $action = '<a href="'.route('user.appraisal.create',encrypt($row->id)).'"  class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Respond</a>';
                                }
                            }
                        }

                    return $edit.$action;
                })
               
                ->rawColumns(['name','reviewcycle','deadline','updated_at','action'])
                ->make(true);
        }
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $user = auth()->user();
            // if(auth('web')->user()->hasRole('Manager')){    
            //     $data = Appraisal::where('user_id',$user->id)->orwhere('manager_id',$user->id)->where('self_review',1)->get();
            // }else if(auth('web')->user()->hasRole('Employee')){
            //     $data = Appraisal::where('user_id',$user->id)->get();
            // }else if(auth('web')->user()->hasRole('HR')){
            //     $data = Appraisal::where('user_id',$user->id)->get();
            // }else if(auth('web')->user()->hasPermissionTo('creat-appraisal')){
            //     $data = Appraisal::get();
            // }

            // if(auth('web')->user()->hasPermissionTo('respond-on-appraisal')){
            //     $data = Appraisal::where('user_id',$user->id)->orwhere('manager_id',$user->id)->where('self_review',1)->where('manager_review',0)->get();
            // }else{
                $data = Appraisal::where('user_id',$user->id)->where('self_review',0)->orderBy('updated_at','DESC')->get();
            // }
            // echo "<pre>"; print_r($data->toArray()); die;
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function($row){
                   $user = User::where('id',$row->user_id)->select('name')->first();
                    return ucwords($user->name);
                })

                ->addColumn('reviewcycle', function($row){
                    if($row->review_cycle == 1){
                        $reviewcycle = '<span> Mid year review </span>';
                    }else{
                        $reviewcycle = '<span>Yearly review</span>';
                    }
                    return $reviewcycle;
                })
           
                 ->addColumn('deadline', function($row){
                    if(auth('web')->user()->hasPermissionTo('respond-on-appraisal')){  
                        return $row->manager_review_deadlin;
                    }else{
                        return $row->self_review_deadline;
                    }
                 })
                
                 ->addColumn('updated_at', function($row){
                     $updated_at = '<p class="badge bg-dark">'.$row->updated_at->diffForHumans().'</p>';
                     return $updated_at;
                 })
                ->addColumn('action', function($row) use($user) { 
                    $edit='';  $action='';
                        if(auth('web')->user()->hasPermissionTo('edit-appraisal')){

                            if($user->id == $row->user_id){

                                if($row->self_review == 1){

                                        if($row->results_shared == 1){
                                            $action = '<a href="'.route('user.appraisal.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                                        }else{
                                            $action = '<a href="#"  class="btn-sm btn btn-outline-warning waves-effect waves-light mr-1">Result Pending</a>';   
                                        }

                                    }else{
                                        $action = '<a href="'.route('user.appraisal.create',encrypt($row->id)).'"  class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Respond</a>';
                                    }

                            }else{
                                if($row->self_review == 0){
                                    $editUrl = route('user.appraisal.update');
                                    $edit =  '<button type="button" onclick = editForm("'.$row->id.'","'. $editUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;';
                                }else{
                                    $action = '<a href="'.route('user.appraisal.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                                }

                            }
                        }else if(auth('web')->user()->hasPermissionTo('respond-on-appraisal')){

                            if($user->id == $row->user_id){

                                if($row->self_review == 1){

                                    if($row->results_shared == 1){
                                        $action = '<a href="'.route('user.appraisal.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                                    }else{
                                        if($user->id == $row->manager_id){
                                            if($row->manager_review == 1){
                                                $action = '<a href="'.route('user.appraisal.result', encrypt($row->id)).'" class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">'. ($row->results_shared == 1 ? 'Response' : 'Share Response') .'</a>';
                                            }else{
                                                $action = '<a href="'.route('user.appraisal.create',encrypt($row->id)).'"  class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Response</a>';
                                                }
                                        }else{
                                            $action = '<a href="#"  class="btn-sm btn btn-outline-warning waves-effect waves-light mr-1">Result Pending</a>';   
                                        }
                                    }

                                }else{
                                    $action = '<a href="'.route('user.appraisal.create',encrypt($row->id)).'"  class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">manager</a>';
                                    }

                            }else{
                                
                                if($row->manager_review == 1){
                                    $action = '<a href="'.route('user.appraisal.result', encrypt($row->id)).'" class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">'. ($row->results_shared == 1 ? 'Response' : 'Share Response') .'</a>';
                                }else{
                                    $action = '<a href="'.route('user.appraisal.create',encrypt($row->id)).'"  class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Response</a>';
                                    }
                            } 
                            
                        }else{
                            if($row->self_review == 1)
                            {
                                if($row->results_shared == 1){
                                    $action = '<a href="'.route('user.appraisal.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                                }else{
                                    $action = '<a href="#"  class="btn-sm btn btn-outline-warning waves-effect waves-light mr-1">Result Pending</a>';   
                                }
                            }else{
                                $action = '<a href="'.route('user.appraisal.create',encrypt($row->id)).'"  class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Respond</a>';
                            }
                        }

                    return $edit.$action;
                })
               
                ->rawColumns(['name','reviewcycle','deadline','updated_at','action'])
                ->make(true);
        }
    }

    public function completedlist(Request $request)
    {
        if ($request->ajax()) {
            $user = auth()->user();
            // if(auth('web')->user()->hasRole('Manager')){    
            //     $data = Appraisal::where('user_id',$user->id)->orwhere('manager_id',$user->id)->where('self_review',1)->get();
            // }else if(auth('web')->user()->hasRole('Employee')){
            //     $data = Appraisal::where('user_id',$user->id)->get();
            // }else if(auth('web')->user()->hasRole('HR')){
            //     $data = Appraisal::where('user_id',$user->id)->get();
            // }else if(auth('web')->user()->hasPermissionTo('creat-appraisal')){
            //     $data = Appraisal::get();
            // }

            // if(auth('web')->user()->hasPermissionTo('respond-on-appraisal')){
            //     $data = Appraisal::where('user_id',$user->id)->orwhere('manager_id',$user->id)->where('self_review',1)->where('manager_review',1)->get();
            // }else{
                $data = Appraisal::where('user_id',$user->id)->where('self_review',1)->orderBy('updated_at','DESC')->get();
            // }
            // echo "<pre>"; print_r($data->toArray()); die;
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function($row){
                   $user = User::where('id',$row->user_id)->select('name')->first();
                    return ucwords($user->name);
                })

                ->addColumn('reviewcycle', function($row){
                    if($row->review_cycle == 1){
                        $reviewcycle = '<span> Mid year review </span>';
                    }else{
                        $reviewcycle = '<span>Yearly review</span>';
                    }
                    return $reviewcycle;
                })
           
                 ->addColumn('deadline', function($row){
                    if(auth('web')->user()->hasPermissionTo('respond-on-appraisal')){  
                        return $row->manager_review_deadlin;
                    }else{
                        return $row->self_review_deadline;
                    }
                 })
                 ->addColumn('updated_at', function($row){
                    $updated_at = '<p class="badge bg-dark">'.$row->updated_at->diffForHumans().'</p>';
                    return $updated_at;
                })
                ->addColumn('action', function($row) use($user) { 
                    $edit='';  $action='';
                        if(auth('web')->user()->hasPermissionTo('edit-appraisal')){

                            if($user->id == $row->user_id){

                                if($row->self_review == 1){

                                        if($row->results_shared == 1){
                                            $action = '<a href="'.route('user.appraisal.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                                        }else{
                                            $action = '<a href="#"  class="btn-sm btn btn-outline-warning waves-effect waves-light mr-1">Result Pending</a>';   
                                        }

                                    }else{
                                        $action = '<a href="'.route('user.appraisal.create',$row->id).'"  class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Respond</a>';
                                    }

                            }else{
                                if($row->self_review == 0){
                                    $editUrl = route('user.appraisal.update');
                                    $edit =  '<button type="button" onclick = editForm("'.$row->id.'","'. $editUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;';
                                }else{
                                    $action = '<a href="'.route('user.appraisal.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                                }

                            }
                        }else if(auth('web')->user()->hasPermissionTo('respond-on-appraisal')){

                            if($user->id == $row->user_id){

                                if($row->self_review == 1){

                                    if($row->results_shared == 1){
                                        $action = '<a href="'.route('user.appraisal.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                                    }else{
                                        if($user->id == $row->manager_id){
                                            if($row->manager_review == 1){
                                                $action = '<a href="'.route('user.appraisal.result', encrypt($row->id)).'" class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">'. ($row->results_shared == 1 ? 'Response' : 'Share Response') .'</a>';
                                            }else{
                                                $action = '<a href="'.route('user.appraisal.create',$row->id).'"  class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Response</a>';
                                                }
                                        }else{
                                            $action = '<a href="#"  class="btn-sm btn btn-outline-warning waves-effect waves-light mr-1">Result Pending</a>';   
                                        }
                                    }

                                }else{
                                    $action = '<a href="'.route('user.appraisal.create',$row->id).'"  class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">manager</a>';
                                    }

                            }else{
                                
                                if($row->manager_review == 1){
                                    $action = '<a href="'.route('user.appraisal.result', encrypt($row->id)).'" class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">'. ($row->results_shared == 1 ? 'Response' : 'Share Response') .'</a>';
                                }else{
                                    $action = '<a href="'.route('user.appraisal.create',$row->id).'"  class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Response</a>';
                                    }
                            } 
                            
                        }else{
                            if($row->self_review == 1)
                            {
                                if($row->results_shared == 1){
                                    $action = '<a href="'.route('user.appraisal.result',encrypt($row->id)).'"  class="btn-sm btn btn-outline-success waves-effect waves-light mr-1">Result</a>';
                                }else{
                                    $action = '<a href="#"  class="btn-sm btn btn-outline-warning waves-effect waves-light mr-1">Result Pending</a>';   
                                }
                            }else{
                                $action = '<a href="'.route('user.appraisal.create',$row->id).'"  class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Respond</a>';
                            }
                        }

                    return $edit.$action;
                })
               
                ->rawColumns(['name','reviewcycle','deadline','updated_at','action'])
                ->make(true);
        }
    }

    public function genrate()
    {
        // echo "<pre>"; print_r($id); die;
        $data['title'] = 'Team Performance';
        $data['sub_title'] = 'Launch Appraisal';  
        $data['employee'] = User::where('id','!=',Auth::user()->id)->get();
        $data['questionnaires'] = QueForm::where('status',1)->get();
    
        return view('user.appraisal.createAppraisal',$data); 
    }

    public function update(Request $request)
    {
        $data['title'] = 'Team Performance';
        $data['sub_title'] = 'Update';  
        $data['employee'] = User::get();
        $data['questionnaires'] = QueForm::where('status',1)->get();
        $data['appraisal'] = Appraisal::find($request->id);

        return view('user.appraisal.update',$data); 
    }

    public function storeCreateAppraisal(Request $request)
    {
        // echo "<pre>"; print_r($request->toArray()); die;
            if($request->id){
                $id = $request->id;
                request()->validate([
                    'employeename' => 'required', 
                    'self_review_deadline' => 'required', 
                    'manager_review_deadline' => 'required', 
                    'questionnaire' => 'required', 
                    'reviewcycle' => 'required', 
                ]);
                    $admin = Appraisal::find($id);
                    
                    $user = User::where('id',$request->employeename)->first();
                        $admin->update([
                            'user_id' => $request->employeename,    
                            'self_review_deadline' => $request->self_review_deadline,
                            'manager_id' => $user->manager_id,
                            'manager_review_deadlin' => $request->manager_review_deadline,
                            'questionnaire' => $request->questionnaire,
                            'review_cycle' => $request->reviewcycle,
                            'session_id' => session('sessionId'),
                        ]);     
    
               
    
                return response()->json([
                    'success'=> 1,
                    'message'=>"Admin Profile Updated successfully."
                ]);
               
            }else{
                request()->validate([
                    'employeename.*' => 'required', 
                    'self_review_deadline' => 'required', 
                    'manager_review_deadline' => 'required', 
                    'questionnaire' => 'required', 
                    'reviewcycle' => 'required', 
                ]);
    
                    $emplyes = $request->employeename;
                    foreach($emplyes as $employee)
                    {
                        $manager_id = User::where('id',$employee)->first();
                        $admin = Appraisal::create([
                        'user_id' => $employee,    
                        'self_review_deadline' => $request->self_review_deadline,
                        'manager_id' => $manager_id->manager_id,
                        'manager_review_deadlin' => $request->manager_review_deadline,
                        'questionnaire' => $request->questionnaire,
                        'review_cycle' => $request->reviewcycle,
                        'session_id' => session('sessionId'),
                    ]);
                    }
    
                    
                return response()->json([
                    'success'=> 1,
                    'message'=>"Appraisal created successfully."
                ]);
            }
           
    }

    public function create(Request $request, $id )
    {
        $id = decrypt($id);
         $data['title'] = 'Self-Review';
        $data['sub_title'] = 'Self-Review'; 
        $data['appraisal_id'] = $id; 
        $data['todayDate'] = Carbon::today()->format("Y-m-d");
        $data['user']  =  Auth::guard('web')->user()->id;
        // $data['questionnaires'] = $queData =  Appraisal::with(['User:id,name','Manager:id,name','QuestionnairesData','QuestionnairesData.InputsData','QuestionnairesData.InputsData.InputType','QuestionnairesData.InputsData.FormMultipleInput','FormQue','FormQue.FormSection','FormQue.FormSection.FormInput','FormQue.FormSection.FormInput.InputType','FormQue.FormSection.FormInput.FormMultipleInput'])->find($id);
         $data['questionnaires'] = $queData =  Appraisal::with(['User:id,name,file_id','User.Profile','Manager:id,name','reviewcycle','FormQue','FormQue.FormSection','FormQue.FormSection.FormInput','FormQue.FormSection.FormInput.RatingsData','FormQue.FormSection.FormInput.RatingsData.ratingScaleOption','FormQue.FormSection.FormInput.InputType','FormQue.FormSection.FormInput.questionnairesData','FormQue.FormSection.FormInput.FormMultipleInput'])->find($id);
        // echo "<pre>"; print_r($queData->toArray()); die;
       $ques = Questionnaire::with('username')->where('appraisal_id',$id)->first();
            //    echo "<pre>"; print_r($ques->toArray()); die;
            if($queData->self_review == 0){
                return view('user.appraisal.create',$data); 
            }else{

                return view('user.appraisal.managerResponse',$data); 
            }
    }

    public function store(Request $request)
    {
        $Queform = QueForm::with(['FormSection','FormSection.FormInput','FormSection.FormInput.RatingsData','FormSection.FormInput.RatingsData.ratingScaleOption'])->find($request->formQueID);
        $appraisal = Appraisal::find($request->appraisal_id);
        $user_id = Auth::guard('web')->user()->id;
        // echo "<pre>"; print_r($user_id ); 
        
        $rules = [];
        $massages = [];
        foreach ($Queform->FormSection as $formSectionval) {
            $sec_idval = $formSectionval->sec_id;
            if($formSectionval->FormInput){
                foreach ( $formSectionval->FormInput as $formInputsval) {
                        $rules += [
                            $sec_idval.'.'.$formInputsval->id => 'required',
                        ];
                        $massages += [
                            $sec_idval.'.'.$formInputsval->id => "The above field is required.",
                        ]; 
                    // }
                }
            }
        }

        $validatedData = $request->validate($rules,$massages);
        // echo "<pre>"; print_r($inputname->InputType->type); die;
        $emailSent = false; 
        
            foreach ($Queform->FormSection as $formSection) {
                $sec_id = $formSection->sec_id;

                    foreach ($request->$sec_id as $key => $formInputs) {

                        if(is_array($formInputs)){
                          $formInputs =  implode(',',$formInputs); 
                        }
                        $questionnaireData = [
                            'appraisal_id' => $appraisal->id,
                            'que_key' => $key,
                        ];

                        if($appraisal->user_id == $user_id && $appraisal->manager_id == $user_id){
                            if( $appraisal->self_review == 1){
                                $questionnaireData['que_manager_value'] = $formInputs;
                                $questionnaireData['manager_id'] =$user_id;
                                $appraisal->manager_review =1;
                                $appraisal->status =1; 
                                $appraisal->manager_review_submited = date("Y-m-d h:i:s A"); 
                                
                                foreach($formSection->FormInput as $queInputs){
                                    if($queInputs->id == $key && $queInputs->rating_id != '' ){
                                        foreach($queInputs->RatingsData->ratingScaleOption as $ratingKey => $Rating){
                                            if($Rating->option_label == $formInputs){
                                                $questionnaireData['que_self_rating'] = ++$ratingKey;
                                                break;
                                            }else{
                                                $questionnaireData['que_self_rating'] =0;
                                            }    
                                        }
                                    } 
                                }

                            }else{
                                $questionnaireData['que_employ_value'] = $formInputs;
                                $questionnaireData['employ_id'] =$user_id;
                                $appraisal->self_review =1;
                                $appraisal->self_review_submited = date("Y-m-d h:i:s A");

                                foreach($formSection->FormInput as $queInputs){
                                    if($queInputs->id == $key && $queInputs->rating_id != '' ){
                                        foreach($queInputs->RatingsData->ratingScaleOption as $ratingKey => $Rating){
                                            if($Rating->option_label == $formInputs){
                                                $questionnaireData['que_self_rating'] = ++$ratingKey;
                                                break;
                                            }else{
                                                $questionnaireData['que_self_rating'] =0;
                                            }   
                                        }
                                    } 
                                }

                            }
                        }else{
                            
                        if ($appraisal->user_id == $user_id) {
                            $questionnaireData['que_employ_value'] = $formInputs;
                            $questionnaireData['employ_id'] =$user_id;
                            $appraisal->self_review =1;
                            $appraisal->self_review_submited = date("Y-m-d h:i:s A"); 

                                    foreach($formSection->FormInput as $queInputs){
                                        if($queInputs->id == $key && $queInputs->RatingsData?->ratingScaleOption != '' ){
                                            foreach($queInputs->RatingsData?->ratingScaleOption as $ratingKey => $Rating){
                                                if($Rating->option_label == $formInputs){
                                                 
                                                    $questionnaireData['que_self_rating'] = ++$ratingKey;
                                                    break;
                                                    
                                                }else{
                                                    $questionnaireData['que_self_rating'] =0;
                                                }    
                                            }
                                        } 
                                    }

                                    if (!$emailSent) {
                                        $userdetails = Appraisal::with('User', 'Manager', 'reviewcycle', 'QuestionnairesData')->where('id', $appraisal->id)->first();
                                        if (!empty($userdetails->Manager?->email) && $userdetails->sendmail == 1) {
                                            Mail::to($userdetails->Manager?->email)->send(new ManagerReviewMail($userdetails));
                                            $emailSent = true; 
                                        }
                                    }

                        } elseif ($appraisal->manager_id == $user_id) {
                            $questionnaireData['que_manager_value'] = $formInputs;
                            $questionnaireData['manager_id'] =$user_id;
                            $appraisal->manager_review =1;
                            $appraisal->status =1;
                            $appraisal->manager_review_submited = date("Y-m-d h:i:s A"); 

                            foreach($formSection->FormInput as $queInputs){
                                if($queInputs->id == $key && @$queInputs->RatingsData->ratingScaleOption != '' ){
                                    foreach(@$queInputs->RatingsData->ratingScaleOption as $ratingKey => $Rating){
                                        if($Rating->option_label == $formInputs){
                                            //    echo "<pre>"; print_r($formInputs);
                                            $questionnaireData['que_manager_rating'] = ++$ratingKey;
                                            break;
                                        }else{
                                            $questionnaireData['que_manager_rating'] =0;
                                        }    
                                    }
                                } 
                            }
                        }
                    }
                $questionnaire = Questionnaire::updateOrCreate(
                   ['appraisal_id' => $appraisal->id, 'que_key' => $key],
                    $questionnaireData
                );
                     if($appraisal->manager_id == $user_id){
                         $AppraisalRatings = Questionnaire::where('appraisal_id', $appraisal->id)
                         ->where('employ_id', $appraisal->user_id)->get();
                          
                          $totalSelfRating = 0;
                          $totalManagerRating = 0;
                          $totalGap = 0;
                          
                    foreach ($AppraisalRatings as $AppraisalRating) {
                              $selfRating = $AppraisalRating->que_self_rating;
                              $managerRating = $AppraisalRating->que_manager_rating;
                          
                              $gap = $managerRating - $selfRating;
                          
                              $AppraisalRating->update([
                                  'total_gaps' => abs($gap),
                              ]);
                          
                              $totalSelfRating += $selfRating;
                              $totalManagerRating += $managerRating;
                              $totalGap += $gap;
                     }
                          $appraisal->total_self_rating = $totalSelfRating;
                          $appraisal->total_manager_rating = $totalManagerRating;
                          $appraisal->total_gap = $totalGap; 
      
                      }
                        $appraisal->save();
                    }
            }
          
            return response()->json([
                'success'=> 1,
                'message'=>"Self-review successfully submit."
            ]);


        // }
    }

    public function result($id)
    {
       $id =  decrypt($id);
       $data['title'] = 'Team Performance Result';
       $data['todayDate'] = Carbon::today()->format("Y-m-d");
       $data['user']  =  Auth::guard('web')->user()->id;
       $data['questionnaires'] = $queData =  Appraisal::with(['User:id,name,file_id','User.Profile','Manager:id,name','reviewcycle','FormQue','FormQue.FormSection','FormQue.FormSection.FormInput','FormQue.FormSection.FormInput.InputType','FormQue.FormSection.FormInput.RatingsData','FormQue.FormSection.FormInput.RatingsData.ratingScaleOption','FormQue.FormSection.FormInput.questionnairesData','FormQue.FormSection.FormInput.FormMultipleInput'])->find($id);
    //    echo "<pre>"; print_r($queData->toArray()); die;
        // $data['questionnaire'] =  Questionnaire::with('username')->where('appraisal_id',$id)->get();
        // echo "<pre>"; print_r($data['questionnaires']->toArray()); die;
        return view('user.appraisal.result',$data); 
    }

    public function shareResult(Request $request)
    {
        $appraisal =  Appraisal::with('User','Manager')->find($request->id);
        $appraisal->results_shared =1;
        $appraisal->save();
        // $this->SendEmailToEmployee($appraisal);
        return response()->json([
            'success'=> 1,
            'message'=>"Successfully share."
        ]);
    }

    public function updatePopStatus(Request $request)
    {
        if($request->type == 0){
            $appraisalData=  Appraisal::find($request->appraisalId);
            $appraisalData->self_popup_date = date('Y/m/d');
            $appraisalData->save();
        }else if($request->type == 1){
            $appraisalData=  Appraisal::find($request->appraisalId);
            $appraisalData->manager_popup_date = date('Y/m/d');
            $appraisalData->save();
        }
    }

    public function appraisalPDF(Request $request)
    {   

       $data['title'] = 'Appraisal Result';
       $data['todayDate'] = Carbon::today()->format("Y-m-d");
       $data['user']  =  Auth::guard('web')->user();
       $data['empperfom'] = $request->empperfom;
       $data['managerperfom'] = $request->managerperfom;
       $data['totalrating'] = $request->totalrating;
       $data['questionnaires'] = $queData =  Appraisal::with(['User:id,name','Manager:id,name','reviewcycle','FormQue','FormQue.FormSection','FormQue.FormSection.FormInput','FormQue.FormSection.FormInput.InputType','FormQue.FormSection.FormInput.RatingsData','FormQue.FormSection.FormInput.RatingsData.ratingScaleOption','FormQue.FormSection.FormInput.questionnairesData','FormQue.FormSection.FormInput.FormMultipleInput'])->find($request->id);
      
        $pdf = PDF::loadView('user.appraisal.pdf.result',$data);
        return $pdf->download('performance-appraisal.pdf');
      
    }

    public function SendEmailToEmployee($data)
    {
         $route = route('user.appraisal');
        Mail::to($data->User->email)->send(new EmployeeMail($data,$route));
          return true; 
    }

    public function AppraisalRatingData(){
       
        $appraisals = Appraisal::with('questionnaires')->get();

        foreach($appraisals as $appraisal) {
           
            $totalSelfRating = $totalManagerRating = $totalGap =  0;
        
            foreach($appraisal->questionnaires as $questionnaire) {
                
                $totalSelfRating += $questionnaire->que_self_rating;
                $totalManagerRating += $questionnaire->que_manager_rating;
                $totalGap = $totalManagerRating - $totalSelfRating;
            }
           
            $appraisal->total_self_rating = $totalSelfRating;
            $appraisal->total_manager_rating = $totalManagerRating;
            $appraisal->total_gap = $totalGap;
            $appraisal->save();
        
        }
        
    }


}