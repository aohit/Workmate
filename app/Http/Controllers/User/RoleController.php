<?php
    
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use DataTables;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
       
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View 
    { 
        $data['nav'] = 'Access Management';
        $data['sub_nav'] = '';
        $data['title'] = 'Access Management';
        return view('user.roles.index',$data);
    }
   

    public function create(): View
    {  
        $data['title'] = 'Access Management';
        $data['sub_title'] = 'Create';  
        $data['permission'] = Permission::get();
        return view('user.roles.create',$data); 
    }
   
    public function store(Request $request): JsonResponse
    {
        if($request->id){
            $id = $request->id;
            $this->validate($request, [
                'name' => 'required',
                'permission' => 'required',
            ]);
        
            $role = Role::find($id);
            $role->name = $request->input('name'); 
            $role->guard_name = 'web';
            $role->save();
        
            $role->syncPermissions($request->input('permission'));
    
            return response()->json([
                'success'=> 1,
                'message'=>"Role updated successfully."
            ]);
        }else{
            
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
         
        $role = Role::create(['name' => $request->input('name'),'guard_name'=> 'web']);
        
        $role->syncPermissions($request->input('permission'));

        return response()->json([
            'success'=> 1,
            'message'=>"Role created successfully."
        ]);
    }

   
     
    }
    
    // public function show($id): View
    // {
    //     $data['nav'] = 'dashboard';
    //     $data['sub_nav'] = '';
    //     $data['title'] = 'Dashboard';
    //     $data['role'] = Role::find($id);
    //     $data['permission'] = Permission::get();
    //     $data['rolePermissions'] = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
    //         ->where("role_has_permissions.role_id",$id)
    //         ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
    //         ->all();
    
    //     return view('admin.roles.show',$data);
    // }
    
    public function update(Request $request): View
    {  
        $data['title'] = 'Access Management';
        $data['sub_title'] = 'Update';  
        $data['role'] = Role::find($request->id);
        $data['permission'] = Permission::get();
        $data['rolePermissions'] = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$request->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();  

        return view('user.roles.update',$data); 
    }
    
    // public function destroy($id)
    // {
    //     DB::table("roles")->where('id',$id)->delete();

    //     return response()->json(['success'=>1,'message'=>'Role deleted successfully.']);
    // }

    public function destroy(Request $request)
    {
        DB::table("roles")->where('id',$request->id)->delete();
         
        return response()->json([
            'success'=> 1,
            'message'=>"Role deleted successfully."
        ]);
    }

    public function list(Request $request)
    {
      
        if ($request->ajax()) {
    
                
            $data = Role::get(); 
      
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function($row){
                    $name =  $row->name;
                    return $name;
                }) 
                ->addColumn('action', function($row){ 


                    
                        $editUrl = route('roles.update');
                        $action =  '<button type="button" onclick = editForm(this,"'.$row->id.'","'. $editUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;';
                     

                     
                        $deleteUrl = route('roles.delete');
                        $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="d-none btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
                     

                   

                   
                    return $action;
                })
               
                ->rawColumns(['name','action'])
                ->make(true);
    }
    }	
}