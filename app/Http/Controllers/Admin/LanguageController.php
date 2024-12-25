<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Admin; 
use App\Models\{User,Skill,Language}; 
use App\Models\Reportee; 
use App\Models\Department; 
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Hash; 
use DataTables;
use DB;
use Spatie\Permission\Models\Role;

class LanguageController extends Controller
{
    public function index(): View
    { 
       
        $data['title'] = 'Language';
        $data['sub_title'] = 'Language';
        $data['employees'] = User::get();
        return view('admin.languages.index',$data);
    }


    public function list(Request $request)
    {
      
        if ($request->ajax()) {
    
                
       $data = Language::get(); 
      
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function($row){
                    $name =  $row->name;
                    return $name;
                }) 
              
                ->addColumn('action', function($row) { 
                    $editUrl = route('admin.languages.update');
                    $deleteUrl = route('admin.languages.delete');
                    $action = '<div class="flexblockclass gap-1">';
                    $action .= '<button type="button" onclick="editForm(this, \'' . $row->id . '\', \'' . $editUrl . '\')" class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>';
                    $action .= '<button type="button" onclick="deleteRow(this, \'' . $row->id . '\', \'' . $deleteUrl . '\')" class="btn-sm btn btn-outline-danger waves-effect waves-light mb-0">Delete</button>';
                    $action .= '</div>';
                    return $action;
                })
               
                ->rawColumns(['name','action'])
                ->make(true);
    }
    }
         
    public function create(Request $request)
    {
         $data['title'] = 'Language';
        $data['sub_title'] = 'Add Language'; 
        $data['employee'] = Language::get();
        $data['user']  = auth()->user();
        return view('admin.languages.create',$data); 
    }
    
    public function update(Request $request): View
    {  
        $data['title'] = 'Skills';
        $data['sub_title'] = 'Update';  
        $data['uinfo'] = Language::find($request->id);    
        return view('admin.languages.update',$data); 
    }



    public function store(Request $request)
    {      
            if($request->id){ 
              $id = $request->id;
                request()->validate([
                    
                    'name' => 'required', 
                    ]);

                $admin = Language::find($request->id);
               
                    $admin->update([
                        'name' => $request->name,    
                    ]);     
               
                return response()->json([
                    'success'=> 1,
                    'message'=>"Language Updated successfully."
                ]);

            }else{ 
                request()->validate([
                    'name' => 'required',  
                  
                ]);
    
                $emp = Language::create([
                    'name' => ucfirst($request->name),    
                ]);

                return response()->json([
                    'success'=> 1,
                    'message'=>"Language Insert Successfully."
                ]);
            }
        }


         public function destroy(Request $request)
        {
           
            $data = Language::find($request->id); 
            $data->delete(); 

            return response()->json([
                'success'=> 1,
                'message'=>"Language deleted successfully."
            ]);
         
          
        }

}
