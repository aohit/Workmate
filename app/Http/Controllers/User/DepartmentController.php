<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Department; 
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Hash; 
use DataTables;

class DepartmentController extends Controller
{
    /**
     * Display the login view.
     */

     function __construct()
    {
        
    }


     public function index(): View
        { 
           
            $data['title'] = 'Department';
            $data['sub_title'] = 'Department List';
            $data['departments'] = Department::get();
            return view('user.department.index',$data);
        }
 
        public function list(Request $request)
        { 
            if ($request->ajax()) {
    
                
                    $data = Department::get(); 
              
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('name', function($row){
                            $name =  $row->name;
                            return $name;
                        }) 

                        ->addColumn('status', function($row){ 
 
                            $statusUrl = route('department.status'); 
                            if($row->status == 1){
                                $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",0) class=" btn-sm btn btn-success  waves-effect waves-light">Active</button>';
                            }else{
                                $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",1) class=" btn-sm btn btn-soft-danger waves-effect waves-light">Inactive</button>';
                            }
                             
                            return $status;
                        })

                        ->addColumn('action', function($row){ 

                            $editUrl = route('department.update');
                            $deleteUrl = route('department.delete'); 
                                $action =  '<button type="button" onclick = editForm(this,"'.$row->id.'","'. $editUrl .'") class=" btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;'; 
                                $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="d-none  btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>'; 
                            return $action;
                        })
                       
                        ->rawColumns(['name','status','action'])
                        ->make(true);
            }
        }

        public function create(): View
        {  
            $data['title'] = 'department';
            $data['sub_title'] = 'Create';  
            return view('user.department.create',$data); 
        }

        public function update(Request $request): View
        {  
            $data['title'] = 'department';
            $data['sub_title'] = 'Update';  
            $data['uinfo'] = Department::find($request->id);   
            return view('user.department.update',$data); 
        }

        public function store(Request $request)
        {
           
            if($request->id){
              
                request()->validate([
                    'name' => 'required', 
                    ]);
                    $data = Department::find($request->id); 
                        $data->update([
                            'name' => $request->name,    
                            'status' => $request->status, 
                            'session_id' => session('sessionId'),
                        ]);
                    
               

                return response()->json([
                    'success'=> 1,
                    'message'=>"Department Updated successfully."
                ]);
               
            }else{
                request()->validate([
                    'name' => 'required',  
                ]);
    
                $data = Department::create([
                    'name' => $request->name,    
                    'status' => $request->status,
                    'session_id' => session('sessionId'),
                ]);
    
                return response()->json([
                    'success'=> 1,
                    'message'=>"Department created successfully."
                ]);
            }
           
        }


        public function destroy(Request $request)
        {
           
            $data = Department::find($request->id); 
            $data->delete();
            $LeaveRequest = LeaveRequest::where('department_id',$request->id)->get();
            $LeaveRequest->delete();

            return response()->json([
                'success'=> 1,
                'message'=>"Department deleted successfully."
            ]);
         
          
        }

        public function status(Request $request)
        {
           
            $data = Department::find($request->id); 
            $data->status = $request->status;
            $data->save(); 
            return response()->json([
                'success'=> 1,
                'message'=>"Department status changed successfully."
            ]);
         
          
        }

        

 
}