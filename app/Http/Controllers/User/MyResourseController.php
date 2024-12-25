<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use App\Models\PdfUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class MyResourseController extends Controller
{
    public function index(): View
        { 
           
            $data['title'] = 'My Resources';
            $data['sub_title'] = 'Resources List';
            $data['Resources'] = PdfUpload::get();
            return view('user.myresources.index',$data);
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

                if(auth('web')->user()->hasPermissionTo('add-delete-my-resources')){
                    $data = PdfUpload::get();
                }else{
                    $UserData = Auth::guard('web')->user();
                    $data = PdfUpload::whereRaw('FIND_IN_SET(?, department_id)', [$UserData->department_id])->get();
                }
                
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
                            $date = date('d-M-Y');
                            return $date;
                        }) 
                       ->addColumn('action', function($row){ 
                        $file_path =  $row->file_path;
                            $deleteUrl = route('resources.delete');
                            $file_path = asset($row->file_path);
                               $action =  '<a href="'. $file_path .'" download="" class="btn-sm btn btn-outline-primary waves-effect waves-ligth me-1">Download</a>';
                            // $action =  '<a href="'. $file_path .'" download="" class="btn fs-3 me-1"><i class="fa fa-download text-primary " aria-hidden="true"></i></a>';
                            if(auth('web')->user()->hasPermissionTo('add-delete-my-resources')){
                                // $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="btn fs-3 me-1"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                            $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
                            }
                            
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
            return view('user.myresources.create',$data); 
        }

        public function store(Request $request)
        {
            
                request()->validate([
                    'file_name' => 'required', 
                    'file_path' => 'required|mimes:pdf,xlsx,docx',
                    'category' => 'required', 
                ]);

                if ($request->hasFile('file_path')) {
                    $file = $request->file('file_path');
                    $fileName = time().'.'.$file->getClientOriginalExtension();
                    $file_path = 'uploads/'.$fileName;
                    $file->move(public_path('uploads'), $fileName);
        
                    $data = PdfUpload::create([
                        'file_name' => $request->file_name,      
                        'file_path' => $file_path,      
                        'category' => $request->category,
                        'user_id' => Auth::guard('web')->user()->id,
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
