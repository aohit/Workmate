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

class MyTrainingController extends Controller
{

    public function index(): View
    {
        $data['title'] = 'My Training';
        $data['sub_title'] = 'my training';
       return view('user.training.index',$data);
    }

    public function list(Request $request)
    { 
        if ($request->ajax()) {
            echo "fdf"; die;
            $data = Training::get(); 
          
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('item', function($row){
                        $title =  $row->title;
                        return $title;
                    }) 

                    ->addColumn('trainingstatus', function($row){ 

                        $statusUrl = route('training-status'); 

                        if($row->status == 0){
                            $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",1) class=" btn-sm btn btn-soft-secondary rounded-pill waves-effect waves-light">In-Progress</button>';
                        }elseif($row->status == 1){
                            $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",2) class=" btn-sm btn btn-soft-success rounded-pill waves-effect waves-light">Completed</button>';
                        }else if($row->status == 2){
                            $status =  '<button type="button"  class=" btn-sm btn btn-soft-danger rounded-pill waves-effect waves-light">Delayed</button>';
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

                        $certificate =  $row->certificate;
                        return $certificate;
                    })
                    ->addColumn('end_date', function($row){ 
                        $endTime =  $row->end_time;
                        return $endTime;
                    })
                    ->addColumn('action', function($row){ 
                        $editUrl = route('training-update');
                        $deleteUrl = route('training-delete'); 
                            $action =  '<button type="button" onclick = editForm(this,"'.$row->id.'","'. $editUrl .'") class=" btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;'; 
                            $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class=" btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>'; 
                        return $action;
                    })

                    ->rawColumns(['item','trainingstatus','trainingobject','start_time','certificate','end_date','action'])
                    ->make(true);
        }

    }

    public function create()
    {
        $data['title'] = 'My Training';
        $data['sub_title'] = 'Create';
        $data['users'] = User::get();  
        return view('user.training.create',$data); 
    }

    public function update(Request $request): View
    {  
        $data['title'] = 'My Training';
        $data['sub_title'] = 'Update';  
        $data['uinfo'] = Training::find($request->id);   
        return view('user.training.update',$data); 
    }

    public function store(Request $request)
    {

        if($request->id){
              
            request()->validate([
                'title' => 'required', 
                'status' => 'required', 
                'description' => 'required',
                'user_id' => 'required', 
                ]);
                $data = Training::find($request->id); 
                    $data->update([
                        'title' => $request->title,    
                        'status' => $request->status,
                        'description' => $request->description,
                        'start_time' => date('Y-m-d H:i:s'),
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
                        'user_id' => Auth::guard('web')->user()->id,
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
        $data->status = $request->status;
        $data->save(); 
        return response()->json([
            'success'=> 1,
            'message'=>"Training status changed successfully."
        ]);
     
      
    }
}