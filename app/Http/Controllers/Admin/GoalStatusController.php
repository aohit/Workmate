<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GoalCategory;
use App\Models\GoalStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class GoalStatusController extends Controller
{
    public function index(): View
    {
        $data['title'] = 'Goal Status';
        $data['sub_title'] = 'Goal Status';
        $data['appraisal'] = GoalStatus::get();
        return view('admin.goal_status.index', $data);
    }

    public function list(Request $request)
    {

        if ($request->ajax()) {


            $data = GoalStatus::get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('title', function ($row) {
                    $title =  '<button type="button" class="btn-sm btn btn-soft-success rounded-pill waves-effect waves-light" style="background-color:'.$row->background_color.'; color:'.$row->label_color.'">'.$row->title.'</button>';
                    return $title;
                })

                ->addColumn('status', function ($row) {

                    $statusUrl = route('admin.goalstatus-status');
                    if ($row->status == 1) {
                        $status =  '<button type="button" onclick = changeStatus(this,"' . $row->id . '","' . $statusUrl . '",0) class="btn-sm btn btn-success  waves-effect waves-light">Active</button>';
                    } else {
                        $status =  '<button type="button" onclick = changeStatus(this,"' . $row->id . '","' . $statusUrl . '",1) class="btn-sm btn btn-outline-danger  waves-effect waves-light">Inactive</button>';
                    }

                    return $status;
                })

                ->addColumn('action', function ($row) {

                    $editUrl = route('admin.update-goal-status');
                    $deleteUrl = route('admin.delete-goal-status');
                
                    $action = '<div class="flexblockclass gap-1">';
                    $action .= '<button type="button" onclick="editForm(this, \'' . $row->id . '\', \'' . $editUrl . '\')" class="btn-sm btn btn-outline-dark waves-effect waves-light me-1">Edit</button>';
                    $action .= '<button type="button" onclick="deleteRow(this, \'' . $row->id . '\', \'' . $deleteUrl . '\')" class="btn-sm btn btn-outline-danger waves-effect waves-light mb-0">Delete</button>';
                    $action .= '</div>';
                
                    return $action;
                })

                ->rawColumns(['title', 'status', 'action'])
                ->make(true);
        }
    }

    public function create(): View
    {
        $data['title'] = 'Goal Status';
        $data['sub_title'] = 'Create';
        return view('admin.goal_status.create', $data);
    }

    public function update(Request $request){
        // echo "<pre>"; print_r($request->all()); die;
        $data['title'] = 'Goal Category';
        $data['sub_title'] = 'Update';
        $data['goalstatus'] = GoalStatus::find($request->id);
        return view('admin.goal_status.update', $data);
    }

    public function store(Request $request)
    {
        
        if($request->id){

            request()->validate([
                'title' => 'required',
                'background_color' => 'required',
                'label_color' => 'required',
            ]);
    
            $data = GoalStatus::find($request->id); 
            $data->update([
                'title' => $request->title,
                'status' => $request->status, 
                'background_color' => $request->background_color, 
                'label_color' => $request->label_color, 
            ]);
    
            return response()->json([
                'success'=> 1,
                'message'=>"Goal Status Updated successfully."
            ]);

        }else{
            request()->validate([
                'title' => 'required',
                'background_color' => 'required',
                'label_color' => 'required',
            ]);
    
    
            $data = GoalStatus::create([
                'title' => $request->title,
                'status' => $request->status,
                'background_color' => $request->background_color,
                'label_color' => $request->label_color,
            ]);
    
            return response()->json([
                'success' => 1,
                'message' => "Goal Status created successfully."
            ]);
        }
    }

    public function status(Request $request)
    {
        $data = GoalStatus::find($request->id);
        $data->status = $request->status;
        $data->save();
        return response()->json([
            'success' => 1,
            'message' => "Goal Status status changed successfully."
        ]);
    }

    public function destroy(Request $request)
    {
       
        $data = GoalStatus::find($request->id); 
        $data->delete(); 

        return response()->json([
            'success'=> 1,
            'message'=>"Goal Status deleted successfully."
        ]);
     
      
    }

 
}
