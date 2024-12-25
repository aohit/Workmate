<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Holiday; 
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Hash; 
use DataTables;

class HolidayController extends Controller
{
    /**
     * Display the login view.
     */
 

     public function index(): View
        { 
           
            $data['title'] = 'Public Holiday';
            $data['sub_title'] = 'Holiday List';
            $data['holidays'] = Holiday::get();
            return view('admin.holiday.index',$data);
        }

        public function list(Request $request)
        { 
            if ($request->ajax()) {
    
                
                    $data = Holiday::get(); 
              
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('title', function($row){
                            $title =  $row->title;
                            return $title;
                        })
                        ->addColumn('date', function($row){
                            $date =  $row->date;
                            return $date;
                        })
                        ->addColumn('color', function($row){
                            $color = '<span class="" style="display: block; border: 1px solid; border-radius: 50%; width: 25px; height: 25px; background-color: ' . $row->color . ';"></span>';
                            return $color;
                        }) 
                        
                        ->addColumn('status', function($row){ 
                            if($row->status == 1){
                                $status =  '<button type="button"  class="btn-sm btn btn-success  waves-effect waves-light">Active</button>';
                            }else{
                                $status =  '<button type="button" class="btn-sm btn btn-outline-danger waves-effect waves-light">Inactive</button>';
                            }
                             
                            return $status;
                        
                        })

                        ->addColumn('action', function($row){ 

                            $statusUrl = route('admin.holiday.status'); 
                           if($row->status == 0){
                               $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",1) class="btn-sm btn btn-outline-success waves-effect waves-light ms-1">Active</button>';
                           }else{
                               $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",0) class="btn-sm btn btn-outline-danger  waves-effect waves-light ms-1">Inactive</button>';
                           }
                            
                           // return $status;

                           $editUrl = route('admin.holiday.update');
                           $deleteUrl = route('admin.holiday.delete');
                           
                        //    $action = '<div class="flexblockclass gap-1">';
                           
                           $action = '<button type="button" onclick="editForm(this, \'' . $row->id . '\', \'' . $editUrl . '\')" class="btn-sm btn btn-outline-dark waves-effect waves-light mx-1">Edit</button>';
                       // $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="d-none btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
                           $action .= '<button type="button" onclick="deleteRow(this, \'' . $row->id . '\', \'' . $deleteUrl . '\')" class="btn-sm btn btn-outline-danger waves-effect waves-light mb-0">Delete</button>';
                           $action .= '</div>';
                           return $action.''.$status;
                       })
                        ->rawColumns(['title','date','color','status','action'])
                        ->make(true);
            }
        }
 
        // public function list(Request $request)
        // { 
        //     if ($request->ajax()) {
    
                
        //             $data = Holiday::get(); 
              
        //         return DataTables::of($data)
        //                 ->addIndexColumn()
        //                 ->addColumn('title', function($row){
        //                     $title =  $row->title;
        //                     return $title;
        //                 })
        //                 ->addColumn('date', function($row){
        //                     $date =  $row->date;
        //                     return $date;
        //                 })
        //                 ->addColumn('color', function($row){
        //                     $color = '<span class="" style="display: block; border: 1px solid; border-radius: 50%; width: 25px; height: 25px; background-color: ' . $row->color . ';"></span>';
        //                     return $color;
        //                 }) 
                        
        //                 ->addColumn('status', function($row){ 
 
        //                     $statusUrl = route('admin.holiday.status'); 
        //                     if($row->status == 0){
        //                         $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",1) class="btn-sm btn btn-soft-success rounded-pill waves-effect waves-light">Active</button>';
        //                     }else{
        //                         $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",0) class="btn-sm btn btn-soft-success rounded-pill waves-effect waves-light">In-Active</button>';
        //                     }
                             
        //                     return $status;
        //                 })

        //                 ->addColumn('action', function($row){ 

        //                     $editUrl = route('admin.holiday.update');
        //                     $action =  '<button type="button" onclick = editForm(this,"'.$row->id.'","'. $editUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;';

        //                     $deleteUrl = route('admin.holiday.delete');
        //                     // $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="d-none btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
        //                        $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
        //                     return $action;
        //                 })
                       
        //                 ->rawColumns(['title','date','color','status','action'])
        //                 ->make(true);
        //     }
        // }

        public function create(): View
        {  
            $data['title'] = 'Holiday';
            $data['sub_title'] = 'Create'; 
            // $data['countries'] = Country::get(); 
            return view('admin.holiday.create',$data); 
        }

        public function update(Request $request): View
        {  
            $data['title'] = 'Holiday';
            $data['sub_title'] = 'Update';  
            $data['uinfo'] = Holiday::find($request->id);
            // $data['countries'] = Country::get();   
            return view('admin.holiday.update',$data); 
        }

        public function store(Request $request)
        {
           
            if($request->id){
              
                request()->validate([
                    'title' => 'required', 
                    'date' => 'required', 
                    // 'country' => 'required', 
                    ]);
                    $data = Holiday::find($request->id); 
                        $data->update([
                            'title' => $request->title,    
                            'date' => $request->date,    
                            'status' => $request->status,
                            'session_id' => session('sessionId'),
                            // 'country' => $request->country,  
                        ]);
                    
               

                return response()->json([
                    'success'=> 1,
                    'message'=>"Holiday Updated successfully."
                ]);
               
            }else{
                request()->validate([
                    'title' => 'required',
                    'date' => 'required',
                    // 'country' => 'required',    
                ]);

                $lastentry = Holiday::get()->last();

                if($lastentry){
                    $data = Holiday::create([
                        'title' => $request->title,    
                        'date' => $request->date,    
                        'status' => $request->status, 
                        // 'country' => $request->country,  
                        'color' => $lastentry->color,
                        'session_id' => session('sessionId'),
                    ]);
                }else{
                    $data = Holiday::create([
                        'title' => $request->title,    
                        'date' => $request->date,    
                        'status' => $request->status, 
                        'session_id' => session('sessionId'),
                        // 'country' => $request->country,  
                    ]);
                }
                return response()->json([
                    'success'=> 1,
                    'message'=>"Holiday created successfully."
                ]);
            }
           
        }


        public function destroy(Request $request)
        {
           
            $data = Holiday::find($request->id); 
            $data->delete(); 
            // $LeaveRequest->delete();

            return response()->json([
                'success'=> 1,
                'message'=>"Holiday deleted successfully."
            ]);
         
          
        }

        public function status(Request $request)
        {
           
            $data = Holiday::find($request->id); 
            $data->status = $request->status;
            $data->save(); 
            return response()->json([
                'success'=> 1,
                'message'=>"Holiday status changed successfully."
            ]);
         
          
        }
        public function addColors(Request $request)
        {
             $data['title'] = 'Add Color';
            $data['sub_title'] = 'Add Color'; 
            $data['employee'] = Holiday::get();
            $data['user']  = auth()->user();
            // echo "<pre>";print_r($data);die;
            return view('admin.holiday.addcolor',$data); 
        }

        public function colorsUpdate(Request $request){

        
            $request->validate([
                'color_theme_one' => 'required', 
            ]);
            
            // echo "<pre>";print_r($request->all());die;
                Holiday::query()->update([
                    'color' => $request->color,    
                ]);
    
                return response()->json([
                    'success' => 1,
                    'message' => "Public holidays color Add successfully."
                ]);
        }


        

 
}