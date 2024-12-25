<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;
use App\Enums\TaskStatusEnum;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(): View
    {
        $data['title'] = 'Task';
        $data['sub_title'] = 'Task';
        return view('user.task.index',$data);
    }

    public function list(Request $request)
    {
        //   echo "<pre>"; print_r($request->toArray()); die;
        if ($request->ajax())
        {
      
          $data = Task::with('user')->where('user_id',Auth::guard('web')->user()->id)->get();
      
           return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('title', function($row){
                        
                    return ucwords($row->title);
                }) 
                ->addIndexColumn()
                ->addColumn('skills', function($row){
                    $skills =  $row->skills;
                    return $skills;
                })
                ->addColumn('status', function($row){
                    return $row->status;
                })
                ->addColumn('assing', function($row){
    
                    return ucwords($row->user->name);
                })
                ->addColumn('action', function($row){ 
                    $action ="";
                    if(auth('web')->user()->hasPermissionTo('edit-task')){

                        $editUrl = route('task-update');
                        $action =  '<button type="button" onclick = editForm(this,"'.$row->id.'","'. $editUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;';
                    }
                   
                    $statusUrl = route('task-status');
                    $status =  '<button type="button" onclick = changedStatus(this,"'.$row->id.'","'. $statusUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Change Status</button>&nbsp;&nbsp;&nbsp;';
                    //  $deleteUrl = route('task-delete');
                    // $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';

                    // echo "<pre>";print_r($action);die;
                    return $action.$status;
                })
               
                ->rawColumns(['title','status','assing','action'])
                ->make(true);
        }
    }

    public function create(Request $request)
    {
         $data['title'] = 'Task';
        $data['sub_title'] = 'Store'; 
        $data['employees'] = User::get();
        return view('user.task.create',$data); 
    }

    public function update(Request $request)
    {  
        $data['title'] = 'Task';
        $data['sub_title'] = 'Update';  
        $data['employees'] = User::get();   
        $data['uinfo'] = Task::with('user')->find($request->id);
        // echo "<pre>";print_r($data['uinfo']);die;   
        // $data['reportees'] = User::with('')->where('employee_id',$request->id);   
        return view('user.task.update',$data); 
    }

    public function store(Request $request)
    {     
        // echo "<pre>"; print_r($request->all()); die; 
            if($request->id){ 
              $id = $request->id;
                request()->validate([
                    'title' => 'required', 
                    // 'user_id' => 'required',  
                    'start_date' => 'required', 
                    'end_date' => 'required', 
                    'description' => 'required', 
                    'status' => 'required', 
            
                    ]);

                $admin = Task::find($request->id);
               
                    $admin->update([
                        'title' => $request->title,    
                        'user_id' => Auth::guard('web')->user()->id,
                        'start_date' => $request->start_date,
                        'end_date' => $request->end_date,
                        'description' => $request->description,
                        'status' => $request->status,
                    ]);     
               
                return response()->json([
                    'success'=> 1,
                    'message'=>"Task Updated successfully."
                ]);

            }else{ 
                request()->validate([
                    'title' => 'required', 
                    // 'user_id' => 'required', 
                    'start_date' => 'required', 
                    'end_date' => 'required', 
                    'description' => 'required', 
                  
                ]);
    
                $emp = Task::create([
                    'title' => $request->title,    
                    'user_id' => Auth::guard('web')->user()->id,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'status' => TaskStatusEnum::pending,
                    'description' => $request->description,
                ]);

                return response()->json([
                    'success'=> 1,
                    'message'=>"Task Insert Successfully."
                ]);
            }
    }

    public function destroy(Request $request)
    {
       
        $data = Task::find($request->id); 
        $data->delete(); 

        return response()->json([
            'success'=> 1,
            'message'=>"Task deleted successfully."
        ]);
     
      
    }

    public function changedStatus(Request $request)
    {
        // echo "<pre>"; print_r($request->all()); die;
        $data['title'] = 'Task';
        $data['sub_title'] = 'Status';  
        $data['uinfo'] = Task::with('user')->find($request->id);
        return view('user.task.changedStatus',$data); 
    }

    public function statusStore(Request $request)
    {

       $admin = Task::find($request->id);
               
            $admin->update([
                'status' => $request->status,
            ]);     
        
            return response()->json([
                'success'=> 1,
                'message'=>"Task status change successfully."
            ]);
    }





}
