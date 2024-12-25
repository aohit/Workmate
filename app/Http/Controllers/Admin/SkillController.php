<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Admin; 
use App\Models\{User,Skill}; 
use App\Models\Reportee; 
use App\Models\Department; 
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Hash; 
use DataTables;
use DB;
use Spatie\Permission\Models\Role;
use App\Exports\EmployeesExport;
use App\Exports\SkillsExport;
use Maatwebsite\Excel\Facades\Excel;

class SkillController extends Controller
{
    public function employeeIndex(): View
    { 
       
        $data['title'] = 'Employee Skills';
        $data['sub_title'] = 'Employee Skills';
        $data['employees'] = User::get();
        $data['departments'] = Department::where('status',1)->get();
        return view('admin.skills.index',$data);
    }


    public function list(Request $request)
    {
      
        if ($request->ajax()) {
    
          $departmentId = $request->departmentId; 
            if(!empty($request->departmentId) && isset($request->departmentId)){
            
                $data = Skill::with(['employee' => function ($query) use ($departmentId) {
                    $query->where('department_id', $departmentId);
                }])->whereHas('employee', function ($query) use ($departmentId) {
                    $query->where('department_id', $departmentId);
                })->get();
            } else {
                $data = Skill::with('employee:id,name,department_id')->get();
              
            }
                
    //   $data = Skill::get(); 
      
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('employee', function($row){
                    // $user = User::where('id',$row->employee_id)->select('name')->first();
                    // echo "<pre>";print_r($user->name);die;
                    return  ucwords(@$row->employee->name);
                }) 
                ->addIndexColumn()
                ->addColumn('skills', function($row){
                    $skills =  $row->skills;
                    return $skills;
                })
                ->addColumn('experience', function($row){
                    $experience =  $row->experience.' Year';
                    return $experience;
                })
                ->addColumn('action', function($row) { 

                    $editUrl = route('admin.skills.update');
                    $deleteUrl = route('admin.skills.delete');
                    
                    $action = '<div class="flexblockclass gap-1">';                    
                    $action .= '<button type="button" onclick="editForm(this, \'' . $row->id . '\', \'' . $editUrl . '\')" class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>';                
                    $action .= '<button type="button" onclick="deleteRow(this, \'' . $row->id . '\', \'' . $deleteUrl . '\')" class="btn-sm btn btn-outline-danger waves-effect waves-light mb-0">Delete</button>';
                    $action .= '</div>';
                
                    return $action;
                })
               
                ->rawColumns(['employee','skills','experience','action'])
                ->make(true);
    }
    }
         
    public function create(Request $request)
    {
         $data['title'] = 'Employee Skills';
        $data['sub_title'] = 'Employee Skills'; 
        $data['employee'] = User::get();
        $data['user']  = auth()->user();
        return view('admin.skills.create',$data); 
    }
    
    public function update(Request $request): View
    {  
        $data['title'] = 'Skills';
        $data['sub_title'] = 'Update';  
        $data['employee'] = User::get();   
        $data['uinfo'] = Skill::with('employee')->find($request->id);
        // echo "<pre>";print_r($data);die;   
        // $data['reportees'] = User::with('')->where('employee_id',$request->id);   
        return view('admin.skills.update',$data); 
    }



    public function store(Request $request)
    {      
            if($request->id){ 
              $id = $request->id;
                request()->validate([
                    'employee' => 'required', 
                    'skills' => 'required|max:20', 
                    'experience' => 'required|numeric',
                    ]);


                    $empoyeeSkills =  Skill::where('employee_id',$request->employee)->count();
                    if($empoyeeSkills <= 8){

                        $admin = Skill::find($request->id);
     
                            $admin->update([
                                'employee_id' => $request->employee,    
                                'skills' => $request->skills,
                                'experience' => $request->experience,
                            ]);     
                   
                            return response()->json([
                                'success'=> 1,
                                'message'=>"Employee Skill Updated successfully."
                            ]);
                    }else{
                        return response()->json([
                            'success'=> 2,
                            'message'=>"Employee Skill is greater than 8."
                        ]);
                    }

            }else{ 
                    request()->validate([
                        'employee' => 'required', 
                        'skills' => 'required|max:20', 
                        'experience' => 'required|numeric', 
                    
                    ]);
                    
                    $empoyeeSkills =  Skill::where('employee_id',$request->employee)->count();
                    
                    if($empoyeeSkills <= 8){

                        $emp = Skill::create([
                            'employee_id' => $request->employee,    
                            'skills' => $request->skills,
                            'experience' => $request->experience,
                        ]);

                        return response()->json([
                            'success'=> 1,
                            'message'=>"Employee Skill Insert Successfully."
                        ]);

                    }else{

                        return response()->json([
                            'success'=> 2,
                            'message'=>"Employee Skill is greater than 8."
                        ]);

                    }

            }
        }


        public function destroy(Request $request)
        {
           
            $data = Skill::find($request->id); 
            $data->delete(); 

            return response()->json([
                'success'=> 1,
                'message'=>"Employeee Skill deleted successfully."
            ]);
         
          
        }
        
        public function export(Request $request) 
        {
            $departmentId = $request->input('departmentId');
            if(!empty($request->departmentId) && isset($request->departmentId)){
            
                $contact = Skill::with(['employee' => function ($query) use ($departmentId) {
                    $query->where('department_id', $departmentId);
                }])->whereHas('employee', function ($query) use ($departmentId) {
                    $query->where('department_id', $departmentId);
                })->get();
            } else {
                $contact = Skill::with('employee:id,name,department_id')->get();
            }
            return Excel::download(new SkillsExport($contact), 'skills.xlsx');
        }

}
