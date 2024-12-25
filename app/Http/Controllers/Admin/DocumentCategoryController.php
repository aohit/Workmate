<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\DocumentCategory;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Hash;
use DataTables;

class DocumentCategoryController extends Controller
{
    /**
     * Display the login view.
     */


    public function index(): View
    {

        $data['title'] = 'Document Category';
        $data['sub_title'] = 'Document Category List';
        $data['documentCategory'] = DocumentCategory::get();
        return view('admin.document-category.index', $data);
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {


            $data = DocumentCategory::get();

            return DataTables::of($data)
                ->addIndexColumn()

                // ->addColumn('status', function($row){ 

                //     $statusUrl = route('admin.document-category.status'); 
                //     if($row->status == 0){
                //         $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",1) class="btn-sm btn btn-soft-success rounded-pill waves-effect waves-light">Active</button>';
                //     }else{
                //         $status =  '<button type="button" onclick = changeStatus(this,"'.$row->id.'","'. $statusUrl .'",0) class="btn-sm btn btn-soft-success rounded-pill waves-effect waves-light">In-Active</button>';
                //     }

                //     return $status;
                // })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        $status = '<button type="button"  class="btn-sm btn btn-success  waves-effect waves-light">Active</button>';
                    } else {
                        $status = '<button type="button" class="btn-sm btn btn-outline-danger waves-effect waves-light">Inactive</button>';
                    }

                    return $status;
                })

                ->addColumn('action', function ($row) {
                    $action = '<div class="flexblockclass gap-1">';
                    $editUrl = route('admin.document-category.update');
                    $action .= '<button type="button" onclick="editForm(this, \'' . $row->id . '\', \'' . $editUrl . '\')" class="btn-sm btn btn-outline-dark waves-effect waves-light me-1">Edit</button>';
                    $deleteUrl = route('admin.document-category.delete');
                    $action .= '<button type="button" onclick="deleteRow(this, \'' . $row->id . '\', \'' . $deleteUrl . '\')" class="btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
                    $statusUrl = route('admin.document-category.status');
                    if ($row->status == 0) {
                        $status = '<button type="button" onclick="changeStatus(this, \'' . $row->id . '\', \'' . $statusUrl . '\', 1)" class="btn-sm btn btn-outline-success waves-effect waves-light ms-1 mb-0">Active</button>';
                    } else {
                        $status = '<button type="button" onclick="changeStatus(this, \'' . $row->id . '\', \'' . $statusUrl . '\', 0)" class="btn-sm btn btn-outline-danger waves-effect waves-light ms-1 mb-0">Inactive</button>';
                    }
                    $action .= $status;
                    $action .= '</div>';
                    return $action;
                })

                ->rawColumns(['date', 'status', 'action'])
                ->make(true);
        }
    }

    public function create(): View
    {
        $data['title'] = 'Document Category';
        $data['sub_title'] = 'Create';
        return view('admin.document-category.create', $data);
    }

    public function update(Request $request): View
    {
        $data['title'] = 'Holiday';
        $data['sub_title'] = 'Update';
        $data['uinfo'] = DocumentCategory::find($request->id);
        return view('admin.document-category.update', $data);
    }

    public function store(Request $request)
    {

        if ($request->id) {

            request()->validate([
                'title' => 'required',
            ]);
            $data = DocumentCategory::find($request->id);
            $data->update([
                'title' => $request->title,
                'status' => $request->status,
            ]);



            return response()->json([
                'success' => 1,
                'message' => "Document Category Updated successfully."
            ]);

        } else {
            request()->validate([
                'title' => 'required',
            ]);

            $data = DocumentCategory::create([
                'title' => $request->title,
                'status' => $request->status,
            ]);

            return response()->json([
                'success' => 1,
                'message' => "Document Category created successfully."
            ]);
        }

    }


    public function destroy(Request $request)
    {

        $data = DocumentCategory::find($request->id);
        $data->delete();


        return response()->json([
            'success' => 1,
            'message' => "Document Category deleted successfully."
        ]);


    }

    public function status(Request $request)
    {

        $data = DocumentCategory::find($request->id);
        $data->status = $request->status;
        $data->save();
        return response()->json([
            'success' => 1,
            'message' => "Document Category status changed successfully."
        ]);


    }




}