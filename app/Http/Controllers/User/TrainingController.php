<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\{Training, User};
use Carbon\Carbon;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;


class TrainingController extends Controller
{

    public function index(): View
    {
        $data['title'] = 'Team Training';
        $data['sub_title'] = 'my training';
       return view('user.training.index',$data);
    }

    public function list(Request $request)
    { 
        if ($request->ajax()) {
            if(auth('web')->user()->hasPermissionTo('creat-training')){

                $data = Training::with('user')->get(); 
            }else{
                $data = Training::with('user')->where('user_id',Auth::guard('web')->user()->id)->get(); 

            }
          $no=1;
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('sr.no', function($row) use($no){
                     $no++;
                        return $no;
                    }) 
                    ->addColumn('name', function($row){
                        $name =  $row->user->name;
                        return $name;
                    }) 
                    ->addColumn('completion_date', function($row){ 

                        $completion_date =  $row->completion_date;
                        return $completion_date;
                    })
                    ->addColumn('title', function($row){
                        $title =  $row->title;
                        return $title;
                    }) 
                    ->addColumn('institution_or_training_provider', function($row){
                        $institution_or_training_provider =  $row->institution_or_training_provider;
                        return $institution_or_training_provider;
                    }) 

                    ->addColumn('trainingstatus', function($row){ 

                        $statusUrl = route('user.training-status'); 

                        if($row->status == 0){
                            $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",2) class=" btn-sm btn btn-soft-secondary rounded-pill waves-effect waves-light  p-1 fs-6 ">In-Progress</button>';
                        }elseif($row->status == 2){
                            $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",1)  class=" btn-sm btn btn-soft-danger rounded-pill waves-effect waves-light  p-1 fs-6 ">Delayed</button>';
                        }else if($row->status == 1){
                            $status =  '<button type="button"  class=" btn-sm btn btn-soft-success rounded-pill waves-effect waves-light  p-1 fs-6">Completed</button>';
                        }
                         
                        return $status;
                    })

                    ->addColumn('trainingobject', function($row){ 

                        $description =  $row->description;
                        return $description;
                    })

                    ->addColumn('start_date', function($row){ 

                        $start_date =  $row->start_date;
                        return $start_date;
                    })

                    ->addColumn('certificate', function($row){ 
                        $certificate ="";
                        if($row->certificate == 1)
                        {
                           $certificate = '<i class="fa fa-check text-success" aria-hidden="true"></i>';
                        }
                        return $certificate;
                    })
                    ->addColumn('end_date', function($row){ 
                        $endTime =  $row->end_time;
                        return $endTime;
                        })
                        ->addColumn('updated_at', function($row){ 
                        $updated_at =  date('Y-m-d H:i:s',strtotime($row->updated_at));
                    //    date('Y-m-d H:i:s');
                        return $updated_at;
                    })
                    ->addColumn('action', function($row){ 
                        $editUrl = route('user.training-update');
                        $deleteUrl = route('user.training-delete'); 
                            $action =  '<button type="button" onclick = editForm(this,"'.$row->id.'","'. $editUrl .'") class=" btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;'; 
                            $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class=" btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>'; 
                        return $action;
                    })

                    ->rawColumns(['sr.no','name','institution_or_training_provider','title','trainingstatus','trainingobject','start_date','certificate','end_date','updated_at','action','completion_date'])
                    ->make(true);
        }

    }

    public function create()
    {
        $data['title'] = 'My Training';
        $data['sub_title'] = 'Add';  
        $data['users'] = User::get();
        $data['employee_data'] = auth('web')->user();
        if(auth('web')->user()->hasPermissionTo('creat-training')){   
            $data['users'] = User::where('manager_id',Auth::guard('web')->user()->id)->get();             
           return view('user.training.createall',$data); 
        }else{ 
            $data['users'] = User::get();
            return view('user.training.create',$data); 
        }
    }

    public function createMy()
    {
        $data['title'] = 'My Training';
        $data['sub_title'] = 'Add';         
        $data['employee_data'] = auth('web')->user();
        if(auth('web')->user()->hasPermissionTo('creat-training')){                      
            $data['users'] = User::where('id',Auth::guard('web')->user()->id)->first();
            return view('user.training.createmy',$data); 
        }else{           
            $data['users'] = User::get();
            return view('user.training.create',$data); 
        }
    }

    public function update(Request $request): View
    {  
        $data['title'] = 'Team Training';
        $data['sub_title'] = 'Update';  
        $data['uinfo'] = Training::find($request->id);
        $data['users'] = User::get();  
        $data['employee_data'] = auth('web')->user();
        if(auth('web')->user()->hasPermissionTo('creat-training')){

            return view('user.training.updateall',$data); 
        }else{

            return view('user.training.update',$data); 
        }
    }
	
	 public function updateMy(Request $request): View
    {  
        $data['title'] = 'Team Training';
        $data['sub_title'] = 'Update';  
        $data['uinfo'] = Training::find($request->id);
        $data['users'] = User::get();  
        $data['employee_data'] = auth('web')->user();
        if(auth('web')->user()->hasPermissionTo('creat-training')){
 $data['users'] = User::where('id',Auth::guard('web')->user()->id)->first();
            return view('user.training.updatemy',$data); 
        }else{
 $data['users'] = User::get(); 
            return view('user.training.update',$data); 
        }
    }

    public function store(Request $request)
    {
         // echo "<pre>"; print_r($request->all()); die;
        if($request->id){
              
            request()->validate([
                'training_name' => 'required', 
                'institution_or_training_provider'=> 'required',
                'start_date' => 'required',
                'status' => 'required', 
                'objectives' => 'required', 
                'certificate' => 'required',
                'user_id' => 'required',
                'completion_date' => 'required_if:certificate,1',
                // 'completion_date' => 'required', 
                ]);
                if(auth('web')->user()->hasPermissionTo('creat-training')){
                    $user_id = $request->user_id;
                }else{
                    $user_id = Auth::guard('web')->user()->id;
                }
                $data = Training::find($request->id); 
                    $data->update([
                        'title' => $request->training_name,    
                        'institution_or_training_provider' => $request->institution_or_training_provider,    
                        'start_date' => $request->start_date,    
                        'end_time' => $request->completion_date,    
                        'certificate_award' => $request->certificate,    
                        'status' => $request->status,
                        'description' => $request->objectives,
                        'user_id' => $request->user_id,
                        'completion_date' => $request->completion_date,
                        'session_id' => session('sessionId'),
                    ]);
                
           

            return response()->json([
                'success'=> 1,
                'message'=>"Training updated successfully."
            ]);
           
        }else{
          
         
            // $certificate = new Certificate();
            // $certificate->is_awarded = $request->certificate;
 
                request()->validate([
                    'training_name' => 'required', 
                    'institution_or_training_provider'=> 'required',
                    'start_date' => 'required',
                    'status' => 'required', 
                    'objectives' => 'required', 
                    'certificate' => 'required',
                    'user_id' => 'required',
                    'completion_date' => 'required_if:status,1', 
                    ]);
                    if(auth('web')->user()->hasPermissionTo('creat-training')){
                        $user_id = $request->user_id;
                    }else{
                        $user_id = Auth::guard('web')->user()->id;
                    }
                    $data = Training::create([
                        'title' => $request->training_name,    
                        'institution_or_training_provider' => $request->institution_or_training_provider,    
                        'start_date' => $request->start_date,    
                        'end_time' => $request->completion_date,    
                        'certificate_award' => $request->certificate,    
                        'status' => $request->status,
                        'description' => $request->objectives,
                        'user_id' => $request->user_id,
                        'completion_date' => $request->completion_date,
                        'session_id' => session('sessionId'),
                    ]);

                    
            
                return response()->json([
                    'success'=> 1,
                    'message'=>"Training insert successfully."
                ]);
        }
    }

    public function destroy(Request $request)
    {
        $data = Training::find($request->id); 
        $data->delete();

        return response()->json([
            'success'=> 1,
            'message'=>"Training deleted successfully."
        ]);
     
      
    }

    public function status(Request $request)
    {
       
        $data = Training::find($request->id); 
        if($request->status == 1)
        {
           $data->end_time = date('Y-m-d H:i:s');
           $data->certificate = 1;
        }
        $data->status = $request->status;
        $data->save(); 
        return response()->json([
            'success'=> 1,
            'message'=>"Training status changed successfully."
        ]);
     
      
    }

    public function userdatastore(Request $request)
    {

        $userid =  Auth::guard('web')->user()->id;

        
        if($request->id){
              
            request()->validate([
                'training_name' => 'required', 
                'institution_or_training_provider'=> 'required',
                'start_date' => 'required',
                'status' => 'required', 
                'objectives' => 'required', 
                'certificate' => 'required',
                'completion_date' => 'required_if:certificate,1',
                ]);
              
                $data = Training::find($request->id); 
                    $data->update([
                        'title' => $request->training_name,    
                        'institution_or_training_provider' => $request->institution_or_training_provider,    
                        'start_date' => $request->start_date,    
                        'end_time' => $request->completion_date,    
                        'certificate' => $request->certificate,    
                        'status' => $request->status,
                        'description' => $request->objectives,
                        'user_id' => $request->employee_id,
                        'completion_date' => $request->completion_date,
                        'session_id' => session('sessionId'),
                        ]);
                        
                        
                        
                        return response()->json([
                            'success'=> 1,
                            'message'=>"Training updated successfully."
                            ]);
                            
                            }else{
                                
                                // echo "<pre>";print_r($userid);die;
                                
                                request()->validate([
                                    'training_name' => 'required', 
                                    'institution_or_training_provider'=> 'required',
                                    'start_date' => 'required',
                                    'status' => 'required', 
                                    'objectives' => 'required', 
                                    'certificate' => 'required',
                                    'completion_date' => 'required_if:certificate,1',
                                    ]);
                                   
                          $user_id = Auth::guard('web')->user()->id;
                                      
                                            $data = Training::create([
                        'title' => $request->training_name,    
                        'institution_or_training_provider' => $request->institution_or_training_provider,    
                        'start_date' => $request->start_date,    
                        'end_time' => $request->end_time,    
                        'certificate' => $request->certificate,    
                        'status' => $request->status,
                        'description' => $request->objectives,
                        'user_id' => $user_id,
                        'completion_date' => $request->completion_date,
                        'session_id' => session('sessionId'),
                    ]);

                return response()->json([
                    'success'=> 1,
                    'message'=>"Training insert successfully."
                ]);
        }
    }
    
    
     public function myTrainingIndex(): View
    {
        $data['title'] = 'My Training';
        $data['sub_title'] = 'my training';
       return view('user.training.mytraining',$data);
    }


    public function myTrainingList(Request $request)
    { 
        $userid =  Auth::guard('web')->user()->id;
        // echo "<pre>";print_r(session('sessionId'));die;
        if ($request->ajax()) {
            // if(auth('web')->user()->hasPermissionTo('creat-training')){
                // DB::enableQueryLog();
            //     $data = Training::with('user')->get(); 
            // }else{
                $data = Training::with('user')->where('user_id',$userid)->get(); 
                // $queries = DB::getQueryLog();
                // $lastQuery = end($queries);
                
                // Output the last query
                // dd($lastQuery);
            // }
          $no=1;
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('sr.no', function($row) use($no){
                     $no++;
                        return $no;
                    }) 
                    ->addColumn('name', function($row){
                        $name =  $row->user->name;
                        return $name;
                    }) 
                    ->addColumn('completion_date', function($row){ 

                        $completion_date =  $row->completion_date;
                        return $completion_date;
                    })
                    ->addColumn('title', function($row){
                        $title =  $row->title;
                        return $title;
                    }) 
                    ->addColumn('institution_or_training_provider', function($row){
                        $institution_or_training_provider =  $row->institution_or_training_provider;
                        return $institution_or_training_provider;
                    }) 

                    ->addColumn('trainingstatus', function($row){ 

                        $statusUrl = route('user.training-status'); 

                        if($row->status == 0){
                            $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",2) class=" btn-sm btn btn-soft-secondary rounded-pill waves-effect waves-light  p-1 fs-6 ">In-Progress</button>';
                        }elseif($row->status == 2){
                            $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",1)  class=" btn-sm btn btn-soft-danger rounded-pill waves-effect waves-light  p-1 fs-6 ">Delayed</button>';
                        }else if($row->status == 1){
                            $status =  '<button type="button"  class=" btn-sm btn btn-soft-success rounded-pill waves-effect waves-light  p-1 fs-6">Completed</button>';
                        }
                         
                        return $status;
                    })

                    ->addColumn('trainingobject', function($row){ 

                        $description =  $row->description;
                        return $description;
                    })

                    ->addColumn('start_date', function($row){ 

                        $start_date =  $row->start_date;
                        return $start_date;
                    })

                    ->addColumn('certificate', function($row){ 
                        $certificate ="";
                        if($row->certificate == 1)
                        {
                           $certificate = '<i class="fa fa-check text-success" aria-hidden="true"></i>';
                        }
                        return $certificate;
                    })
                    ->addColumn('end_date', function($row){ 
                        $endTime =  $row->end_time;
                        return $endTime;
                        })
                        ->addColumn('updated_at', function($row){ 
                        $updated_at =  date('Y-m-d H:i:s',strtotime($row->updated_at));
                    //    date('Y-m-d H:i:s');
                        return $updated_at;
                    })
                    ->addColumn('action', function($row){ 
                        $editUrl = route('user.training-update-my');
                        $deleteUrl = route('user.training-delete'); 
                            $action =  '<button type="button" onclick = editForm(this,"'.$row->id.'","'. $editUrl .'") class=" btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;'; 
                            $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class=" btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>'; 
                        return $action;
                    })

                    ->rawColumns(['sr.no','name','institution_or_training_provider','title','trainingstatus','trainingobject','start_date','certificate','end_date','updated_at','action','completion_date'])
                    ->make(true);
        }

    }
 

}