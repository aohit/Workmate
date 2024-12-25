<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\{Appraisal, QueForm, Questionnaire, ReviewCycle, User};
use GuzzleHttp\Psr7\Query;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PDF; 
use App\Mail\ReviewMail;
use Illuminate\Support\Facades\Mail;

class AppraisalController extends Controller
{
    //
    public function index(): View
    {
        $data['title'] = 'Admin Appraisal';
        $data['sub_title'] = 'Admin Appraisal List';
        $data['appraisal'] = Appraisal::get();
       return view('admin.appraisal.index',$data);
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
     
            $data = Appraisal::get(); 
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function($row){
                   $user = User::where('id',$row->user_id)->select('name')->first();
                    return $user->name;
                })
                ->addColumn('self-review', function($row){
                    if($row->self_review == 0)
                    {
                        $selfReview = '<span class="badge badge-outline-warning text-dark ">Pending</span>';
                    }else{
                        $selfReview = '<span class= "badge badge-outline-success "> Success </span>';
                    }
                     return $selfReview;
                 })
                 ->addColumn('deadline', function($row){
                    $deadline = Carbon::createFromFormat('Y-m-d', $row->self_review_deadline);
                    $formattedDate = $deadline->format('d-m-Y');
                     return $formattedDate;
                 })
                 ->addColumn('manager', function($row){
                    $user = User::where('id',$row->manager_id)->select('name')->first();
                     return $user->name;
                 })
                 ->addColumn('manager-review', function($row){
                    if($row->manager_review == 0)
                    {
                        $managerReview = '<span class= "badge badge-outline-warning text-dark "> Pending</span>';
                    }else{
                        $managerReview = '<span class= "badge badge-outline-success "> Success </span>';
                    }
                     return $managerReview;
                 })
                 ->addColumn('manager-deadline', function($row){
                    $deadline = Carbon::createFromFormat('Y-m-d', $row->manager_review_deadlin);
                    $managerDeadline = $deadline->format('d-m-Y');
                     return $managerDeadline;
                 })
                 ->addColumn('resultshared', function($row){
                    if($row->results_shared == 0)
                    {
                        $resultShared = '<span class= "badge badge-outline-warning text-dark "> Pending responses </span>';
                    }else{
                        $resultShared = '<span class= "badge badge-outline-success "> Success </span>';
                    }
                    return $resultShared;
                })
                ->addColumn('status', function($row){
                    if($row->status == 0)
                    {
                        $status = '<span class= "badge badge-outline-warning text-dark "> Pending  </span>';
                    }else{
                        $status = '<span class= "badge badge-outline-success "> Done </span>';
                    }
                    return $status;
                })
                ->addColumn('sno', function($row){
                       $no=1;
                    return $no++;
                })
                ->addColumn('action', function($row){ 

                    if($row->self_review == 0){
                        $editUrl = route('admin.appraisal.update');
                        $action =  '<button type="button" onclick = editForm("'.$row->id.'","'. $editUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;';
                    }else{
                        $action = '<a class="btn btn-sm  btn-outline-info" href="'.route('admin.appraisal.result',encrypt($row->id)).'"><small>Result</small></a>';
                    }

                    // $deleteUrl = route('admin.admin_user.delete');
                    // $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="d-none btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
                    return $action;
                })
               
                ->rawColumns(['name','self-review','deadline','manager','manager-review','manager-deadline','resultshared','status','sno','action'])
                ->make(true);
        }
    }

    public function create()
    {
        // echo "<pre>"; print_r($id); die;
        $data['title'] = 'Admin Appraisal';
        $data['sub_title'] = 'Create';  
        $data['employee'] = User::get();
        $data['questionnaires'] = QueForm::where('status',1)->get();
        $data['reviewcycles'] = ReviewCycle::where('status',1)->get();
        // echo "<pre>"; print_r($data['reviewcycle']->toArray()); die;
        return view('admin.appraisal.create',$data); 
    }

    public function store(Request $request)
    {
      
        if($request->id){
            // echo "<pre>"; print_r($request->toArray()); die;
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
                // foreach($emplyes as $employee)
                // {
                //     $manager_id = User::where('id',$employee)->first();
                //     $admin = Appraisal::create([
                //     'user_id' => $employee,    
                //     'self_review_deadline' => $request->self_review_deadline,
                //     'manager_id' => $manager_id->manager_id,
                //     'manager_review_deadlin' => $request->manager_review_deadline,
                //     'questionnaire' => $request->questionnaire,
                //     'review_cycle' => $request->reviewcycle,
                // ]);
                // }
                foreach ($emplyes as $employee) {
                    $manager = User::where('id', $employee)->first();
                
                    $admin = Appraisal::create([
                        'user_id' => $employee,
                        'self_review_deadline' => $request->self_review_deadline,
                        'manager_id' => $manager->manager_id,
                        'manager_review_deadlin' => $request->manager_review_deadline,
                        'questionnaire' => $request->questionnaire,
                        'review_cycle' => $request->reviewcycle,
                        'sendmail' => $request->sendmail,
                    ]);
                $userdetails = Appraisal::with('User','Manager','reviewcycle','QuestionnairesData')->where('id' ,$admin->id)->first();
                if (!empty($manager->email)) {
                    if($request->sendmail == 1){
                        Mail::to($manager->email)->send(new ReviewMail($userdetails));
                    }    
                }
                }
                
            return response()->json([
                'success'=> 1,
                'message'=>"Appraisal created successfully."
            ]);
        }
       
    }

    public function update(Request $request)
    {
        $data['title'] = 'Admin Appraisal';
        $data['sub_title'] = 'Update';  
        $data['employee'] = User::get();
        $data['appraisal'] = Appraisal::find($request->id);
        $data['questionnaires'] = QueForm::where('status',1)->get();
        $data['reviewcycles'] = ReviewCycle::where('status',1)->get();
        return view('admin.appraisal.update',$data); 
    }

    public function result($id)
    {
       $id =  decrypt($id);
       $data['title'] = 'Appraisal Result';
       $data['todayDate'] = Carbon::today()->format("Y-m-d");
       $data['user']  =  Auth::guard('admin')->user()->id;
       $data['questionnaires'] = $queData =  Appraisal::with(['User:id,name,file_id','User.Profile','Manager:id,name','reviewcycle','FormQue','FormQue.FormSection','FormQue.FormSection.FormInput','FormQue.FormSection.FormInput.InputType','FormQue.FormSection.FormInput.RatingsData','FormQue.FormSection.FormInput.RatingsData.ratingScaleOption','FormQue.FormSection.FormInput.questionnairesData','FormQue.FormSection.FormInput.FormMultipleInput'])->find($id);
    //    echo "<pre>"; print_r($queData->toArray()); die;
        // $data['questionnaire'] =  Questionnaire::with('username')->where('appraisal_id',$id)->get();
        // echo "<pre>"; print_r($data['questionnaires']->toArray()); die;
        return view('admin.appraisal.result',$data); 
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
      
        $pdf = PDF::loadView('admin.appraisal.pdf.result',$data);
        return $pdf->download('performance-appraisal.pdf');
      
    }



}
