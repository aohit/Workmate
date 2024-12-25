<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Holiday; 
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Hash; 
use DataTables;

class HolidayController extends Controller
{
    /**
     * Display the login view.
     */
 

     public function index(): View
        { 
           
            $data['title'] = 'Public Holiday';
            $data['sub_title'] = 'Holiday List';
            $data['holidays'] = Holiday::get();
            return view('user.holiday.index',$data);
        }
 
        public function list(Request $request)
        { 
            if ($request->ajax()) {
    
                
                    $data = Holiday::get(); 
              
                return DataTables::of($data)
                        ->addIndexColumn()
                        
                        ->addColumn('status', function($row){ 
 
                            $statusUrl = route('holiday.status'); 
                            if($row->status == 0){
                                $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",1) class="btn-sm btn btn-soft-success rounded-pill waves-effect waves-light">Active</button>';
                            }else{
                                $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",0) class="btn-sm btn btn-soft-success rounded-pill waves-effect waves-light">In-Active</button>';
                            }
                             
                            return $status;
                        })

                        ->addColumn('action', function($row){ 

                            $editUrl = route('holiday.update');
                            $action =  '<button type="button" onclick = editForm(this,"'.$row->id.'","'. $editUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;';

                            // $deleteUrl = route('holiday.delete');
                            // $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="d-none btn btn-outline-danger waves-effect waves-light">Delete</button>';
                            return $action;
                        })
                       
                        ->rawColumns(['date','status','action'])
                        ->make(true);
            }
        }

        public function create(): View
        {  
            $data['title'] = 'Holiday';
            $data['sub_title'] = 'Create';  
            return view('user.holiday.create',$data); 
        }

        public function update(Request $request): View
        {  
            $data['title'] = 'Holiday';
            $data['sub_title'] = 'Update';  
            $data['uinfo'] = Holiday::find($request->id);   
            return view('user.holiday.update',$data); 
        }

        public function store(Request $request)
        {
           
            if($request->id){
              
                request()->validate([
                    'title' => 'required', 
                    'date' => 'required', 
                    ]);
                    $data = Holiday::find($request->id); 
                        $data->update([
                            'title' => $request->title,    
                            'date' => $request->date,    
                            'status' => $request->status, 
                            'session_id' => session('sessionId'),
                        ]);
                    
               

                return response()->json([
                    'success'=> 1,
                    'message'=>"Holiday Updated successfully."
                ]);
               
            }else{
                request()->validate([
                    'title' => 'required',
                    'date' => 'required',   
                ]);
    
                $data = Holiday::create([
                    'title' => $request->title,    
                    'date' => $request->date,    
                    'status' => $request->status, 
                    'session_id' => session('sessionId'),
                ]);
    
                return response()->json([
                    'success'=> 1,
                    'message'=>"Holiday created successfully."
                ]);
            }
           
        }


        public function destroy(Request $request)
        {
           
            $data = Holiday::find($request->id); 
            $data->delete(); 
            // $LeaveRequest->delete();

            return response()->json([
                'success'=> 1,
                'message'=>"Holiday deleted successfully."
            ]);
         
          
        }

        public function status(Request $request)
        {
           
            $data = Holiday::find($request->id); 
            $data->status = $request->status;
            $data->save(); 
            return response()->json([
                'success'=> 1,
                'message'=>"Holiday status changed successfully."
            ]);
         
          
        }

        

 
}