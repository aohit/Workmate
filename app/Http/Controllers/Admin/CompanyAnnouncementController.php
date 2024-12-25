<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use App\Models\CompanyAnnouncement;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Hash; 
use DataTables;
use DateTime;


class CompanyAnnouncementController extends Controller
{

       /**
     * Display the login view.
     */

     public function index(): View
     { 
         $data['title'] = 'Company Announcement';
         $data['sub_title'] = 'Company Announcement';
         $data['Color'] = CompanyAnnouncement::get();
         return view('admin.announcement.index',$data);
     }


     public function list(Request $request)
     {
        if ($request->ajax()) {
            $data = CompanyAnnouncement::get(); 
            $no = 0; 
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('created_at', function($row) {
                    $createddate = $row->created_at; 
                    $start_time = date("d-m-Y", strtotime($createddate));

                    // $createddate = $row->created_up;
                    // $echo 
                    // $no++; 
                    return $start_time;
                }) 
                ->addColumn('title', function($row) {
                    return $row->title;
                }) 
                ->addColumn('description', function($row) {
                    return $row->description;
                }) 
                // ->addColumn('employee', function($row){
                //     $user = User::where('id',$row->employee_id)->select('name')->first();
                //     return $user->name;
                // }) 
                ->addColumn('background_color_id', function($row){
                    $color_code = '<span class="" style="display: block; border: 1px solid; border-radius: 50%; width: 25px; height: 25px; background-color: ' . $row->background_color_id . ';"></span>';
                    return $color_code;
                }) 
                ->addColumn('text_color_id', function($row){
                    $back_color = '<span class="" style="display: block; border: 1px solid; border-radius: 50%; width: 25px; height: 25px; background-color: ' . $row->text_color_id . ';"></span>';
                    return $back_color;
                }) 

                ->addColumn('show_description', function($row){
                    $showUrl = route('admin.announcement-show');
                    $actions =  '<button type="button" onclick = showForm(this,"'.$row->id.'","'. $showUrl .'") class="btn-sm btn btn-outline-info waves-effect waves-light mr-1">Show</button>&nbsp;&nbsp;&nbsp;';
                    return $actions;
                }) 

                ->addColumn('status', function($row){
                    $statusUrl = route('admin.announcement-status'); 
                    if($row->status == 0){
                        $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",1) class="btn-sm btn btn-outline-danger  waves-effect waves-light">Inactive</button>';
                    }else{
                        $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",0) class="btn-sm btn btn-success waves-effect waves-light">Active</button>';
                    }
                    return $status;
                }) 
               
               
                ->addColumn('action', function($row) { 
                    $editUrl = route('admin.announcement-update');
                    $deleteUrl = route('admin.announcement-delete');
                    
                    $action = '<div class="flexblockclass gap-1">';
                    $action .= '<button type="button" onclick="editForm(this,'.$row->id.',\''.$editUrl.'\')" class="btn-sm btn btn-outline-dark waves-effect waves-light me-1">Edit</button>';
                    $action .= '<button type="button" onclick="deleteRow(this,'.$row->id.',\''.$deleteUrl.'\')" class="btn-sm btn btn-outline-danger waves-effect waves-light mb-0">Delete</button>';
                    $action .= '</div>';
                    
                    return $action;
                })
                ->rawColumns(['sr.no','created_at','title','description', 'background_color_id', 'text_color_id', 'status','show_description','action'])
                ->make(true);
        }
     }

     public function create(): View
     {  
         $data['title'] = 'Employee';
         $data['sub_title'] = 'Create'; 
         $data['employee'] = User::get();   
         $data['backgrountcolor'] = Color::get();   
         $data['textcolors'] = Color::get();   

        //  echo "<pre>";print_r($data['backgrountcolor']);die;
         $data['employee'] = User::get();   
         return view('admin.announcement.create',$data); 
     }


     public function update(Request $request): View
     {  
         $data['title'] = 'Education';
         $data['sub_title'] = 'Update';  
         $data['uinfo'] = CompanyAnnouncement::find($request->id); 
        // echo "<pre>";print_r($data);die;
         $data['employee'] = User::get();   
         $data['backgrountcolor'] = Color::get();   
         $data['textcolors'] = Color::get();  
         return view('admin.announcement.update',$data); 
     }

     public function store(Request $request)
     {      
             if($request->id){ 
               $id = $request->id;
                 request()->validate([
                   //  'title' => 'required', 
                     'description' => 'required',  
                     //'employee_id' => 'required', 
                    // 'status' => 'required', 
                     'background_color' => 'required', 
                     'text_color' => 'required', 
                     ]);
 
                 $admin = CompanyAnnouncement::find($request->id);
                
                     $admin->update([
                       'title' => $request->title,    
                         'description' => $request->description,
                        // 'employee_id' => $request->employee_id,
                        // 'status' => $request->status,
                         'background_color_id' => $request->background_color,
                         'text_color_id' => $request->text_color,
                         'session_id' => session('sessionId'),
                     ]);     
                
                 return response()->json([
                     'success'=> 1,
                     'message'=>"Company Announcement Updated successfully."
                 ]);
 
             }else{ 
                 request()->validate([
                    'title' => 'required', 
                    'description' => 'required',  
                  // 'employee_id' => 'required', 
                    //'status' => 'required', 
                    'background_color' => 'required', 
                    'text_color' => 'required', 
                   
                 ]);
     
                 $emp = CompanyAnnouncement::create([
                    'title' => $request->title,    
                    'description' => $request->description,
                    //'employee_id' => $request->employee_id,
                    //'status' => $request->status,
                    'background_color_id' => $request->background_color,
                    'text_color_id' => $request->text_color,
                    'session_id' => session('sessionId'),
                 ]);
 
                 return response()->json([
                     'success'=> 1,
                     'message'=>"Company Announcement Insert Successfully."
                 ]);
             }
         }

         public function destroy(Request $request)
         {
            
             $data = CompanyAnnouncement::find($request->id); 
             $data->delete();
         
             return response()->json([
                 'success'=> 1,
                 'message'=>"Company Announcement deleted successfully."
             ]);
        
         }

         public function show(Request $request): View
         {  
             $data['title'] = 'Company Announcement';
             $data['sub_title'] = 'View';  
             $data['uinfo'] = CompanyAnnouncement::find($request->id); 
            //  $data['employee'] = User::with('department','reportingTo')->find($request->id);    
            //  $data['reportees'] = Reportee::where('employee_id',$request->id)->with('employee')->get();    
             // echo '<pre>';print_r($data['employee']->reportingTo);die;
             return view('admin.announcement.show',$data); 
         }

         public function status(Request $request)
         {
            
             $data = CompanyAnnouncement::find($request->id); 
             $data->status = $request->status;
             $data->save(); 
             return response()->json([
                 'success'=> 1,
                 'message'=>"Status changed successfully."
             ]);
          
           
         }


}