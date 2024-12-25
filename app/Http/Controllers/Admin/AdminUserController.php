<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Admin;
use App\Models\USer;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\AdminUserRequest;
use DataTables;
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Arr;

class AdminUserController extends Controller
{
    /**
     * Display the login view.
     */

     public function index(): View
        { 
           
            $data['title'] = 'Admin Users';
            $data['sub_title'] = 'Admin Users List';
            $data['admin_users'] = Admin::get();
            return view('admin.admin_user.index',$data);
        }
 
        public function list(Request $request)
        {
            
            if ($request->ajax()) {
    
                
                    $data = Admin::get(); 
 
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $name =  $row->name;
                            return $name;
                        })
                        ->addColumn('email', function($row){
                            $email =  $row->email;
                            return $email;
                        })
                        ->addColumn('roles', function($row){

                            $rolesArr =  $row->getRoleNames(); 
                            $roles = '';
                            foreach($rolesArr as $role){
                                $roles .= '<button type="button" class="btn-sm btn btn-light rounded-pill waves-effect">'.$role.'</button> ';
                            }
                              
                            return $roles;
                        })
                        ->addColumn('action', function($row){ 

                            $editUrl = route('admin.admin_user.update');
                            $action =  '<button type="button" onclick = editForm(this,"'.$row->id.'","'. $editUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;';

                            $deleteUrl = route('admin.admin_user.delete');
                            $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="d-none btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
                            return $action;
                        })
                       
                        ->rawColumns(['name','email','roles','action'])
                        ->make(true);
            }
        }

        public function create(): View
        {  

            $data['title'] = 'Admin Users';
            $data['sub_title'] = 'Create';  
            $data['roles'] = Role::pluck('name','id')->all();
           
            return view('admin.admin_user.create',$data); 
        }

        public function update(Request $request): View
        {  
            $data['title'] = 'Admin Users';
            $data['sub_title'] = 'Update';  
            $data['uinfo']= $admin = Admin::find($request->id);  
            $data['roles'] = Role::pluck('name','id')->all(); 
            $data['userRole'] = $admin->roles->pluck('name','id')->all();  
            return view('admin.admin_user.update',$data); 
        }

        public function store(Request $request)
        {
           
            if($request->id){
                $id = $request->id;
                request()->validate([
                    'name' => 'required', 
                    'email' => 'required|email',  
                    'roles' => 'required'
                    ]);
                    $admin = Admin::find($request->id);
                    if(!empty($request->password) && isset($request->password)){
                        
                        $admin->update([
                            'name' => $request->name,    
                            'email' => $request->email,
                            'password' => Hash::make($request->password),
                        ]);
 
                                DB::table('model_has_roles')->where('model_id',$id)->delete(); 
                                $admin->assignRole($request->input('roles'));
                    }else{
                       
                        $admin->update([
                            'name' => $request->name,    
                            'email' => $request->email, 
                        ]);
                        DB::table('model_has_roles')->where('model_id',$id)->delete(); 
                        $admin->assignRole($request->input('roles'));
                    }
               

                return response()->json([
                    'success'=> 1,
                    'message'=>"Admin User Updated successfully."
                ]);
               
            }else{
                request()->validate([
                    'name' => 'required', 
                    'email' => 'required|unique:admins,email', 
                    'password' => 'required|min:8|confirmed', 
                    'roles' => 'required'
                ]);

                
                $admin = Admin::create([
                    'name' => $request->name,    
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
 
                $admin->assignRole($request->input('roles'));
    
                return response()->json([
                    'success'=> 1,
                    'message'=>"Admin User created successfully."
                ]);
            }
           
        }


        public function destroy(Request $request)
        {
           
            $admin = Admin::find($request->id); 
            $admin->delete();

            return response()->json([
                'success'=> 1,
                'message'=>"Admin User deleted successfully."
            ]);
        }

        

 
}