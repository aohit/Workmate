<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EmergencyContactsExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Admin; 
use App\Models\{EmergencyContact, User}; 
use App\Models\Department; 
use Illuminate\Support\Facades\Hash; 
use DataTables;
use DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use App\Exports\EmployeesExport;
use App\Exports\SkillsExport;
use Maatwebsite\Excel\Facades\Excel;


class EmergencycontactController extends Controller
{
    public function index(): View
    {
        $data['title'] = 'Employee Emergency Contact';
        $data['sub_title'] = 'Employee Emergency Contact';
        $data['departments'] = Department::where('status',1)->get();
        $data['employee'] = User::get();
        return view('admin.emergency_contact.index',$data);
    }


    // public function list(Request $request)
    // {
    //    if ($request->ajax()) {

    // $departmentId = $request->departmentId; 
    // if(!empty($request->departmentId) && isset($request->departmentId)){
    
    //     $data = EmergencyContact::with(['user' => function ($query) use ($departmentId) {
    //         $query->where('department_id', $departmentId);
    //     }])->whereHas('user', function ($query) use ($departmentId) {
    //         $query->where('department_id', $departmentId);
    //     })->get();
    // } else {
    //     $data = EmergencyContact::with('user:id,name,department_id')->get();
      
    // }

    //     return DataTables::of($data)
    //             // ->addIndexColumn()
    //             // ->addColumn('user_id', function($row){
    //             //     return @$row->user->name;
    //             // }) 
    //             ->addIndexColumn()
    //             ->addColumn('departmentname', function($row) {
    //                 if ($row->user && $row->user->department_id) {
    //                     $departmentID = $row->user->department_id;
    //                     $departmentname = Department::where('id', $departmentID)->select('name')->first();
                        
    //                     return $departmentname ? $departmentname->name : ' ';
    //                 } else {
    //                     return ' '; 
    //                 }
    //             })
    //             ->addIndexColumn()
    //             ->addColumn('name', function($row){
    //                 $name =   @$row->user->name;
    //                 return $name;
    //             })
    //             ->addColumn('number', function($row){
    //                 $number =  $row->number;
    //                 return $number;
    //             })
    //             ->addColumn('relation', function($row){
    //                 $relation =  $row->relation;
    //                 return $relation;
    //             })
    //             ->addColumn('action', function($row){ 

    //                 // $editUrl = route('admin.emergency.update');
    //                 // $action =  '<button type="button" onclick = editForm(this,"'.$row->id.'","'. $editUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;';

    //                 //  $deleteUrl = route('admin.emergency.delete');
    //                 // $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
    //                 // return $action;
    //             })
               
    //             ->rawColumns(['name','relation','number','user_id','departmentname','action'])
    //             ->make(true);
    // }
    // }


    public function list(Request $request)
    {
       if ($request->ajax()) {

    $departmentId = $request->departmentId; 
    if(!empty($request->departmentId) && isset($request->departmentId)){
    
        $data = EmergencyContact::with(['user' => function ($query) use ($departmentId) {
            $query->where('department_id', $departmentId);
        }])->whereHas('user', function ($query) use ($departmentId) {
            $query->where('department_id', $departmentId);
        })->get();
    } else {
        $data = EmergencyContact::with('user:id,name,department_id')->get();
      
    }
//   echo "<pre>";print_r($data->toArray());die;
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user_id', function($row){
                    return ucwords(@$row->user->name);
                }) 
                ->addIndexColumn()
                    ->addColumn('departmentname', function($row) {
                        if ($row->user && $row->user->department_id) {
                            $departmentID = $row->user->department_id;
                            $departmentname = Department::where('id', $departmentID)->select('name')->first();
                            
                            return $departmentname ? ucwords($departmentname->name) : ' ';
                        } else {
                            return ' '; 
                        }
                    })
                ->addIndexColumn()
                ->addColumn('name', function($row){
                    $name =  $row->name;
                    return $name;
                })
                ->addColumn('number', function($row){
                    $number =  $row->number;
                    return $number;
                })
                ->addColumn('relation', function($row){
                    $relation =  $row->relation;
                    return $relation;
                })
                ->addColumn('action', function($row){ 

                    // $editUrl = route('admin.emergency.update');
                    // $action =  '<button type="button" onclick = editForm(this,"'.$row->id.'","'. $editUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;';

                    //  $deleteUrl = route('admin.emergency.delete');
                    // $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
                    // return $action;
                })
               
                ->rawColumns(['name','relation','number','user_id','action','departmentname'])
                ->make(true);
    }
    }

   
    public function create(Request $request)
    {
         $data['title'] = 'Employee Emergency Contact';
        $data['sub_title'] = 'Employee Emergency Contact'; 
        $data['employee'] = User::get();
        $data['user']  = auth()->user();
        return view('admin.emergency_contact.create',$data); 
    }


    public function update(Request $request): View
    {  
        $data['title'] = 'Emergency Contact';
        $data['sub_title'] = 'Update';  
        $data['employee'] = User::get();   
        $data['uinfo'] = EmergencyContact::with('employee')->find($request->id);
     
        return view('admin.emergency_contact.update',$data); 
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

                $admin = EmergencyContact::find($request->id);
               
                    $admin->update([
                        'employee_id' => $request->employee,    
                        'qualification' => $request->qualification,
                        'percentage' => $request->percentage,
                        'passing_year' => $request->passing_year,
                    ]);     
               
                return response()->json([
                    'success'=> 1,
                    'message'=>"Employee Emergency Contact Updated successfully."
                ]);

            }else{ 
                request()->validate([
                    'employee' => 'required', 
                    'qualification' => 'required', 
                    'percentage' => 'required', 
                    'passing_year' => 'required|', 
                  
                ]);
    
                $emp = EmergencyContact::create([
                    'employee_id' => $request->employee,    
                    'qualification' => $request->qualification,
                    'percentage' => $request->percentage,
                    'passing_year' => $request->passing_year,
                ]);

                return response()->json([
                    'success'=> 1,
                    'message'=>"Employee Emergency Contact Insert Successfully."
                ]);
            }
        }

        public function destroy(Request $request)
        {
            $data = EmergencyContact::find($request->id); 
            $data->delete(); 

            return response()->json([
                'success'=> 1,
                'message'=>"Employeee Emergency Contact deleted successfully."
            ]);
         
          
        }

        public function export(Request $request) 
        {
            $departmentId = $request->departmentId; 
            if(!empty($request->departmentId) && isset($request->departmentId)){
            
                $contact = EmergencyContact::with(['user' => function ($query) use ($departmentId) {
                    $query->where('department_id', $departmentId);
                }])->whereHas('user', function ($query) use ($departmentId) {
                    $query->where('department_id', $departmentId);
                })->get();
            } else {
                $contact = EmergencyContact::with('user:id,name,department_id')->get();
            }
        //  echo "<pre>"; print_r($data->toArray()); die;
            return Excel::download(new EmergencyContactsExport($contact), 'emergency_contact.xlsx');
        }

}
