<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Admin; 
use App\Models\User; 
use App\Models\Department; 
use App\Models\Reportee; 
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Hash; 
use DataTables;
use DB;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    /**
     * Display the login view.
     */

     function __construct()
    {
         
    }


     public function index(): View
        { 
           
            $data['title'] = 'Employee';
            $data['sub_title'] = 'Employee List';
            $data['employees'] = User::get();
            $data['departments'] = Department::get();
            return view('user.employee.index',$data);
        }
 
        public function list(Request $request)
        { 
            if ($request->ajax()) {
    
                
               if(!empty($request->departmentId) && isset($request->departmentId)){
                $data = User::where('department_id', $request->departmentId)->get();  
               }else{
                $data = User::get();  
               }
                    
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('name', function($row){
                            $name =  $row->name;
                            return $name;
                        })
                        ->addColumn('email', function($row){
                            $email =  $row->email;
                            return $email;
                        })
                        ->addColumn('department', function($row){ 
                                $department =  $row->department->name;
                                
                            return $department;

                        })
                        ->addColumn('roles', function($row){

                            $rolesArr =  $row->getRoleNames(); 
                            $roles = '';
                            foreach($rolesArr as $role){
                               $roles .= '<span class="badge badge-outline-success">'.$role.'</span>';
                            }
                              
                            return $roles;
                        })
                        ->addColumn('action', function($row){ 
                            $editUrl = route('employee.update');
                            $deleteUrl = route('employee.delete'); 
                           
                                 $action =  '<button type="button" onclick = editForm(this,"'.$row->id.'","'. $editUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;';
                            
                             
                                $showUrl = route('employee.show');
                                $action .=  '<button type="button" onclick = showForm(this,"'.$row->id.'","'. $showUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Show</button>&nbsp;&nbsp;&nbsp;';
                            
                             
                                $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="d-none btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
                            return $action;

                        })
                       
                        ->rawColumns(['name','department','roles','email','action'])
                        ->make(true);
            }
        }

        public function show(Request $request): View
        {  
            $data['title'] = 'Employee';
            $data['sub_title'] = 'View';  
            $data['employee'] = User::with('department','reportingTo')->find($request->id);    
            $data['reportees'] = Reportee::where('employee_id',$request->id)->with('employee')->get();    
            // echo '<pre>';print_r($data['employee']->reportingTo);die;
            return view('user.employee.show',$data); 
        }

        public function create(): View
        {  
            $data['title'] = 'Employee';
            $data['sub_title'] = 'Create'; 
            $data['departments'] = Department::get(); 
            $data['employee'] = User::get();
            $data['roles'] = Role::pluck('name','id')->all();
            return view('user.employee.create',$data); 
        }

        public function update(Request $request): View
        {  
            $data['title'] = 'Employee';
            $data['sub_title'] = 'Update';  
            $data['departments'] = Department::get(); 
            $data['uinfo'] =$uinfo  = $emp = User::with('reportees')->find($request->id);     
            $data['reportees'] = Reportee::where('employee_id',$request->id)->pluck('reportee_id')->toArray(); 
            $data['employee'] = User::get(); 
            $data['roles'] = Role::pluck('name','id')->all(); 
            $data['userRole'] = $emp->roles->pluck('name','id')->all();
            return view('user.employee.update',$data); 
        }

        public function store(Request $request)
        {
 
            if($request->id){ 
              $id = $request->id;
                request()->validate([
                    'name' => 'required', 
                    'email' => 'required|email',  
                    'department' => 'required', 
                    'employment_start' => 'required', 
                    'date_of_birth' => 'required', 
                    'employee_code' => 'required', 
                    'roles' => 'required',
                    'manager' => 'required',
                    'reporting' => 'required',
                    ]);
                    $emp = User::find($request->id);
                    if(!empty($request->password) && isset($request->password)){
                        
                            $emp->update([
                                'name' => $request->name,    
                                'email' => $request->email,
                                'department_id' => $request->department,
                                'employment_start' => $request->employment_start,
                                'employment_end' => $request->employment_end,
                                'd_o_b' => $request->date_of_birth,
                                'employee_code' => $request->employee_code,
                                'reporting_to' => $request->reporting,
                                'manager_id' => $request->manager,
                                'password' => Hash::make($request->password),
                            ]);

                            Reportee::where('employee_id',$request->id)->delete(); 

                            $reportee = $request->reportee; 
                            
                            if(!empty($reportee[0])){
                                foreach($reportee as $key => $val){
                                    Reportee::create([
                                        'employee_id' => $request->id,    
                                        'reportee_id' => $reportee[$key], 
                                    ]);
                                }
                            }

                            DB::table('model_has_roles')->where('model_id',$id)->delete(); 
                            $emp->assignRole($request->input('roles'));
                    }else{
                       
                            $emp->update([
                                'name' => $request->name,    
                                'email' => $request->email, 
                                'department_id' => $request->department,
                                'employment_start' => $request->employment_start,
                                'employment_end' => $request->employment_end,
                                'd_o_b' => $request->date_of_birth,
                                'reporting_to' => $request->reporting,
                                'manager_id' => $request->manager,
                                'employee_code' => $request->employee_code,
                            ]);

                            Reportee::where('employee_id',$request->id)->delete();
                            
                            $reportee = $request->reportee; 
                            if(!empty($reportee[0])){
                                foreach($reportee as $key => $val){
                                    Reportee::create([
                                        'employee_id' => $request->id,    
                                        'reportee_id' => $reportee[$key], 
                                    ]);
                                }
                            }

                            DB::table('model_has_roles')->where('model_id',$id)->delete(); 
                            $emp->assignRole($request->input('roles'));
                    }
               

                return response()->json([
                    'success'=> 1,
                    'message'=>"Employee Updated successfully."
                ]);

            
            }else{ 
                request()->validate([
                    'name' => 'required', 
                    'email' => 'required|unique:users,email', 
                    'password' => 'required|min:8|confirmed', 
                    'department' => 'required', 
                    'employment_start' => 'required', 
                    'date_of_birth' => 'required', 
                    'employee_code' => 'required', 
                    'roles' => 'required', 
                    'reporting' => 'required',
                    'manager' => 'required',
                ]);
    
                $emp = User::create([
                    'name' => $request->name,    
                    'email' => $request->email,
                    'department_id' => $request->department,
                    'is_login' => 1,
                    'employment_start' => $request->employment_start,
                    'employment_end' => $request->employment_end,
                    'd_o_b' => $request->date_of_birth,
                    'employee_code' => $request->employee_code,
                    'reporting_to' => $request->reporting,
                    'manager_id' => $request->manager,
                    'password' => Hash::make($request->password),
                ]);

                $reportee = $request->reportee; 
                if(!empty($reportee[0])){
                    foreach($reportee as $key => $val){
                        Reportee::create([
                            'employee_id' => $emp->id,    
                            'reportee_id' => $reportee[$key], 
                        ]);
                    }
                }
 
    
                $emp->assignRole($request->input('roles'));

                return response()->json([
                    'success'=> 1,
                    'message'=>"Employee created successfully."
                ]);
            }
        
           
        }


        public function destroy(Request $request)
        {
           
            $emp = User::find($request->id); 
            $emp->delete();
            $leaveRequest = LeaveRequest::where('employee_id',$request->id)->get();
            $leaveRequest->delete();

            $Reportee = Reportee::where('employee_id',$request->id)->get();
            $Reportee->delete();

            return response()->json([
                'success'=> 1,
                'message'=>"Employee deleted successfully."
            ]);
         
          
        }

        

 
}