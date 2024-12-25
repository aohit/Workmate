<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Disciplinary;
use App\Models\Department;
use App\Models\DocumentCategory;
use App\Models\DisciplinaryActionType;
use Illuminate\Http\Request;
use App\Models\PdfUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DisciplinaryExport;
use App\Models\User;


class DisciplinaryController extends Controller
{
    public function index(): View
    { 
       
        $data['title'] = 'Disciplinary Actions';
        $data['sub_title'] = 'Disciplinary List';
        $data['Disciplinary'] = Disciplinary::get();
        $data['departments'] = Department::where('status',1)->get();
        return view('admin.disciplinary.index',$data);
    }

    public function list(Request $request)
    { 
       
        if ($request->ajax()) {

            // if(!empty($request->departmentId) && isset($request->departmentId)){
            //     $departmentId = $request->departmentId; 
            //     $data = Disciplinary::with('actionType')->where('department_id',$departmentId)->get(); 
            // } else {
            //     $data = Disciplinary::with('actionType')->get(); 
            // }
          
            
            if(!empty($request->departmentId) && isset($request->departmentId)){
                $departmentId = $request->departmentId; 
                $data = Disciplinary::with('actionType','user')->where('department_id',$departmentId)->get(); 
            } else {
                $data = Disciplinary::with('actionType','user')->get(); 
            }
          
            $no=1;
            return DataTables::of($data)
            ->addIndexColumn()
        
            ->addColumn('title', function($row){
                $title =  $row->title;
                return   $title;
              
            })
            ->addColumn('employee_id', function($row){
                $employee_id =  ucwords($row->user?->name);
                return   $employee_id;
              
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
                $file_path = asset('/uploads') . '/' . $row->file;
                                    // $action =  '<a href="'. $file_path .'" download="" class="btn"><i class="fa fa-download" aria-hidden="true"></i></a>';
                $action = '<div class="flexblockclass gap-1">';
                $action .= '<a type="button" href="' . $file_path . '" download class="btn-sm btn btn-outline-primary waves-effect waves-light me-1">Download</a>';
                
                $deleteUrl = route('admin.disciplinary.delete');
                  // $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="btn fs-3 me-1"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                $action .= '<button type="button" onclick="deleteRow(this, \'' . $row->id . '\', \'' . $deleteUrl . '\')" class="btn-sm btn btn-outline-danger waves-effect waves-light me-1">Delete</button>';
                
                $action .= '</div>';
            
                return $action;
            })
                   
                    ->rawColumns(['sr.no','title','issue_date','action_type_id','pdf','employee_id','action'])
                    ->make(true);
        }
    }

    public function create(): View
    {  
        $data['title'] = 'Disciplinary';
        $data['sub_title'] = 'Assign Disciplinary Action';  
        $data['employee'] = User::get();
        $data['document_category'] = Disciplinary::get(); 
        $data['disciplinaryactions'] = DisciplinaryActionType::get(); 
        $data['departments'] = Department::where('status',1)->get(); 
        return view('admin.disciplinary.create',$data); 
    }

    public function store(Request $request)
    {
        
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

    public function destroy(Request $request)
    {
        $data = Disciplinary::find($request->id)->delete(); 

        return response()->json([
            'success'=> 1,
            'message'=>"Disciplinary deleted successfully."
        ]);
     
      
    }

    public function export(Request $request) 
    {
        $departmentId = $request->departmentId; 
        if(!empty($request->departmentId) && isset($request->departmentId)){
        
            $disciplinary = Disciplinary::with('actionType','departments')->where('department_id',$departmentId)->get(); 
        } else {
            $disciplinary = Disciplinary::with('actionType','departments')->get();
        }
        return Excel::download(new DisciplinaryExport($disciplinary), 'disciplinary.xlsx');
    }


}
