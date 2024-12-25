<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Disciplinary;
use App\Models\DisciplinaryActionType;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use App\Models\PdfUpload;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class DisciplinaryController extends Controller
{
    // public function index(): View
    // { 
       
    //     $data['title'] = 'Disciplinary Action';
    //     $data['sub_title'] = 'Disciplinary List';
    //     $data['Disciplinary'] = Disciplinary::get();
    //     return view('user.myperformance.index',$data);
    // }

    
    public function disciplinaryAction(Request $request)
    { 
        $data['title'] = 'Disciplinary Action'; 
        $data['sub_title'] = 'Disciplinary List';
        $data['Disciplinary'] = Disciplinary::get();
        return view('user.myperformance.tab.action', $data); 
    }

    public function list(Request $request)
    { 
       
        if ($request->ajax()) {
          
            $data = Disciplinary::get(); 
            $no=1;
            return DataTables::of($data)
            ->addIndexColumn()
            // ->addColumn('sr.no', function($row) use($no){
            //  $no++;
            //     return $no;
            // }) 
            ->addColumn('title', function($row){
                $title =  $row->title;
                // $icon =  '<img src="'.asset('assets/icon').'/pdf_icon.png" width="20px"/>';
                return   $title;
              
            }) 
             ->addColumn('pdf', function($row){
              $icon =  '<img src="'.asset('upload/certificate').'/pdf.png" width="20px"/>';
              return  $icon;
             }) 
                    
                   ->addColumn('action', function($row){ 
                    $file_path = asset('/uploads') .'/'. $row->file;
                    // $action =  '<a href="'. $file_path .'" download="" class="btn"><i class="fa fa-download" aria-hidden="true"></i></a>';
                    $action =  '<a href="'. $file_path .'" download="" class="btn-sm btn btn-outline-primary waves-effect waves-ligth me-1">Download</a>';
                    
                    $deleteUrl = route('disciplinary.delete');
                    if (auth('web')->user()->hasPermissionTo('create-disciplinary')){
                        // $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="btn fs-3 me-1"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                    $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
                        
                    }
    
                        return $action;
                    })
                   
                    ->rawColumns(['sr.no','title','pdf','action'])
                    ->make(true);
        }
    }

    public function create(): View
    {  
        $data['title'] = 'Disciplinary';
        $data['sub_title'] = 'Disciplinary  Create';  
        $data['document_category'] = Disciplinary::get(); 
        return view('user.myperformance.disciplinary.create',$data); 
    }

    public function store(Request $request)
    {
        
            request()->validate([
                'title' => 'required', 
                'file_path' => 'required|mimes:pdf,xlsx,docx',
            ]);

            if ($request->hasFile('file_path')) {
                $file = $request->file('file_path');
                $fileName = time().'.'.$file->getClientOriginalExtension();
                $file_path = 'uploads/'.$fileName;
                $file->move(public_path('uploads'), $fileName);
    
                $data = Disciplinary::create([
                    'title' => $request->title,      
                    'file' => $fileName,      

                ]);
            }

            return response()->json([
                'success'=> 1,
                'message'=>"Disciplinary created successfully."
            ]);
    }

    public function destroy(Request $request)
    {
        $data = Disciplinary::find($request->id)->delete(); 

        return response()->json([
            'success'=> 1,
            'message'=>"Disciplinary deleted successfully."
        ]);
     
      
    }


    public function index(): View
    { 
        $data['title'] = ' My Team Disciplinary';
        $data['sub_title'] = 'Disciplinary List';
        $data['Disciplinary'] = Disciplinary::get();
        $data['departments'] = Department::where('status',1)->get();
        return view('user.disciplinary.index',$data);
    }


    public function teamList(Request $request)
    { 
    
        if ($request->ajax()) {

            $userid = Auth::guard('web')->user()->id;
            if (auth('web')->user()->hasPermissionTo('manager-disciplinary')){
                // $data = Disciplinary::with('actionType', 'user')
                //     ->where('id', $userid)
                //     ->get();
                $data = Disciplinary::with(['actionType', 'user' => function($query) use ($userid) {
                    $query->where('manager_id', $userid); 
                }])->get();
            }
            if(auth('web')->user()->hasPermissionTo('hr-disciplinary')){
                $data = Disciplinary::with('actionType', 'user')->get();
            }
            $no=1;
            return DataTables::of($data)
            ->addIndexColumn()
        
            ->addColumn('title', function($row){
                $title =  $row->title;
                return   $title;
              
            })
            ->addColumn('employee_id', function($row){
                $title =  $row->user?->name;
                return   ucwords($title);
              
            })
            ->addIndexColumn()
            ->addColumn('issue_date', function($row){
                $title =  $row->issue_date;
                return   $title;
            }) 
            ->addIndexColumn()
            ->addColumn('action_type_id', function($row){

                $action_type_id =  $row->actionType?->action_type;
               
                return   $action_type_id;
              
            }) 
             ->addColumn('pdf', function($row){
              $icon =  '<img src="'.asset('upload/certificate').'/pdf.png" width="20px"/>';
              return  $icon;
             }) 
                    
                   ->addColumn('action', function($row){ 
                    $file_path = asset('/uploads') .'/'. $row->file;
                    // $action =  '<a href="'. $file_path .'" download="" class="btn"><i class="fa fa-download" aria-hidden="true"></i></a>';
                    $action =  '<a type="button" href="'. $file_path .'" download="" class="btn-sm btn btn-outline-primary waves-effect waves-light me-1">Download</a>';
                    $deleteUrl = route('disciplinary.teamdelete');
                  
                        // $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="btn fs-3 me-1"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                         $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
                        return $action;
                    })
                   
                    ->rawColumns(['sr.no','title','issue_date','action_type_id','pdf','employee_id','action'])
                    ->make(true);
        }
    }

    public function storeTeamDisciplinary(Request $request)
    {
        // echo "<pre>";print_r($request->toArray());die;
            request()->validate([
                'title' => 'required', 
                'issue_date' => 'required', 
                'department_id' => 'required', 
                'actiontype_id' => 'required', 
                'employee' => 'required', 
                'file_path' => 'required|mimes:pdf,xlsx,docx',
            ]);

            if ($request->hasFile('file_path')) {
                $file = $request->file('file_path');
                $fileName = time().'.'.$file->getClientOriginalExtension();
                $file_path = 'uploads/'.$fileName;
                $file->move(public_path('uploads'), $fileName);
    
                $data = Disciplinary::create([
                    'file' => $fileName,      
                    'title' => $request->title,      
                    'issue_date' => $request->issue_date,      
                    'department_id' => $request->department_id,      
                    'action_type_id' => $request->actiontype_id,      
                    'employee_id' => $request->employee, 
                    'session_id' => session('sessionId'),     

                ]);
            }

            return response()->json([
                'success'=> 1,
                'message'=>"Disciplinary created successfully."
            ]);
    }

    public function createTeamDisciplinary(): View
    {  
        $userid = Auth::guard('web')->user()->id;
        $data['title'] = 'Disciplinary';
        $data['sub_title'] = 'Assign Disciplinary Action';  
        $data['document_category'] = Disciplinary::get(); 
        $data['disciplinaryactions'] = DisciplinaryActionType::where('status',1)->get(); 
        $data['departments'] = Department::where('status',1)->get(); 
        return view('user.disciplinary.create',$data); 
    }

    public function destroyteam(Request $request)
    {
        $data = Disciplinary::find($request->id)->delete(); 

        return response()->json([
            'success'=> 1,
            'message'=>"Disciplinary deleted successfully."
        ]);
     
      
    }

    public function disGetStateData(Request $request)
    { 
        $id = Auth::guard('web')->user()->id;

        if (auth('web')->user()->hasPermissionTo('manager-disciplinary')){
            $cities = User::where('department_id',$request->id)->where('manager_id',$id)->get();
        }
        if(auth('web')->user()->hasPermissionTo('hr-disciplinary')){
            $cities = User::where('department_id',$request->id)->get();
        }
        // $cities = User::where('department_id',$request->id)->where('manager_id',$id)->get();
       
        $options =  "<option value=''>Select Employee ... </option>";
        foreach($cities as $city)
        {
            $options .="<option value='{$city->id}'>{$city->name}</option>";
        }
        return response()->json(['cities'=> $options]);
    }


}
