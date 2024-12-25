<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Document; 
use App\Models\DocumentCategory; 
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Hash; 
use DataTables;

class DocumentController extends Controller
{
    /**
     * Display the login view.
     */
 

     public function index(): View
        { 
           
            $data['title'] = 'Document';
            $data['sub_title'] = 'Document List';
            $data['Document'] = Document::get();
            return view('admin.document.index',$data);
        }
 
        public function list(Request $request)
        { 
            if ($request->ajax()) {
    
                
                    $data = Document::get(); 
              
                return DataTables::of($data)
                        ->addIndexColumn()
                        
                        ->addColumn('status', function($row){ 
 
                            $statusUrl = route('admin.document.status'); 
                            if($row->status == 0){
                                $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",1) class="btn-sm btn btn-soft-success rounded-pill waves-effect waves-light">Active</button>';
                            }else{
                                $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",0) class="btn-sm btn btn-soft-success rounded-pill waves-effect waves-light">In-Active</button>';
                            }
                             
                            return $status;
                        })

                        ->addColumn('action', function($row){ 

                            $editUrl = route('admin.document.update');
                            $action =  '<button type="button" onclick = editForm(this,"'.$row->id.'","'. $editUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;';

                            $deleteUrl = route('admin.document.delete');
                            $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="d-none btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
                            // return $action;
                            $file_path = asset('/upload/documents_attached') .'/'. $row->file;
                            $action .=  '<a href="'. $file_path .'" download="" class="btn"><i class="fa fa-download" aria-hidden="true"></i></a>';
                            
                            return $action;
                        })
                       
                        ->rawColumns(['date','status','action'])
                        ->make(true);
            }
        }

        public function create(): View
        {  
            $data['title'] = 'Document';
            $data['sub_title'] = 'Create';  
            $data['document_category'] = DocumentCategory::get();  
            return view('admin.document.create',$data); 
        }

        public function update(Request $request): View
        {  
            $data['title'] = 'Holiday';
            $data['sub_title'] = 'Update';  
            $data['uinfo'] = Document::find($request->id);   
            $data['document_category'] = DocumentCategory::get();  
            return view('admin.document.update',$data); 
        }

        public function store(Request $request)
        {
            // echo "<pre>";print_r($request->file);die;
           
            if($request->id){
              
                request()->validate([
                    'doc_name' => 'required', 
                    'file' => 'required', 
                    'documentCategory' => 'required', 
                    ]);
                    $data = Document::find($request->id); 
                        $data->update([
                            'doc_name' => $request->doc_name,      
                            'file' => $request->file,      
                            'category_id' => $request->documentCategory,      
                            'status' => $request->status, 
                        ]);
                    
               

                return response()->json([
                    'success'=> 1,
                    'message'=>"Document Updated successfully."
                ]);
               
            }else{
                request()->validate([
                    'doc_name' => 'required', 
                    'file' => 'required', 
                    'documentCategory' => 'required', 
                ]);
    
                $data = Document::create([
                    'doc_name' => $request->doc_name,      
                    'file' => $request->file,      
                    'category_id' => $request->documentCategory,      
                    'status' => $request->status, 
                ]);
    
                return response()->json([
                    'success'=> 1,
                    'message'=>"Document created successfully."
                ]);
            }
           
        }


        public function destroy(Request $request)
        {
           
            $data = Document::find($request->id); 
            $data->delete(); 

            return response()->json([
                'success'=> 1,
                'message'=>"Document deleted successfully."
            ]);
         
          
        }

        public function status(Request $request)
        {
           
            $data = Document::find($request->id); 
            $data->status = $request->status;
            $data->save(); 
            return response()->json([
                'success'=> 1,
                'message'=>"Document status changed successfully."
            ]);
         
          
        }

        
    public function upload(Request $request)
    {
        $type = $request->type;

        $path = $type . '_path';
        $name = $type . '_name';
        $file_path = $request->$path;
        $file_name = $request->$name;
        

        $ext_arr = array('pdf','xls','xlsx','csv','jpg','png','jpeg',);
       
        
        if (!empty($request->file($file_name)))
        {
            //Move Uploaded File
            $file = $request->file($file_name);
            // echo"<pre>";print_r($file);die;
            $ext = $file->getClientOriginalExtension();

            //  echo"<pre>";print_r($ext);die;
            if (in_array($ext, $ext_arr))
            {// echo"a";die;
                $destinationPath = public_path() . '/' . $file_path;
                $file_name = time() . "_" . $file->getClientOriginalName();
                $file->move($destinationPath, $file_name);
                return response()->json(['status' => 1, 'file_id' => $file_name ]);
            }
            else
            {
                return response()->json(['status' => 0, 'msg' => 'File type not allowed']);
            }
        }
    }

        

 
}