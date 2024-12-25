<?php

namespace App\Http\Controllers\Admin;

use App\Models\DisciplinaryActionType;
use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Admin; 
use App\Models\{User,Skill,Education}; 
use Illuminate\Support\Facades\Hash; 
use DataTables;
use DB;
use Spatie\Permission\Models\Role;

class DisciplinaryActionTypeController extends Controller
{
 
    public function index():View
    {
        $data['title'] = 'Disciplinary Action Type';
        $data['sub_title'] = 'Disciplinary Action Type';
        return view('admin.disciplinaryactiontype.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Disciplinary Action Type';
        $data['sub_title'] = 'Disciplinary Action Type'; 
        $data['employee'] = User::get();
        $data['user']  = auth()->user();
        return view('admin.disciplinaryactiontype.create',$data); 
    }

    public function list(Request $request)
    {
      
        if ($request->ajax()) {
    
                
       $data = DisciplinaryActionType::get(); 
    //    echo "<pre>";print_r($data);die;
      
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action_type', function($row){
                    $action_type =  $row->action_type;
                    return $action_type;
                })
                ->addColumn('status', function($row){
                    if($row->status == 1){
                        $status =  '<button type="button"  class="btn-sm btn btn-success  waves-effect waves-light">Active</button>';
                    }else{
                        $status =  '<button type="button" class="btn-sm btn btn-outline-danger waves-effect waves-light">Inactive</button>';
                    }
                     
                    return $status;
                })
                ->addColumn('action', function($row){ 

                    $statusUrl = route('admin.disciplinaryactiontype.status'); 
                    if($row->status == 0){
                        $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",1) class="btn-sm btn btn-outline-success waves-effect waves-light ms-1">Active</button>';
                    }else{
                        $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",0) class="btn-sm btn btn-outline-danger   waves-effect waves-light ms-1">Inactive</button>';
                    }

                    $editUrl = route('admin.disciplinaryactiontype.update');
                    $action =  '<button type="button" onclick = editForm(this,"'.$row->id.'","'. $editUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;';

                     $deleteUrl = route('admin.disciplinaryactiontype.delete');
                    $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
                    return $action.''.$status;
                })
               
                ->rawColumns(['action_type','status','action'])
                ->make(true);
    }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        if($request->id){ 
            $id = $request->id;
              request()->validate([
                  'actiontype' => 'required', 
                  'status' => 'required', 
                  
                  ]);

              $admin = DisciplinaryActionType::find($request->id);
             
                  $admin->update([
                      'action_type' => $request->actiontype,    
                      'status' => $request->status,
                  ]);     
             
              return response()->json([
                  'success'=> 1,
                  'message'=>"Disciplinary action type Updated successfully."
              ]);

          }else{ 
              request()->validate([
                'actiontype' => 'required', 
                'status' => 'required'
                
              ]);
  
              $emp = DisciplinaryActionType::create([
                'action_type' => $request->actiontype,    
                'status' => $request->status
              ]);

              return response()->json([
                  'success'=> 1,
                  'message'=>"Disciplinary action type Insert Successfully."
              ]);
          }
    }

    /**
     * Display the specified resource.
     */
    public function show(DisciplinaryActionType $disciplinaryActionType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DisciplinaryActionType $disciplinaryActionType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DisciplinaryActionType $disciplinaryActionType)
    {
        $data['title'] = 'Disciplinary action type';
        $data['sub_title'] = 'Update';  
        $data['uinfo'] = DisciplinaryActionType::get()->find($request->id);   
        // $data['uinfo'] = Education::with('employee')->find($request->id);
     
        return view('admin.disciplinaryactiontype.update',$data); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,DisciplinaryActionType $disciplinaryActionType)
    {
        $data = DisciplinaryActionType::find($request->id); 
        $data->delete(); 

        return response()->json([
            'success'=> 1,
            'message'=>"Disciplinary action type deleted successfully."
        ]);
    }

    
    public function status(Request $request)
    {
       
        $data = DisciplinaryActionType::find($request->id); 
        $data->status = $request->status;
        $data->save(); 
        return response()->json([
            'success'=> 1,
            'message'=>"Disciplinary action type changed successfully."
        ]);
     
      
    }
}
