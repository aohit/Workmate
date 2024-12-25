<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Admin; 
use App\Models\{User,Skill,Education,Certificate, Country, EmergencyContact, Language,UploadFile, WagesAndBenefits}; 
use App\Models\Department; 
use App\Models\Reportee; 
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Hash; 
use DataTables;
use DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display the login view.
     */

   


    protected $route;

    public function __construct()
    {
        $this->route = new \stdClass;

          $this->route->employee_detailsupdate = route('employee_detailsupdate');
          $this->route->employeeImage = route('employeeImage');
        
        $this->route->saveimage = route('saveimage');
    }

    public function index(): View
    { 
       
        $data['title'] = 'Employee';
        $data['sub_title'] = 'Employee List';
        $data['employees'] = User::get();
        $data['roles'] = Role::get();
        $data['departments'] = Department::where('status',1)->get();
        return view('user.employee.index',$data);
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
                        ->addColumn('department', function($row){ 
                                $department =  ucwords(@$row->department->name);
                                
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
            $data['departments'] = Department::where('status',1)->get(); 
            $data['employee'] = User::with('employeeRole')
                                ->whereHas('employeeRole', function($query) {
                                    $query->where('role_id', 2);
                                })->get();
            $data['roles'] = Role::pluck('name','id')->all();
            $data['languages'] = Language::get();
            $data['countris']  = Country::get();
            return view('user.employee.create',$data); 
        }

        public function update(Request $request): View
        {  
            $data['title'] = 'Employee';
            $data['sub_title'] = 'Update';  
            $data['departments'] = Department::where('status',1)->get(); 
            $data['uinfo'] =$uinfo  = $emp = User::with('reportees')->find($request->id);     
            $data['reportees'] = Reportee::where('employee_id',$request->id)->pluck('reportee_id')->toArray(); 
            $data['employee'] = User::with('employeeRole')
            ->whereHas('employeeRole', function($query) {
                $query->where('role_id', 2);
            })->get();
            $data['roles'] = Role::pluck('name','id')->all(); 
            $data['userRole'] = $emp->roles->pluck('name','id')->all();
            $userid = User::with('EmergencyContact')->find($request->id); 
            $languageid = $userid->language_id;  
            $data['employeelanguage'] = explode(',',$languageid);
            $data['language'] = Language::get();
            $data['countris']  = Country::get();
            $data['languages'] = Language::get();
            $data['countris']  = Country::get();
            return view('user.employee.update',$data); 
        }

        // public function store(Request $request)
        // {
 
        //     if($request->id){ 
        //       $id = $request->id;
        //         request()->validate([
        //             'name' => 'required', 
        //             'email' => 'required|email',  
        //             'department' => 'required', 
        //             'employment_start' => 'required', 
        //             'date_of_birth' => 'required', 
        //             'employee_code' => 'required', 
        //             'roles' => 'required',
        //             'manager' => 'required',
        //             'reporting' => 'required',
        //             ]);
        //             $emp = User::find($request->id);
        //             if(!empty($request->password) && isset($request->password)){
                        
        //                     $emp->update([
        //                         'name' => $request->name,    
        //                         'email' => $request->email,
        //                         'department_id' => $request->department,
        //                         'employment_start' => $request->employment_start,
        //                         'employment_end' => $request->employment_end,
        //                         'd_o_b' => $request->date_of_birth,
        //                         'employee_code' => $request->employee_code,
        //                         'reporting_to' => $request->reporting,
        //                         'manager_id' => $request->manager,
        //                         'password' => Hash::make($request->password),
        //                     ]);

        //                     Reportee::where('employee_id',$request->id)->delete(); 

        //                     $reportee = $request->reportee; 
                            
        //                     if(!empty($reportee[0])){
        //                         foreach($reportee as $key => $val){
        //                             Reportee::create([
        //                                 'employee_id' => $request->id,    
        //                                 'reportee_id' => $reportee[$key], 
        //                             ]);
        //                         }
        //                     }

        //                     DB::table('model_has_roles')->where('model_id',$id)->delete(); 
        //                     $emp->assignRole($request->input('roles'));
        //             }else{
                       
        //                     $emp->update([
        //                         'name' => $request->name,    
        //                         'email' => $request->email, 
        //                         'department_id' => $request->department,
        //                         'employment_start' => $request->employment_start,
        //                         'employment_end' => $request->employment_end,
        //                         'd_o_b' => $request->date_of_birth,
        //                         'reporting_to' => $request->reporting,
        //                         'manager_id' => $request->manager,
        //                         'employee_code' => $request->employee_code,
        //                     ]);

        //                     Reportee::where('employee_id',$request->id)->delete();
                            
        //                     $reportee = $request->reportee; 
        //                     if(!empty($reportee[0])){
        //                         foreach($reportee as $key => $val){
        //                             Reportee::create([
        //                                 'employee_id' => $request->id,    
        //                                 'reportee_id' => $reportee[$key], 
        //                             ]);
        //                         }
        //                     }

        //                     DB::table('model_has_roles')->where('model_id',$id)->delete(); 
        //                     $emp->assignRole($request->input('roles'));
        //             }
               

        //         return response()->json([
        //             'success'=> 1,
        //             'message'=>"Employee Updated successfully."
        //         ]);

            
        //     }else{ 
        //         request()->validate([
        //             'name' => 'required', 
        //             'email' => 'required|unique:users,email', 
        //             'password' => 'required|min:8|confirmed', 
        //             'department' => 'required', 
        //             'employment_start' => 'required', 
        //             'date_of_birth' => 'required', 
        //             'employee_code' => 'required', 
        //             'roles' => 'required', 
        //             'reporting' => 'required',
        //             'manager' => 'required',
        //         ]);
    
        //         $emp = User::create([
        //             'name' => $request->name,    
        //             'email' => $request->email,
        //             'department_id' => $request->department,
        //             'is_login' => 1,
        //             'employment_start' => $request->employment_start,
        //             'employment_end' => $request->employment_end,
        //             'd_o_b' => $request->date_of_birth,
        //             'employee_code' => $request->employee_code,
        //             'reporting_to' => $request->reporting,
        //             'manager_id' => $request->manager,
        //             'password' => Hash::make($request->password),
        //         ]);

        //         $reportee = $request->reportee; 
        //         if(!empty($reportee[0])){
        //             foreach($reportee as $key => $val){
        //                 Reportee::create([
        //                     'employee_id' => $emp->id,    
        //                     'reportee_id' => $reportee[$key], 
        //                 ]);
        //             }
        //         }
 
    
        //         $emp->assignRole($request->input('roles'));

        //         return response()->json([
        //             'success'=> 1,
        //             'message'=>"Employee created successfully."
        //         ]);
        //     }
        
           
        // }

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
                                'name' => $request->name,    
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
                                'session_id' => session('sessionId'),
                            ]);

                            Reportee::where('employee_id',$request->id)->delete(); 

                            $reportee = $request->reportee; 
                            
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
                              'name' => $request->name,    
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
                                'session_id' => session('sessionId'),
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
                    'name' => $request->name,    
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
                    'session_id' => session('sessionId'),
                ]);

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

    public function employeesProfile(Request $request)
    {
        $userid =  Auth::guard('web')->user()->id;
        $data['uinfo']= $emp = User::with('Image')->find($userid);
        return view('user.profile.tab.employee',$data); 
    }

    public function empSkills(Request $request)
    {
        
            $data['title'] = 'Employee';
            $data['sub_title'] = 'View';  
            $userid =  Auth::guard('web')->user()->id;
            $data['employee'] = Skill::with('employee')->where('employee_id',$userid)->get();  
            $data['uinfo']= $emp = User::with('Image')->find($userid);
            $data['skills'] = Skill::where('employee_id',Auth::guard('web')->user()->id)->get();
            //  echo "<pre>";print_r($data);die;   
           return view('user.profile.tab.skills',$data); 
    }
    
    public function employeeEducation(Request $request)
    {  
        $data['title'] = 'Education';
        $data['sub_title'] = 'View';  
        $userid =  Auth::guard('web')->user()->id;
        $data['wageses'] = WagesAndBenefits::where('user_id',$userid)->get();  
        return view('user.profile.tab.education',$data); 
    }
    
    public function employeeCertificate(Request $request)
    {   
        $data['title'] = 'Certificate';
        $data['sub_title'] = 'View';  
        $userid =  Auth::guard('web')->user()->id;
        $data['certificates'] = Certificate::with('employee')->where('user_id',$userid)->get();  
        return view('user.profile.tab.certificate',$data); 
    }
    public function employeelanguage(Request $request)
    {  
        $data['title'] = 'Language';
        $data['sub_title'] = 'View';  
        $userid =  Auth::guard('web')->user()->id;
        $data['employee'] = User::select('users.*', DB::raw('(SELECT GROUP_CONCAT(languages.name) 
        FROM languages WHERE FIND_IN_SET(languages.id, users.language_id)) AS language_names'))->where('id',$userid)
        ->get();
        $data['lans'] =  Language::get();
        return view('user.profile.tab.language',$data); 
    }

    public function employeedependents(Request $request)
    {  
        return view('user.profile.tab.dependents'); 
    }


    public function employeeEmergencyContact(Request $request)
    {  
        $data['title'] = 'Emergency Contact';
        $data['sub_title'] = 'View';  
        $userid =  Auth::guard('web')->user()->id;
        $data['employee'] = EmergencyContact::where('user_id',$userid)->get();  
        // echo "<pre>";print_r($data['employee']);die;
        return view('user.profile.tab.emergency',$data); 
    }

    public function EmergencyContactUpdate(Request $request){

        request()->validate([
            'name' => 'required', 
            'relation' => 'required',
            'contact' => 'required',
        ]);
        $data = EmergencyContact::find($request->id); 
        $data->update([
            'name' => $request->name,    
            'relation' => $request->relation,
            'number' => $request->contact,
            'user_id' => Auth::guard('web')->user()->id,
        ]);
        $employee = EmergencyContact::where('user_id',Auth::guard('web')->user()->id)->get();
        $view =  view('user.profile.tab.subtab.empEmergencyContect',compact('employee'))->render();
        return response()->json([
            'success'=> 1,
            'message'=>"Emergency contact update successfully.",
            'view'=>$view
        ]);
    }

    public function EmergencyContactStore(Request $request){
    
        request()->validate([
            'name' => 'required', 
            'relation' => 'required',
            'contact' => 'required',
        ]);

        $emp = EmergencyContact::create([
            'name' => $request->name,    
            'relation' => $request->relation,
            'number' => $request->contact,
            'user_id' =>Auth::guard('web')->user()->id,
        ]);
        $employee = EmergencyContact::where('user_id',Auth::guard('web')->user()->id)->get();
        // echo "<pre>"; print_r($employee->toArray()); die;
        $view =  view('user.profile.tab.subtab.empEmergencyContect',compact('employee'))->render();
        return response()->json([
            'success'=> 1,
            'message'=>"Emergency contact creat successfully.",
            'view'=>$view
        ]);

    }

    public function EmergencyContactRemove(Request $request){
        $data = EmergencyContact::destroy($request->id); 
        
        $employee = EmergencyContact::where('user_id',Auth::guard('web')->user()->id)->get();
        $view =  view('user.profile.tab.subtab.empEmergencyContect',compact('employee'))->render();

        return response()->json([
            'success'=> 1,
            'message'=>"Emergency contact destory successfully.",
            'view'=>$view
        ]);
    }


    public function employeeProfileEdit(Request $request)
    { 
        $data['title'] = 'Personal Information';
        $userid =  Auth::guard('web')->user()->id;
        $data['departments'] = Department::where('status',1)->get(); 
        $data['employee'] = User::get(); 
        $data['reportees'] = Reportee::where('employee_id',$request->id)->pluck('reportee_id')->toArray();   
        $data['roles'] = Role::pluck('name','id')->all(); 
        $data['info']= $emp = User::with('EmergencyContact')->find($userid);
        // echo "<pre>"; print_r($emp->toArray()); die;
        $data['language'] = Language::get();
        $data['countris']  = Country::get();
        return view('user.profile.edit',$data,['route'=>$this->route ]); 
    }



    public function employeeDetailsupdate(Request $request)
    { 
           
        $validator = Validator::make(
            $request->all(),
            [
                    'national_id' => 'required',
                    'phone_number' => 'required',
                    'nationality' => 'required',
                    'residention_address' => 'required',
                    'marital_status' => 'required',
                    'emergency_contact_number.*' => 'required',
                    'emergency_contact_person.*' => 'required',
                    'emergency_contact_relaton.*' => 'required',

            ]
          );  
          
          if($validator->fails())
          {
            return response()->json(['status'=>0 ,'errors'=>$validator->errors()]);
          }else{
            // echo "<pre>"; print_r($request->toArray()); die;  
            $info= User::find($request->id)->fill([
                            'national_id' => $request->national_id,
                            'nationality' => $request->nationality,
                            'phone_number' => $request->phone_number,
                            'marital_status' => $request->marital_status,
                            'emergency_contact' => $request->emergency_contact,
                            'residention_address' => $request->residention_address,
                
            ])->save();

            $emerContacts = EmergencyContact::where('user_id',$request->id)->get();

            foreach ($emerContacts as $emerContact) {
                $emerContact->delete();
            }
            
            // foreach($request->emergency_contact_number as $key => $value){
                
            //     EmergencyContact::create([
            //             'name'=>$request->emergency_contact_person[$key],
            //             'number'=>$value,
            //             'relation'=>$request->emergency_contact_relaton[$key],
            //             'user_id'=> $request->id
            //     ]);
            // }
            return response()->json(['status'=> 1 , 'message' => 'updated successfully']);
         
          }
    }

    public function addImage()
    {
        $data['title'] = 'Upload Image';
        $data['sub_title'] = 'Upload'; 
        $data['employee'] = User::get();
        return view('user.profile.upload' , $data,['route'=>$this->route ]); 
       
    }


    public function employeeImage(Request $request)
    {
        
        $id =  Auth::guard('web')->user()->id;
    //    echo "<pre>";print_r($id);die;   
       
        $validator = Validator::make(
            $request->all(),
            [   
                'icon'=>'required',
            ]
            
        );
            if($validator->fails()){
                return response()->json(['status' => 0,'errors' =>  $validator->errors()]);
            }else{
                $info = User::find($id)->fill([
                    'file_id'=>$request->file_id,
             ])->save();
           
            
                return response()->json(['status' => 1, 'message' =>'saved successfully' ]);
            }
        }
    




    public function imageupload(Request $request)
    {
        $id = Auth::guard('web')->user()->id;
        $users = User::get(); 
        $type = $request->type;
        $path = $type . '_path';
        $name = $type . '_name';
        $file_name = $request->$name;
        $file_path = $request->$path;
        $file = $request->file('image');
        
        if (!empty($file)) {
            $ext = $file->getClientOriginalExtension();
            $destinationPath = public_path().'/'.$file_path;
            $file_name = time().".".$file->getClientOriginalExtension();
            $file->move($destinationPath,$file_name);
            $movedFile =  $file_name;
        
            $file_data = UploadFile::create([
                'file' => $movedFile,
            ]);
        
            $user = User::find($id);
            $user->file_id = $file_data->id;
            $user->save();
        
            return response()->json(['status' => 1, 'file_id' => $file_data->id, 'file_path' => asset($file_path . $file_data->file)]);
        } else {
            return response()->json(['status' => 0, 'msg' => 'File type not allowed']);
        }
        
    }


    public function imagedestroy(Request $request)
    {
    //    echo "RR";die;
        $id = Auth::guard('web')->user()->id;
        $user = User::find($id);
        
        if ($user->file_id) {
            $file = UploadFile::find($user->file_id);
        
            $file->delete();
        
            $user->file_id = null;
            $user->save();
        
            $file_path = public_path($file->file); 
            if (file_exists($file_path)) {
                unlink($file_path); 
            }
        
            return response()->json(['status' => 1, 'msg' => 'Image deleted successfully']);
        } else {
            return response()->json(['status' => 0, 'msg' => 'No image associated with the user']);
        }
     }

     public function addEmployeeSkill(){
       
        return view('user.profile.tab.subtab.addskill'); 
     }

     public function removeEmployeeSkill(Request $request) {
            Skill::find($request->id)->delete();
            $skills =   Skill::where('employee_id',Auth::guard('web')->user()->id)->get();
            $view =  view('user.profile.tab.subtab.showSkill',compact('skills'))->render();
        return response()->json(['status' => 1, 'msg' => 'Skill Remove successfully','skills'=>$view]);
     }

     public function StoreEmployeeSkill(Request $request){

        $validated = $request->validate([
            'skill' => 'required|max:20',
        ]);
        $empoyeeSkills =  Skill::where('employee_id',Auth::guard('web')->user()->id)->count();
                    if($empoyeeSkills <= 8){ 

                        Skill::create([
                            'employee_id'=> Auth::guard('web')->user()->id,
                            'skills'=>$request->skill,
                        ]);
                    $skills =   Skill::where('employee_id',Auth::guard('web')->user()->id)->get();
                          $view =  view('user.profile.tab.subtab.showSkill',compact('skills'))->render();
                            return response()->json(['status' => 1, 'msg' => 'Skill Insert successfully','skills'=>$view]);
                    }else{
                        return response()->json(['status' => 2, 'msg' => 'Employee Skill is greater than 8.']);
                    }

     }

     public function addEmployeecertificate(){
        return view('user.profile.tab.subtab.addcertificate'); 
     }

     public function storeEmployeecertificate(Request $request){
         $validated = $request->validate([
             'certificate' => 'required|extensions:jpeg,png,jpg,png,svg',
             'certificatename' => 'required',
             ]);

           $file_path = 'upload/certificate/';
            $file = $request->file('certificate');

            if (!empty($file)) {
                $user = Auth::guard('web')->user();
                $destinationPath = $file_path;
                $file_name = time().".".$file->getClientOriginalExtension();
                $file->move($destinationPath,$file_name);
                $movedFile =  $file_name;
                
                $info = Certificate::create([
                    'user_id'=>$user->id,
                    'certificate_name'=>$request->certificatename,
                    'department_id'=>$user->department_id,
                    'file'=>$movedFile,
                ]);
                $certificates = Certificate::with('employee')->where('user_id',Auth::guard('web')->user()->id)->get();
            $view = view('user.profile.tab.subtab.employeecertificate',compact('certificates'))->render();

                return response()->json([
                    'success'=> 1,
                    'view' => $view,
                    'message'=>"Employee Certificate Insert Successfully."
                ]);
            }else{
                return response()->json([
                    'success'=> 2
                ]);
            }
    
    }

    public function deleteEmployeecertificate(Request $request){

        $Certificate =  Certificate::find($request->id);
        if(  $Certificate->user_id == Auth::guard('web')->user()->id){
            $Certificate->delete();
            $certificates = Certificate::with('employee')->where('user_id',Auth::guard('web')->user()->id)->get();
            $view = view('user.profile.tab.subtab.employeecertificate',compact('certificates'))->render();
            return response()->json([
                'success'=> 1,
                'view'=>$view,
                'message'=>"Employee Certificate deleted Successfully."
            ]);
        }else{
            return response()->json([
                'success'=> 2
            ]);
        }
    }


}