<?php

namespace App\Http\Controllers\Admin;

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

class EducationController extends Controller
{
    public function educationIndex()
    { 
        $data['title'] = 'Employee Education';
        $data['sub_title'] = 'Employee Education';
        return view('admin.education.index',$data);
    }


    public function list(Request $request)
    {
      
        if ($request->ajax()) {
    
                
       $data = Education::get(); 
      
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('employee', function($row){
                    $user = User::where('id',$row->employee_id)->select('name')->first();
                    // echo "<pre>";print_r($user->name);die;
                    return $user->name;
                }) 
                ->addIndexColumn()
                ->addColumn('qualification', function($row){
                    $qualification =  $row->qualification;
                    return $qualification;
                })
                ->addColumn('percentage', function($row){
                    $percentage =  $row->percentage .'%';
                    return $percentage;
                })
                ->addColumn('passing_year', function($row){
                    $passingyear =  $row->passing_year;
                    return $passingyear;
                })
                ->addColumn('action', function($row){ 

                    $editUrl = route('admin.education.update');
                    $action =  '<button type="button" onclick = editForm(this,"'.$row->id.'","'. $editUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;';

                     $deleteUrl = route('admin.education.delete');
                    $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
                    return $action;
                })
               
                ->rawColumns(['employee','qualification','percentage','passing_year','action'])
                ->make(true);
    }
    }


    public function create(Request $request)
    {
         $data['title'] = 'Employee Education';
        $data['sub_title'] = 'Employee Education'; 
        $data['employee'] = User::get();
        $data['user']  = auth()->user();
        return view('admin.education.create',$data); 
    }


    public function update(Request $request): View
    {  
        $data['title'] = 'Education';
        $data['sub_title'] = 'Update';  
        $data['employee'] = User::get();   
        $data['uinfo'] = Education::with('employee')->find($request->id);
     
        return view('admin.education.update',$data); 
    }


    public function store(Request $request)
    {      
            if($request->id){ 
              $id = $request->id;
                request()->validate([
                    'employee' => 'required', 
                    // 'qualification' => 'required',  
                    'percentage' => 'required', 
                    'passing_year' => 'required', 
            
                    ]);

                $admin = Education::find($request->id);
               
                    $admin->update([
                        'employee_id' => $request->employee,    
                        'qualification' => $request->qualification,
                        'percentage' => $request->percentage,
                        'passing_year' => $request->passing_year,
                    ]);     
               
                return response()->json([
                    'success'=> 1,
                    'message'=>"Employee Education Updated successfully."
                ]);

            }else{ 
                request()->validate([
                    'employee' => 'required', 
                    'qualification' => 'required', 
                    'percentage' => 'required', 
                    'passing_year' => 'required|', 
                  
                ]);
    
                $emp = Education::create([
                    'employee_id' => $request->employee,    
                    'qualification' => $request->qualification,
                    'percentage' => $request->percentage,
                    'passing_year' => $request->passing_year,
                ]);

                return response()->json([
                    'success'=> 1,
                    'message'=>"Employee Education Insert Successfully."
                ]);
            }
        }

        public function destroy(Request $request)
        {
            $data = Education::find($request->id); 
            $data->delete(); 

            return response()->json([
                'success'=> 1,
                'message'=>"Employeee Education deleted successfully."
            ]);
         
          
        }


         
}
