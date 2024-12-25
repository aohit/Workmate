<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\LeaveType; 
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Hash; 
use DataTables;

class LeaveTypeController extends Controller
{
   
     public function index(): View
        { 
           
            $data['title'] = 'Leave Type';
            $data['sub_title'] = 'Leave Type List'; 
            return view('user.leave-type.index',$data);
        }
 
        public function list(Request $request)
        { 
            
            if ($request->ajax()) {
    
                
                    $data = LeaveType::where('status' , 1)->get(); 
              
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('type', function($row){
                            $type =  $row->type;
                            return $type;
                        }) 

                        ->addColumn('status', function($row){ 
 
                            $statusUrl = route('leavetype.status'); 
                            if($row->status == 0){
                                $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",1) class="btn-sm btn btn-soft-success rounded-pill waves-effect waves-light">Active</button>';
                            }else{
                                $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",0) class="btn-sm btn btn-soft-success rounded-pill waves-effect waves-light">In-Active</button>';
                            }
                             
                            return $status;
                        })

                        ->addColumn('action', function($row){ 

                            $editUrl = route('leavetype.update');
                            $action =  '<button type="button" onclick = editForm(this,"'.$row->id.'","'. $editUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;';

                            // $deleteUrl = route('leavetype.delete');
                            // $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="btn btn-outline-danger waves-effect waves-light">Delete</button>';
                            return $action;
                        })
                       
                        ->rawColumns(['type','status','action'])
                        ->make(true);
            }
        }

        public function create(): View
        {  
            $data['title'] = 'Leave Type';
            $data['sub_title'] = 'Create';  
            return view('user.leave-type.create',$data); 
        }

        public function update(Request $request): View
        {  
            $data['title'] = 'Leave Type';
            $data['sub_title'] = 'Update';  
            $data['uinfo'] = LeaveType::find($request->id);   
            return view('user.leave-type.update',$data); 
        }

        public function store(Request $request)
        {
           
            if($request->id){
              
                request()->validate([
                    'name' => 'required', 
                    ]);
                    $data = LeaveType::find($request->id); 
                        $data->update([
                            'type' => $request->name,    
                            'status' => $request->status, 
                        ]);
                    
               

                return response()->json([
                    'success'=> 1,
                    'message'=>"Leave Type Updated successfully."
                ]);
               
            }else{
                request()->validate([
                    'name' => 'required',  
                ]);
    
                $data = LeaveType::create([
                    'type' => $request->name,    
                    'status' => $request->status,
                ]);
    
                return response()->json([
                    'success'=> 1,
                    'message'=>"Leave Type created successfully."
                ]);
            }
           
        }


        // public function destroy(Request $request)
        // {
           
        //     $data = LeaveType::find($request->id); 
        //     $data->delete();
        //     $LeaveRequest = LeaveRequest::where('department_id',$request->id)->get();
        //     $LeaveRequest->delete();

        //     return response()->json([
        //         'success'=> 1,
        //         'message'=>"Leave Type deleted successfully."
        //     ]);
         
          
        // }

        public function status(Request $request)
        {
           
            $data = LeaveType::find($request->id); 
            $data->status = $request->status;
            $data->save(); 
            return response()->json([
                'success'=> 1,
                'message'=>"Leave Type status changed successfully."
            ]);
         
          
        }

        

 
}