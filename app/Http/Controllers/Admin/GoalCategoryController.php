<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GoalCategory;
use Illuminate\Http\Request;
use App\Models\ReviewCycle;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class GoalCategoryController extends Controller
{
    public function index(): View
    {
        $data['title'] = 'Goal Category';
        $data['sub_title'] = 'Goal Category';
        $data['appraisal'] = GoalCategory::get();
        return view('admin.goal_category.index', $data);
    }

    // public function list(Request $request)
    // {

    //     if ($request->ajax()) {


    //         $data = GoalCategory::get();

    //         return DataTables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('title', function ($row) {
    //                 $title =  $row->title;
    //                 return $title;
    //             })

    //             ->addColumn('status', function ($row) {

    //                 $statusUrl = route('admin.goal-category-status');
    //                 if ($row->status == 0) {
    //                     $status =  '<button type="button" onclick = changeStatus(this,"' . $row->id . '","' . $statusUrl . '",1) class="btn-sm btn btn-soft-success rounded-pill waves-effect waves-light">Active</button>';
    //                 } else {
    //                     $status =  '<button type="button" onclick = changeStatus(this,"' . $row->id . '","' . $statusUrl . '",0) class="btn-sm btn btn-soft-success rounded-pill waves-effect waves-light">In-Active</button>';
    //                 }

    //                 return $status;
    //             })

    //             ->addColumn('action', function ($row) {

    //                 $editUrl = route('admin.update-goal-category');
    //                 $action =  '<button type="button" onclick = editForm(this,"' . $row->id . '","' . $editUrl . '") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;';

    //                 $deleteUrl = route('admin.delete-goal-category');
    //                 $action .=  '<button type="button" onclick = deleteRow(this,"' . $row->id . '","' . $deleteUrl . '") class="btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
    //                 return $action;
    //             })

    //             ->rawColumns(['title', 'status', 'action'])
    //             ->make(true);
    //     }
    // }

  
  
    public function list(Request $request)
    {

        if ($request->ajax()) {


            $data = GoalCategory::get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('title', function ($row) {
                    $title =  $row->title;
                    return $title;
                })

                ->addColumn('status', function ($row) {
                    if($row->status == 1){
                        $status =  '<button type="button"  class="btn-sm btn btn-success  waves-effect waves-light">Active</button>';
                    }else{
                        $status =  '<button type="button" class="btn-sm btn btn-outline-danger waves-effect waves-light">Inactive</button>';
                    }
                     
                    return $status;
                    // $statusUrl = route('admin.goal-category-status');
                    // if ($row->status == 0) {
                    //     $status =  '<button type="button" onclick = changeStatus(this,"' . $row->id . '","' . $statusUrl . '",1) class="btn-sm btn btn-soft-success rounded-pill waves-effect waves-light">Active</button>';
                    // } else {
                    //     $status =  '<button type="button" onclick = changeStatus(this,"' . $row->id . '","' . $statusUrl . '",0) class="btn-sm btn btn-soft-success rounded-pill waves-effect waves-light">In-Active</button>';
                    // }

                    // return $status;
                })

                ->addColumn('action', function ($row) {

                    $statusUrl = route('admin.goal-category-status');
                    if ($row->status == 0) {
                        $status =  '<button type="button" onclick = changeStatus(this,"' . $row->id . '","' . $statusUrl . '",1) class="btn-sm btn btn-outline-success waves-effect waves-light ms-1">Active</button>';
                    } else {
                        $status =  '<button type="button" onclick = changeStatus(this,"' . $row->id . '","' . $statusUrl . '",0) class="btn-sm btn btn-outline-danger  waves-effect waves-light ms-1">Inactive</button>';
                    }

                    $editUrl = route('admin.update-goal-category');
                    $action =  '<button type="button" onclick = editForm(this,"' . $row->id . '","' . $editUrl . '") class="btn-sm btn btn-outline-dark waves-effect waves-light me-1">Edit</button>';

                    $deleteUrl = route('admin.delete-goal-category');
                    $action .=  '<button type="button" onclick = deleteRow(this,"' . $row->id . '","' . $deleteUrl . '") class="btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
                    return $action.''.$status;
                })


                // ->addColumn('action', function ($row) {

                //     $editUrl = route('admin.update-goal-category');
                //     $deleteUrl = route('admin.delete-goal-category');
                    
                //     $action = '<div class="flexblockclass gap-1">';
                //     $action .= '<button type="button" onclick="editForm(this, \'' . $row->id . '\', \'' . $editUrl . '\')" class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>';
                //     $action .= '<button type="button" onclick="deleteRow(this, \'' . $row->id . '\', \'' . $deleteUrl . '\')" class="btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
                //     $action .= '</div>';
                    
                //     return $action;
                // })
                ->rawColumns(['title', 'status', 'action'])
                ->make(true);
        }
    }

    public function create(): View
    {
        $data['title'] = 'Goal Category';
        $data['sub_title'] = 'Create';
        return view('admin.goal_category.create', $data);
    }

    public function update(Request $request)
    {
        // echo "<pre>"; print_r($request->all()); die;
        $data['title'] = 'Goal Category';
        $data['sub_title'] = 'Update';
        $data['categorye'] = GoalCategory::find($request->id);
        return view('admin.goal_category.update', $data);
    }

    public function store(Request $request)
    {
        if ($request->id) {

            request()->validate([
                'title' => 'required',
            ]);

            $data = GoalCategory::find($request->id);
            $data->update([
                'title' => $request->title,
                'status' => $request->status,
            ]);

            return response()->json([
                'success' => 1,
                'message' => "Goal Category Updated successfully."
            ]);
        } else {
            request()->validate([
                'title' => 'required',
            ]);


            $data = GoalCategory::create([
                'title' => $request->title,
                'status' => $request->status,
            ]);

            return response()->json([
                'success' => 1,
                'message' => "Goal Category created successfully."
            ]);
        }
    }

    public function status(Request $request)
    {
        $data = GoalCategory::find($request->id);
        $data->status = $request->status;
        $data->save();
        return response()->json([
            'success' => 1,
            'message' => "Goal Category status changed successfully."
        ]);
    }

    public function destroy(Request $request)
    {

        $data = GoalCategory::find($request->id);
        $data->delete();

        return response()->json([
            'success' => 1,
            'message' => "Goal Category deleted successfully."
        ]);
    }
}
