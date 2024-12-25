<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EmployeesExport;
use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Admin;
use App\Models\Country;
use App\Models\User; 
use App\Models\Reportee; 
use App\Models\Department;
use App\Models\EmergencyContact;
use App\Models\Language;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Hash; 
use DataTables;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use App\Models\EmployeeLeaveHistory;
use App\Models\LeaveType;
class EmployeeController extends Controller
{
    /**
     * Display the login view.
     */

   

     public function index(): View
        { 
           
            $data['title'] = 'Employee';
            $data['sub_title'] = 'Employee List';
            $data['employees'] = User::get();
            $data['roles'] = Role::get();
            $data['departments'] = Department::where('status',1)->get();
            return view('admin.employee.index',$data);
        }
 
        public function list(Request $request)
        { 
            if ($request->ajax()) {
    
                if(!empty($request->departmentId) && !empty($request->roleId)){
                    $roleId = $request->roleId;
                    $data = User::where('department_id', $request->departmentId)
                            ->whereHas('roles', function ($query) use ($roleId) {
                               $query->where('roles.id', $roleId);
                            })
                      ->get();
                       }elseif(!empty($request->departmentId)){
                           $data = User::where('department_id', $request->departmentId)->get();
                       }elseif(!empty($request->roleId)){
                           $roleId = $request->roleId; 
                           $data = User::whereHas('roles', function ($query) use ($roleId) {
                               $query->where('roles.id', $roleId);
                           })->get();
                       }else{
                           $data = User::get();  
                }
                    
                    
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('name', function($row){
                            $name =  $row->name;
                            return ucwords($name);
                        })
                        ->addColumn('email', function($row){
                            $email =  $row->email;
                            return $email;
                        })
                        ->addColumn('jobtitle', function($row){
                            $jobTitle =  $row->job_title;
                            return $jobTitle;
                        })
                        ->addColumn('department', function($row){ 
                                $department =  $row->department?->name; 
                            return $department;

                        })
                        ->addColumn('roles', function($row){

                            $rolesArr =  $row->getRoleNames(); 
                            $roles = '';
                            foreach($rolesArr as $role){
                                $roles .= '<span class="badge bg-success">'.$role.'</span>';
                            }
                              
                            return $roles;
                        })
                        ->addColumn('action', function($row) {
                            $editUrl = route('admin.employee.update');
                            $showUrl = route('admin.employee.show');
                            $deleteUrl = route('admin.employee.delete');
                            
                            $action = '<div class="flexblockclass">';
                                $action .= '<button type="button" onclick="editForm(this, \'' . $row->id . '\', \'' . $editUrl . '\')"
                                    class="btn-sm btn btn-outline-dark waves-effect waves-light me-1">Edit</button>';
                               
                                $action .= '<button type="button" onclick="showForm(this, \'' . $row->id . '\', \'' . $showUrl . '\')"
                                    class="btn-sm btn btn-outline-info waves-effect waves-light me-1">Show</button>';
                                
                                $action .= '<button type="button" onclick="deleteRow(this, \'' . $row->id . '\', \'' . $deleteUrl . '\')"
                                    class="btn-sm btn btn-outline-danger waves-effect waves-light mb-0">Delete</button>';
                                $action .= '</div>';
                            
                            return $action;
                            })

                       
                        ->rawColumns(['name','department','roles','email','jobtitle','action'])
                        ->make(true);
            }
        }

        public function show(Request $request): View
        {  
            $data['title'] = 'Employee';
            $data['sub_title'] = 'View';  
            $data['employee'] = $user = User::with('department','reportingTo','county')->find($request->id);    
            $data['reportees'] = Reportee::where('employee_id',$request->id)->with('employee')->get(); 
            $data['lenuages']  = Language::where('id',$user->language_id)->get(); 
            // echo '<pre>';print_r($data['lenuages']->toArray());die;
            return view('admin.employee.show',$data); 
        }

        public function create(): View
        {  
            $data['title'] = 'Employee';
            $data['sub_title'] = 'Create'; 
            $data['departments'] = Department::where('status',1)->get();
            // $data['employee'] = User::get(); 
            $data['employee'] = User::with('employeeRole')
            ->whereHas('employeeRole', function($query) {
                $query->where('role_id', 2);
            })->get();  
            $data['roles'] = Role::pluck('name','id')->all();
            $data['languages'] = Language::get();
            $data['countris']  = Country::get();
            return view('admin.employee.create',$data); 
        }

        public function update(Request $request): View
        {  
            $data['title'] = 'Employee';
            $data['sub_title'] = 'Update';  
            $data['departments'] = Department::where('status',1)->get(); 
            // $data['employee'] = User::get(); 
            $data['employee'] = User::with('employeeRole')
            ->whereHas('employeeRole', function($query) {
                $query->where('role_id', 2);
            })->get();  
            $data['uinfo'] =$uinfo  = $emp = User::with('reportees')->find($request->id);   
            $data['reportees'] = Reportee::where('employee_id',$request->id)->pluck('reportee_id')->toArray();   
            $data['roles'] = Role::pluck('name','id')->all(); 
            $data['userRole'] = $emp->roles->pluck('name','id')->all();
            $userid = User::with('EmergencyContact')->find($request->id); 
            $languageid = $userid->language_id;  
            $data['employeelanguage'] = explode(',',$languageid);
            $data['language'] = Language::get();
            $data['countris']  = Country::get();
            return view('admin.employee.update',$data); 
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
                    // 'reporting' => 'required',
                    'manager' => 'required',
                    'national_id' => 'required',
                    'phone_number' => 'required',
                    'gender' => 'required',
                    'nationality' => 'required',
                    'marital_status' => 'required',
                    'residention_address' => 'required',
                    'emergency_contact_relaton.*'=>'required',
                    'emergency_contact_person.*'=>'required',
                    'emergency_contact_number.*'=>'required',
                    'language_id.*'=>'required',
                    'language_id'=>'required',
                    'job_title'=>'required',
                    ]);
                    $emp = User::find($request->id);
                    if(!empty($request->password) && isset($request->password)){
                        
                            $emp->update([
                                'name' => ucfirst($request->name),    
                                'email' => $request->email,
                                'department_id' => $request->department,
                                'employment_start' => $request->employment_start,
                                'employment_end' => $request->employment_end,
                                'd_o_b' => $request->date_of_birth,
                                'employee_code' => $request->employee_code,
                                // 'reporting_to' => $request->reporting,
                                'manager_id' => $request->manager,
                                'password' => Hash::make($request->password),
                                'national_id' => $request->national_id,
                                'gender' => $request->gender,
                                'nationality' => $request->nationality,
                                'phone_number' => $request->phone_number,
                                'marital_status' => $request->marital_status,
                                'emergency_contact' => $request->emergency_contact,
                                'residention_address' => $request->residention_address,
                                'job_title' => $request->job_title,
                            ]);

                            Reportee::where('employee_id',$request->id)->delete(); 

                            // $reportee = $request->reportee; 
                            
                            // if(!empty($reportee[0])){
                            //     foreach($reportee as $key => $val){
                            //         Reportee::create([
                            //             'employee_id' => $request->id,    
                            //             'reportee_id' => $reportee[$key], 
                            //         ]);
                            //     }
                            // }
                            if(!empty($request->language_id)){
                                $languages = $request->language_id; 
                                $languagesid = implode(',',$languages);
                                User::find($emp->id)->fill([
                                    'language_id'=>$languagesid,
                                    ])->save();
                                }

                            DB::table('model_has_roles')->where('model_id',$id)->delete(); 
                            $emp->assignRole($request->input('roles'));

                            $emerContacts = EmergencyContact::where('user_id',$request->id)->get();

                            foreach ($emerContacts as $emerContact) {
                                $emerContact->delete();
                            }
                            
                            foreach($request->emergency_contact_number as $key => $value){
                                
                                EmergencyContact::create([
                                        'name'=>$value,
                                        'number'=>$request->emergency_contact_person[$key],
                                        'relation'=>$request->emergency_contact_relaton[$key],
                                        'user_id'=> $request->id
                                ]);
                            }
                    }else{
                       
                            $emp->update([
                                'name' => ucfirst($request->name),     
                                'email' => $request->email, 
                                'department_id' => $request->department,
                                'employment_start' => $request->employment_start,
                                'employment_end' => $request->employment_end,
                                'd_o_b' => $request->date_of_birth,
                                // 'reporting_to' => $request->reporting,
                                'manager_id' => $request->manager,
                                'employee_code' => $request->employee_code,
                                'national_id' => $request->national_id,
                                'gender' => $request->gender,
                                'nationality' => $request->nationality,
                                'phone_number' => $request->phone_number,
                                'marital_status' => $request->marital_status,
                                'emergency_contact' => $request->emergency_contact,
                                'residention_address' => $request->residention_address,
                                'job_title' => $request->job_title,
                            ]);

                            Reportee::where('employee_id',$request->id)->delete();
                            
                            // $reportee = $request->reportee; 
                            // if(!empty($reportee[0])){
                            //     foreach($reportee as $key => $val){
                            //         Reportee::create([
                            //             'employee_id' => $request->id,    
                            //             'reportee_id' => $reportee[$key], 
                            //         ]);
                            //     }
                            // }
                            $languages = $request->language_id; 
                            $languagesid = implode(',',$languages);
                            User::find($emp->id)->fill([
                                        'language_id'=>$languagesid,
                                   ])->save();

                            DB::table('model_has_roles')->where('model_id',$id)->delete(); 
                            $emp->assignRole($request->input('roles'));

                            $emerContacts = EmergencyContact::where('user_id',$request->id)->get();

                            foreach ($emerContacts as $emerContact) {
                                $emerContact->delete();
                            }
                            
                            foreach($request->emergency_contact_number as $key => $value){
                                
                                EmergencyContact::create([
                                    'name'=>$value,
                                    'number'=>$request->emergency_contact_person[$key],
                                    'relation'=>$request->emergency_contact_relaton[$key],
                                    'user_id'=> $request->id
                                ]);
                            }
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
                    // 'roles.*' => 'required', 
                    // 'reporting' => 'required',
                    'manager' => 'required',
                    'national_id' => 'required',
                    'phone_number' => 'required',
                    'gender' => 'required',
                    'nationality' => 'required',
                    'marital_status' => 'required',
                    'residention_address' => 'required',
                    'language_id'=>'required',
                    'language_id.*'=>'required',
                    'emergency_contact_relaton.*'=>'required',
                    'emergency_contact_person.*'=>'required',
                    'emergency_contact_number.*'=>'required',
                    'job_title'=>'required',
                ]);
    
                $emp = User::create([
                    'name' => ucfirst($request->name),      
                    'email' => $request->email,
                    'department_id' => $request->department,
                    'is_login' => 1,
                    'employment_start' => $request->employment_start,
                    'employment_end' => $request->employment_end,
                    'd_o_b' => $request->date_of_birth,
                    'employee_code' => $request->employee_code,
                    // 'reporting_to' => $request->reporting,
                    'manager_id' => $request->manager,
                    'password' => Hash::make($request->password),
                    'national_id' => $request->national_id,
                    'phone_number' => $request->phone_number,
                    'gender' => $request->gender,
                    'nationality' => $request->nationality,
                    'marital_status' => $request->marital_status,
                    'residention_address' => $request->residention_address,
                    'job_title' => $request->job_title,
                ]);


                $leaveTypes = LeaveType::where('status',1)->get();
                foreach($leaveTypes as $leaveType){
                    $data = EmployeeLeaveHistory::create([
                        'employee_id' => $emp->id,
                        'leave_type_id' => $leaveType->id,
                        'total_leave_days' => $leaveType->leave_days,
                        'booked' => 0,
                        'remaining' => $leaveType->leave_days,
                    ]); 
                }
                
                // $reportee = $request->reportee; 
                // if(!empty($reportee[0])){
                //     foreach($reportee as $key => $val){
                //         Reportee::create([
                //             'employee_id' => $emp->id,    
                //             'reportee_id' => $reportee[$key], 
                //         ]);
                //     }
                // }

                $languages = $request->language_id; 
                $languagesid = implode(',',$languages);
                User::find($emp->id)->fill([
                            'language_id'=>$languagesid,
                       ])->save();
                    
                       foreach($request->emergency_contact_number as $key => $value){
                
                        EmergencyContact::create([
                                'name'=>$value,
                                'number'=>$request->emergency_contact_person[$key],
                                'relation'=>$request->emergency_contact_relaton[$key],
                                'user_id'=> $emp->id
                        ]);
                    }
    
                $emp->assignRole($request->input('roles'));

                return response()->json([
                    'success'=> 1,
                    'message'=>"Employee created successfully."
                ]);
            }
        
           
        }


        // public function destroy(Request $request)
        // {
           
        //     $emp = User::find($request->id); 
        //     $emp->delete();
        //     $leaveRequest = LeaveRequest::where('employee_id',$request->id)->get();
        //     $leaveRequest->delete();

        //     $Reportee = Reportee::where('employee_id',$request->id)->get();
        //     $Reportee->delete();

        //     return response()->json([
        //         'success'=> 1,
        //         'message'=>"Employee deleted successfully."
        //     ]);
         
          
        // }
        
        public function destroy(Request $request)
        {
            $emp = User::find($request->id);
            if ($emp) {
                $emp->delete();
            }
            LeaveRequest::where('employee_id', $request->id)->delete();
            Reportee::where('employee_id', $request->id)->delete();
            
            return response()->json([
                'success' => 1,
                'message' => "Employee deleted successfully."
            ]);
        }


    public function export() 
    {
    //    $data =  User::with('department','county','languagesEmp',  'reportingTo', 'manager','skills','education','EmergencyContact')
    //                ->get();
    //                echo "<pre>"; print_r($data->toArray()); die;
        return Excel::download(new EmployeesExport, 'users.xlsx');
    }

        

 
}