<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\{User,Skill,Certificate, Department,UploadFile}; 
use Illuminate\Support\Facades\Hash; 
use DataTables;
use DB;
use Illuminate\Support\Facades\Validator;

class CertificateController extends Controller
{

    protected $route;

    protected $single_heading;

    public function __construct()
    {
          $this->route = new \stdClass;
          $this->single_heading = "certificate";
          $this->route->list = route('certificate.list');
          $this->route->store = route('certificate.store');
          $this->route->saveimage = route('saveimage');
       
    }
    public function index(): View
    { 
        $data['title'] = 'Team Certificate';
        $data['sub_title'] = 'Certificate List';
        $data['employees'] = Certificate::get();
        $data['departments'] = Department::where('status',1)->get();
        //  echo "<pre>";print_r($data);die;
        return view('user.certificate.index',$data);
    }


    public function list(Request $request)
    {  
        $user  = auth()->user();
        //echo "<pre>";print_r($user->department_id);die;
        $departmentId = $user->department_id;
      
        if ($request->ajax()) {
     
    //    $data = Certificate::get(); 

    //    $departmentId = $request->departmentId; 
    //    if(!empty($request->departmentId) && isset($request->departmentId)){
       
        //    $data = Certificate::with(['employee' => function ($query) use ($departmentId) {
        //        $query->where('department_id', $departmentId);
        //    }])->whereHas('employee', function ($query) use ($departmentId) {
        //        $query->where('department_id', $departmentId);
        //    })->get();
    //    } else {
        //    $data = Certificate::with('employee:id,name,department_id')->where('de')->get();
        $data = Certificate::with('employee:id,name,department_id')->get();
    //    }
    //   echo "<pre>";print_r($data->toArray());die;
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user_id', function($row){
                    $user = User::where('id',$row->user_id)->select('name')->first();
                    // echo "<pre>";print_r($user->name);die;
                    return ucwords($user->name);
                }) 
                ->addIndexColumn()
                ->addColumn('file', function($row){

                        // echo "<pre>";print_r($row->file);die;  
                    $file =  $row->id;

                    $path = asset('upload/certificate/pdf.png');
                    $filepath =  "<img src='$path' / style='height:30px;width:30px;'>";
                    return $filepath;
                })
                ->addColumn('action', function($row){ 
                                  
                    $file_path = asset('/upload/certificate') .'/'. $row->file;
                    $action =  '<a href="'. $file_path .'" download="" class="btn-sm btn btn-outline-primary waves-effect waves-ligth me-1">Download</a>';

                    // $editUrl = route('admin.certificate.update');
                    // $action =  '<button type="button" onclick = editForm(this,"'.$row->id.'","'. $editUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;';

                    //  $deleteUrl = route('admin.certificate.delete');
                    // $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';

                    // echo "<pre>";print_r($action);die;
                    return $action;
                })
               
                ->rawColumns(['user_id','file','action'])
                ->make(true);
    }
    }


    
    public function store(Request $request)
    {
        if($request->id){
            $id = $request->id;
            request()->validate([
                'employee'=>'required',
                
                ]);
            if($request->file('certificate_image')){
                $file_path = 'upload/certificate/';
                $files = $request->file('certificate_image');
                $admin = Certificate::find($request->id);
                 $ext = $files->getClientOriginalExtension();
                $destinationPath = $file_path;
                $file_name = time().".".$files->getClientOriginalExtension();
                $files->move($destinationPath,$file_name);
                 $file =  $file_name;
            }else{
                $admin = Certificate::find($request->id);
                $file = $request->file;
               
            }

            if ($file) {
                $admin->update([
                    'user_id'=>$request->employee,
                    'file'=>$file,
                 ]);   
            }else{
                $admin->update([
                    'user_id'=>$request->employee,
                 ]);   
            }              
               
                return response()->json([
                    'success'=> 1,
                    'message'=>"Employee Certificate Insert Successfully."
                ]);

            }
            else{
            $validator = Validator::make(
                $request->all(),
                [
                    'employee'=>'required',
                    'certificate_image'=>'required|mimes:pdf',
                ]
            );
                if($validator->fails()){
                     return response()->json(['status' => 0,'errors' =>  $validator->errors()]);
                }else{
                    $type = $request->type;
                    $file_path = 'upload/certificate/';
                    $file = $request->file('certificate_image');

                    if (!empty($file)) {
                        $ext = $file->getClientOriginalExtension();
                
                        $destinationPath = $file_path;
                        $file_name = time().".".$file->getClientOriginalExtension();
                        $file->move($destinationPath,$file_name);
                         $movedFile =  $file_name;
                         
                         $info = Certificate::create([
                            'user_id'=>$request->employee,
                            'file'=>$movedFile,
                        ]);
                        return response()->json([
                            'success'=> 1,
                            'message'=>"Employee Certificate Insert Successfully."
                        ]);
        
                }else{ 
        
                    return response()->json(['status' => 0, 'msg' => 'File type not allowed']);
                }

                    }
            }
    }

    public function create(Request $request)
    {
        $data['title'] = 'Certificate';
        $data['sub_title'] = 'Certificate'; 
        $data['employee'] = User::get();
        $data['user']  = auth()->user();
        return view('user.certificate.create',$data ,['route'=> $this->route ]); 
    }

    public function update(Request $request): View
    {  
        $data['title'] = 'Skills';
        $data['sub_title'] = 'Update';  
        $data['employee'] = User::get(); 
        $data['uinfo'] = Certificate::with('employee')->find($request->id); 
        // return view('admin.certificate.update',$data); 
        return view('user.certificate.update' ,$data,['route'=>$this->route]);
    }


    public function destroy(Request $request)
    {
       
        $data = Certificate::find($request->id); 
        $data->delete(); 

        return response()->json([
            'success'=> 1,
            'message'=>"Employeee Certificate image deleted successfully."
        ]);
    }
    public function myCertificateIndex(): View
    { 
        $data['title'] = 'Team Certificate';
        $data['sub_title'] = 'Certificate List';
        $data['employees'] = Certificate::get();
        $data['departments'] = Department::where('status',1)->get();
        //  echo "<pre>";print_r($data);die;
        return view('user.certificate.mycertificate',$data);
    }

    public function myCertificateList(Request $request)
    {  
        $user  = auth()->user();
      
        if ($request->ajax()) {
     
        // $data = Certificate::with('employee:id,name,department_id')->where('user_id',$user->id)->get();
        $data = Certificate::with('employee:id,name,department_id,job_title')->get();
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user_id', function($row){
                    $user = User::where('id',$row->user_id)->select('name')->first();
                    return ucwords($user->name);
                }) 
                ->addIndexColumn()
                ->addColumn('file', function($row){
                    $file =  $row->id;
                    $path = asset('upload/certificate/pdf.png');
                    $filepath =  "<img src='$path' / style='height:30px;width:30px;'>";
                    return $filepath;
                })
                ->addIndexColumn()
                ->addColumn('departmentname', function($row) {
                    if ($row->department_id) {
                        $departmentID = $row->department_id;
                        $departmentname = Department::where('id', $departmentID)->select('name')->first();
                        return  $departmentname->name;
                    }
                })
                ->addColumn('job_title', function($row){
                    $job_title = $row->employee?->job_title;
                    return $job_title;
                })
                ->addColumn('certificate_name', function($row){
                    $certificate_name = $row->certificate_name;
                    return $certificate_name;
                }) 
                ->addColumn('action', function($row){ 
                                  
                    $file_path = asset('/upload/certificate') .'/'. $row->file;
                    $action =  '<a href="'. $file_path .'" download="" class="btn-sm btn btn-outline-primary waves-effect waves-ligth me-1">Download</a>';

                    // $editUrl = route('admin.certificate.update');
                    // $action =  '<button type="button" onclick = editForm(this,"'.$row->id.'","'. $editUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;';
                       
                    $deleteUrl = route('teamcertificate.delete');
                    $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
                    //  $deleteUrl = route('admin.certificate.delete');
                    // $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';

                    return $action;
                })
               
                ->rawColumns(['user_id','file','action','certificate_name','job_title','departmentname'])
                ->make(true);
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

    public function createTeamCertificate(Request $request)
    {
        $data['title'] = 'Add Certificate';
        $data['sub_title'] = 'Add Certificate'; 
        $data['employee'] = User::get();
        $data['departments'] = Department::where('status',1)->get();
        $data['user']  = auth()->user();
        return view('user.certificate.addcertificate',$data ,['route'=> $this->route ]); 
    }

    public function storeTeamCertificates(Request $request)
    { 
        if($request->id){
            $id = $request->id;
            request()->validate([
                'employee'=>'required',
                'certificatename'=>'required',
                'department_id'=> 'required',
                ]);
            if($request->file('certificate_image')){
                $file_path = 'upload/certificate/';
                $files = $request->file('certificate_image');
                $admin = Certificate::find($request->id);
                 $ext = $files->getClientOriginalExtension();
                $destinationPath = $file_path;
                $file_name = time().".".$files->getClientOriginalExtension();
                $files->move($destinationPath,$file_name);
                 $file =  $file_name;
            }else{
                $admin = Certificate::find($request->id);
                $file = $request->file;
               
            }

            if ($file) {
                $admin->update([
                    'user_id'=>$request->employee,
                    'certificate_name'=>$request->certificatename,
                    'department_id'=>$request->department,
                    'file'=>$file,
                 ]);   
            }else{
                $admin->update([
                    'user_id'=>$request->employee,
                    'certificate_name'=>$request->certificatename,
                 ]);   
            }              
               
                return response()->json([
                    'success'=> 1,
                    'message'=>"Employee Certificate Insert Successfully."
                ]);

            }
            else{
            $validator = Validator::make(
                $request->all(),
                [
                    'employee'=>'required',
                    'certificatename'=>'required',
                    'department'=>'required',
                    'certificate_image'=>'required|mimes:pdf',
                ]
            );
                if($validator->fails()){
                     return response()->json(['status' => 0,'errors' =>  $validator->errors()]);
                }else{
                    $type = $request->type;
                    $file_path = 'upload/certificate/';
                    $file = $request->file('certificate_image');

                    if (!empty($file)) {
                        $ext = $file->getClientOriginalExtension();
                
                        $destinationPath = $file_path;
                        $file_name = time().".".$file->getClientOriginalExtension();
                        $file->move($destinationPath,$file_name);
                         $movedFile =  $file_name;
                         
                         $info = Certificate::create([
                            'user_id'=>$request->employee,
                            'certificate_name'=>$request->certificatename,
                            'department_id'=>$request->department,
                            'file'=>$movedFile,
                        ]);
                        return response()->json([
                            'success'=> 1,
                            'message'=>"Employee Certificate Insert Successfully."
                        ]);
        
                }else{ 
        
                    return response()->json(['status' => 0, 'msg' => 'File type not allowed']);
                }

                    }
            }
    }

    
    public function destroyTeam(Request $request)
    {
       
        $data = Certificate::find($request->id); 
        $data->delete(); 

        return response()->json([
            'success'=> 1,
            'message'=>"Employeee Certificate image deleted successfully."
        ]);
    }

    public function getStateData(Request $request)
    { 
        $id = Auth::guard('web')->user()->id;
        $cities = User::where('department_id',$request->id)->where('manager_id',$id)->get();
        // $cities = User::select('id','name','department_id')->where('department_id',$request->id)->get();
       
        $options =  "<option value=''>Select Employee ... </option>";
        foreach($cities as $city)
        {
            $options .="<option value='{$city->id}'>{$city->name}</option>";
        }
        return response()->json(['cities'=> $options]);
    }




}
