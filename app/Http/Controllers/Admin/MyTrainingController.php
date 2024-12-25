<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MyTrainingExport;
use App\Http\Controllers\Controller;
use App\Models\{Training, User,Department};
use Carbon\Carbon;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class MyTrainingController extends Controller
{

    public function index(): View
    {
        $data['title'] = 'Employee Training';
        $data['sub_title'] = 'Employee training';
        $data['departments'] = Department::where('status',1)->get();
       return view('admin.training.index',$data);
    }

    public function list(Request $request)
    { 
        if ($request->ajax()) {
            
            // $data = Training::with('user')->get(); 
           $departmentId = $request->departmentId; 
            if(!empty($request->departmentId) && isset($request->departmentId)){
            
                $data = Training::with(['user' => function ($query) use ($departmentId) {
                    $query->where('department_id', $departmentId);
                }])->whereHas('user', function ($query) use ($departmentId) {
                    $query->where('department_id', $departmentId);
                })->get();
            } else {
                $data = Training::with('user:id,name,department_id,job_title')->get();
              
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
                        return ucwords($name);
                    }) 
                    ->addColumn('department_id', function($row){
                        $department_id =  @$row->user->department_id;
                        $department = Department::where('id',$department_id)->first();
                        return ucwords(@$department->name);
                    }) 
                    ->addColumn('job_title', function($row){
                        $job_title =  $row->user?->job_title;
                        return $job_title;
                    }) 
                    ->addColumn('item', function($row){
                        $title =  $row->title;
                        return $title;
                    }) 

                    ->addColumn('trainingstatus', function($row){ 

                        $statusUrl = route('admin.training-status'); 

                        if($row->status == 0){
                            $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",1) class=" btn-sm btn btn-soft-secondary rounded-pill waves-effect waves-light">In-Progress</button>';
                        }elseif($row->status == 1){
                            $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",2) class=" btn-sm btn btn-soft-success rounded-pill waves-effect waves-light">Completed</button>';
                        }else if($row->status == 2){
                            $status =  '<button type="button"   class=" btn-sm btn btn-soft-danger rounded-pill waves-effect waves-light">Delayed</button>';
                        }
                         
                        return $status;
                    })

                    ->addColumn('trainingobject', function($row){ 

                        $description =  $row->description;
                        return $description;
                    })

                    ->addColumn('start_time', function($row){ 

                        $startTime =  $row->start_time;
                        return $startTime;
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
                    ->addColumn('action', function($row) { 
                        $editUrl = route('admin.training-update');
                        $deleteUrl = route('admin.training-delete');
                        $action = '<div class="flexblockclass gap-1">';
                        $action .= '<button type="button" onclick="editForm(this, \'' . $row->id . '\', \'' . $editUrl . '\')" class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>'; 
                        $action .= '<button type="button" onclick="deleteRow(this, \'' . $row->id . '\', \'' . $deleteUrl . '\')" class="btn-sm btn btn-outline-danger waves-effect waves-light mb-0">Delete</button>'; 
                        $action .= '</div>';
                        return $action;
                    })

                    ->rawColumns(['sr.no','name','item','trainingstatus','trainingobject','start_time','certificate','end_date','department_id','job_title','action'])
                    ->make(true);
        }

    }

    public function create()
    {
        $data['title'] = 'Employee Training';
        $data['sub_title'] = 'Create';  
        $data['users'] = User::get();
        // echo "<pre>"; print_r( $data['users']); die;
        return view('admin.training.create',$data); 
    }

    public function update(Request $request): View
    {  
        $data['title'] = 'Employee Training';
        $data['sub_title'] = 'Update';  
        $data['uinfo'] = Training::find($request->id); 
        $data['users'] = User::get();  
        return view('admin.training.update',$data); 
    }

    public function store(Request $request)
    {

        if($request->id){
              
            request()->validate([
                'title' => 'required', 
                'status' => 'required', 
                'description' => 'required', 
                ]);
                $data = Training::find($request->id); 
                    $data->update([
                        'title' => $request->title,    
                        'status' => $request->status,
                        'description' => $request->description,
                        'start_time' => date('Y-m-d H:i:s'),
                        'user_id' => $request->user_id,
                        'session_id' => session('sessionId'),
                    ]);
                
           

            return response()->json([
                'success'=> 1,
                'message'=>"Training updated successfully."
            ]);
           
        }else{

                request()->validate([
                    'title' => 'required', 
                    'status' => 'required', 
                    'description' => 'required', 
                    'user_id' => 'required', 
                    ]);

                    $data = Training::create([
                        'title' => $request->title,    
                        'status' => $request->status,
                        'description' => $request->description,
                        'start_time' => date('Y-m-d H:i:s'),
                        'user_id' => $request->user_id,
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
    
    public function export(Request $request) 
    {
        $departmentId = $request->departmentId; 
        if(!empty($request->departmentId) && isset($request->departmentId)){
        
            $training = Training::with(['user' => function ($query) use ($departmentId) {
                $query->where('department_id', $departmentId)
                      ->with('department:id,name'); 
            }])->whereHas('user', function ($query) use ($departmentId) {
                $query->where('department_id', $departmentId);
            })->get();


        } else {
            $training = Training::with('user:id,name,department_id,job_title','user.department')->get();
        }

        return Excel::download(new MyTrainingExport($training), 'training.xlsx');
    }
}