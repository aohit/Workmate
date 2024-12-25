<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RatingScale;
use App\Models\RatingScaleOption;
use Illuminate\Auth\Events\Validated;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RatingScaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $data;

    public function __construct(){
        
        $this->data['title'] = '';
        $this->data['sub_title'] = '';
    }

    public function index(): View
    {
        return view('admin.rating_scale.index', $this->data);
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {

            $data = RatingScale::with('ratingScaleOption')->get();
            return DataTables::of($data)
                ->addIndexColumn()
           
                ->addColumn('name', function ($row) {
                    $optionCount = count($row->ratingScaleOption);
                    $status = $optionCount.'-point - '.$row->label.' (';
                    $status .= $row->ratingScaleOption->first()->option_label;
                    $status .= $optionCount > 2 ? ' .. ' : ', ';
                    $status .= $row->ratingScaleOption[($optionCount - 1)]->option_label;
                    
                    if($row->is_include_na){
                        $status .= ' + N/A';
                    }
                    return $status.')';
                })
                ->addColumn('include_na', function ($row) {
                    $include = $row->is_include_na == 1?'YES':'NO';
                    return $include;
                })
                ->addColumn('display_type', function ($row) {
                    $display_type = $row->display_type == 1?'Stars':'Numbers';
                    return $display_type;
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.rating-scales.edit', ['id' => $row->id]);
                    $deleteUrl = route('admin.rating-scales.destroy', ['id' => $row->id]);
                
                    $action = '<div class="flexblockclass gap-1">';
                    $action .= '<button type="button" onclick="editForm(' . $row->id . ', \'' . $editUrl . '\')" class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>';
                    $action .= '<button type="button" onclick="destroyForm(' . $row->id . ', \'' . $deleteUrl . '\')" class="btn-sm btn btn-outline-danger waves-effect waves-light mb-0">Delete</button>';
                    $action .= '</div>';
                
                    return $action;
                })

                ->rawColumns(['name','include_na','display_type','action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['sub_title'] = 'Create Rating Scale';
        return view('admin.rating_scale.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // echo "<pre>";print_r($request->all());die;
        
        $validator = $request->validate([
            'ratingScaleLabel'=>'required',
            'ratingLabel'=>'required',
            'ratingLabel.*'=>'required',
            'option_view_type'=>'required',
        ]);
        
        $ratingScale = RatingScale::create([
            'label' => $request->ratingScaleLabel,
            'is_include_na' => $request->include_na == '1' ?: '0',
            'is_include_na' => $request->include_na == '1' ?: '0',
            'display_type' => $request->option_view_type == '1' ?: '0',
        ]);

        foreach($request->ratingLabel as $ratingLabel){
            RatingScaleOption::create([
                'rating_scale_id' => $ratingScale->id,
                'option_label' => $ratingLabel,
            ]);
        }

        return response()->json(['success'=>1,'message'=>'Rating scale added successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(RatingScale $ratingScale)
    {
        echo "<pre>";
        print_r($ratingScale);
        die;

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        $data['sub_title'] = 'Create Rating Scale';
        $data['ratingScale'] = RatingScale::with('ratingScaleOption')->find($id);

        return view('admin.rating_scale.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = $request->validate([
            'ratingScaleLabel'=>'required',
            'ratingLabel'=>'required',
            'ratingLabel.*'=>'required',
            'option_view_type'=>'required',
        ]);
        
        $ratingScale = RatingScale::find($request->rating_scale_id)->update([
            'label' => $request->ratingScaleLabel,
            'is_include_na' => $request->include_na == '1' ?: '0',
            'is_include_na' => $request->include_na == '1' ?: '0',
            'display_type' => $request->option_view_type == '1' ?: '0',
        ]);

        RatingScaleOption::where('rating_scale_id',$request->rating_scale_id)->delete();

        foreach($request->ratingLabel as $ratingLabel){
            RatingScaleOption::create([
                'rating_scale_id' => $request->rating_scale_id,
                'option_label' => $ratingLabel,
            ]);
        }

        return response()->json(['success'=>1,'message'=>'Rating scale updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        RatingScale::destroy($id);
        return response()->json(['message' => 'Rating scale deleted successfully']);
    }
}
