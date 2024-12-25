<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReviewCycle;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DisciplinaryExport;
use App\Exports\ReviewCycleExport;

class ReviwCycleController extends Controller
{
    public function index(): View
    {
        $data['title'] = 'Review Cycle';
        $data['sub_title'] = 'Review Cycle';
        $reviewCycle = ReviewCycle::get();
        $uniqueYears = [];
        
        foreach ($reviewCycle as $cycle) {
            $createdYear = Carbon::parse($cycle->start_date)->year;
            if (!in_array($createdYear, $uniqueYears)) {
                $uniqueYears[] = $createdYear;
            }
        }
        $data['departments'] = $uniqueYears;
        return view('admin.review_cycle.index', $data);
    }

    public function list(Request $request)
    {

        if ($request->ajax()) {


            $data = ReviewCycle::query();
            if ($request->has('year') && $request->year) {
                $data->whereYear('start_date', $request->year); 
            }

             $reviewCycles = $data->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('title', function ($row) {
                    $title =  $row->title;
                    return $title;
                })
                ->addColumn('start_date', function ($row) {
                    $start_date =  $row->start_date;

                    return Carbon::createFromFormat('Y-m-d', $start_date)->format('d-M-Y');
                })
                ->addColumn('end_date', function ($row) {
                    $end_date =  $row->end_date;

                    return Carbon::createFromFormat('Y-m-d', $end_date)->format('d-M-Y');
                })

                ->addColumn('status', function ($row) {

                    if($row->status == 1){
                        $status =  '<button type="button"  class="btn-sm btn btn-success  waves-effect waves-light">Active</button>';
                    }else{
                        $status =  '<button type="button" class="btn-sm btn btn-outline-danger waves-effect waves-light">Inactive</button>';
                    }
                     
                    return $status;
                })

                ->addColumn('action', function ($row) {
                    $statusUrl = route('admin.review-cycle-status');
                    if ($row->status == 0) {
                        $status =  '<button type="button" onclick = changeStatus(this,"' . $row->id . '","' . $statusUrl . '",1) class="btn-sm btn btn-outline-success waves-effect waves-light ms-1">Active</button>';
                    } else {
                        $status =  '<button type="button" onclick = changeStatus(this,"' . $row->id . '","' . $statusUrl . '",0) class="btn-sm btn btn-outline-danger  waves-effect waves-light ms-1">Inactive</button>';
                    }

                    $editUrl = route('admin.update-review-cycle');
                    $deleteUrl = route('admin.delete-review-cycle');
                    
                    // $action = '<div class="flexblockclass gap-1">';
                    
                    $action = '<button type="button" onclick="editForm(this, \'' . $row->id . '\', \'' . $editUrl . '\')" class="btn-sm btn btn-outline-dark waves-effect waves-light mx-1">Edit</button>';
                
                    $action .= '<button type="button" onclick="deleteRow(this, \'' . $row->id . '\', \'' . $deleteUrl . '\')" class="btn-sm btn btn-outline-danger waves-effect waves-light mb-0">Delete</button>';
                    
                    // $action .= '</div>';
                    
                    return $action.''.$status;
                })
                ->rawColumns(['title', 'start_date', 'end_date', 'status', 'action'])
                ->make(true);
        }
    }

    public function create(): View
    {
        $data['title'] = 'Review Cycle';
        $data['sub_title'] = 'Create';
        return view('admin.review_cycle.create', $data);
    }

    public function update(Request $request){
        // echo "<pre>"; print_r($request->all()); die;
        $data['title'] = 'Review Cycle';
        $data['sub_title'] = 'Create';
        $data['reviewcycle'] = ReviewCycle::find($request->id);
        return view('admin.review_cycle.update', $data);
    }

    public function store(Request $request)
    {
        if($request->id){

            request()->validate([
                'title' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
    
            $data = ReviewCycle::find($request->id); 
            $data->update([
                'title' => $request->title,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status, 
            ]);
    
            return response()->json([
                'success'=> 1,
                'message'=>"Review Cycle Updated successfully."
            ]);

        }else{
            request()->validate([
                'title' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
    
    
            $data = ReviewCycle::create([
                'title' => $request->title,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
            ]);
    
            return response()->json([
                'success' => 1,
                'message' => "Review Cycle created successfully."
            ]);
        }
    }

    public function status(Request $request)
    {
        $data = ReviewCycle::find($request->id);
        $data->status = $request->status;
        $data->save();
        return response()->json([
            'success' => 1,
            'message' => "Review Cycle status changed successfully."
        ]);
    }

    public function destroy(Request $request)
    {
       
        $data = ReviewCycle::find($request->id); 
        $data->delete(); 

        return response()->json([
            'success'=> 1,
            'message'=>"Review Cycle deleted successfully."
        ]);
    }

    public function export(Request $request) 
    { 
        $yearFilter = $request->year; 
        if(!empty($request->year)){
            $disciplinary = ReviewCycle::whereYear('start_date', $request->year)->get(); 
        } else {
            $disciplinary = ReviewCycle::get();
        }
        return Excel::download(new ReviewCycleExport($disciplinary), 'reviewcycle.xlsx');
    }

 
}
