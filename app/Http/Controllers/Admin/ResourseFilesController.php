<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use App\Models\PdfUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ResourseFilesController extends Controller
{
    public function index(): View
        { 
           
            $data['title'] = 'My Resources';
            $data['sub_title'] = 'Resources List';
            $data['Resources'] = PdfUpload::get();
            return view('admin.resources.index',$data);
        }

        public function list(Request $request)
        { 
            $name = $_POST['filter']['name'] ?? '';
            $category = $_POST['filter']['category'] ?? '';
            if ($request->ajax()) {
                $data = [];
                if($category){
                    $data = ['category'=>$category];
                }
                if($name){
                    $data = ['file_name'=>$name];
                }
                $data = PdfUpload::where($data)->get(); 
                
                return DataTables::of($data)
                        ->addColumn('file_name', function($row){
                            $name =  $row->file_name;
                            $extension = pathinfo($row->file_path, PATHINFO_EXTENSION);
                            if($extension == 'pdf'){
                            $icon =  '<img src="'.asset('assets/icon').'/pdf_icon.png" width="20px"/>';
                            }elseif($extension == 'xlsx'){
                            $icon =  '<img src="'.asset('assets/icon').'/xls_icon.png" width="20px"/>';
                            }else{
                            $icon =  '';
                            }
                            return $icon.' '.$name;
                        }) 
                        ->addColumn('category', function($row){
                            $category =  $row->category;
                            return $category;
                        }) 
                        ->addColumn('date_uploaded', function($row){
                            $created_at =  $row->created_at;
                            $formatted_date = date('d-m-Y', strtotime($created_at)); 
                            return $formatted_date;
                        }) 

                        ->addColumn('action', function($row) { 
                            $file_path = asset($row->file_path);
                            $deleteUrl = route('admin.resources.delete');
                        
                            $action = '<div class="flexblockclass gap-1">';
                            // $action =  '<a href="'. $file_path .'" download="" class="btn fs-3 me-1"><i class="fa fa-download text-primary " aria-hidden="true"></i></a>';
                            // $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="btn fs-3 me-1"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                            $action .= '<a type="button" href="' . $file_path . '" download class="btn-sm btn btn-outline-primary waves-effect waves-light me-1">Download</a>';
                        
                            $action .= '<button type="button" onclick="deleteRow(this, \'' . $row->id . '\', \'' . $deleteUrl . '\')" class="btn-sm btn btn-outline-danger waves-effect waves-light mb-0">Delete</button>';
                            
                            $action .= '</div>';
                        
                            return $action;
                        })
                        ->rawColumns(['file_name','action'])
                        ->make(true);
            }
        }


        public function create(): View
        {  
            $data['title'] = 'My Resources';
            $data['sub_title'] = 'Resources Create';  
            $data['document_category'] = DocumentCategory::get(); 
            $data['departments'] = Department::where('status',1)->get();
            return view('admin.resources.create',$data); 
        }

        public function store(Request $request)
        {
            
                request()->validate([
                    'file_name' => 'required', 
                    'file_path' => 'required|mimes:pdf,xlsx,docx',
                    'category' => 'required', 
                    'department' => 'required', 
                ]);

                if ($request->hasFile('file_path')) {
                    $file = $request->file('file_path');
                    $fileName = $request->file_name.'.'.$file->getClientOriginalExtension();
                    $file_path = 'uploads/'.$fileName;
                    $file->move(public_path('uploads'), $fileName);
                    $departments = implode(',',$request->department);
                    $data = PdfUpload::create([
                        'file_name' => $request->file_name,      
                        'file_path' => $file_path,      
                        'category' => $request->category,
                        'department_id' =>$departments,
                        'user_id' => Auth::guard('admin')->user()->id,
                        'session_id' => session('sessionId'), 
                    ]);
                }
    
                return response()->json([
                    'success'=> 1,
                    'message'=>"Resources created successfully."
                ]);
        }

        public function destroy(Request $request)
        {
            $data = PdfUpload::find($request->id)->delete(); 

            return response()->json([
                'success'=> 1,
                'message'=>"Resources deleted successfully."
            ]);
         
          
        }
}
