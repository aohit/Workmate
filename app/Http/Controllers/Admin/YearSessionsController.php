<?php
    
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Session;
use Spatie\Permission\Models\Sessions;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use DataTables;
use Illuminate\Http\JsonResponse;

class YearSessionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $data['nav'] = 'Session';
        $data['sub_nav'] = '';
        $data['title'] = 'Session';
        return view('admin.session.index',$data); 
    }
   

    public function create()
    {  
       
    }
   
    public function store(Request $request)
    {
      
    }



    public function destroy(Request $request)
    {
       
    }

    public function list(Request $request)
    {
    
        if ($request->ajax()) {
    
        $data = Session::get(); 
      
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    if(session('sessionId') == $row->id){
                        $status =  '<button type="button"  class="btn-sm btn btn-success  waves-effect waves-light">Active</button>';
                    }else{
                        $status =  '<button type="button" class="btn-sm btn btn-outline-danger waves-effect waves-light">Inactive</button>';
                    }
                    return $status;
                }) 
                ->addColumn('start_year', function($row){
                    $start_year =  $row->start_year;
                    return $start_year;
                }) 
                ->addColumn('end_year', function($row){
                    $end_year =  $row->end_year;
                    return $end_year;
                }) 
                ->addColumn('action', function ($row) {

                    $statusUrl = route('admin.year-session-status');
                    if ($row->status == 0) {
                        $status =  '<button type="button" onclick = changeStatus(this,"' . $row->id . '","' . $statusUrl . '",1) class="btn-sm btn btn-outline-success rounded-pill waves-effect waves-light">Login</button>';
                    } else {
                        $status =  '<button type="button" onclick = changeStatus(this,"' . $row->id . '","' . $statusUrl . '",0) class="btn-sm btn btn-outline-success rounded-pill waves-effect waves-light">Login</button>';
                    }

                    return $status;
                })
               
                ->rawColumns(['status','start_year','end_year','action'])
                ->make(true);
    }
    }


    public function status(Request $request)
    {
        // Session::where('status', 1)->update(['status' => 0]);

        $data = Session::find($request->id);
       
        if ($data) {
            // $data->status = 1;
            // $data->save();
            
            \Illuminate\Support\Facades\Session::put('sessionId', $data->id);
        
            return response()->json([
                'success' => 1,
                'message' => "Changed session successfully. New session is set."
            ]);
        }

        return response()->json([
            'success' => 0,
            'message' => "Session not found."
        ]);
}


    
   

    // public function status(Request $request)
    // {
    //     Session::where('is_default', '0')->update(['is_default' => '1']);

    //     $data = Session::find($request->id);
    //     $data->is_default = $request->status; 
    //     $data->save();
    //     \Illuminate\Support\Facades\Session::flush();
    //     $session = Session::where('is_default', 0)->first();

    //     // Set new session for the updated record
    //     \Illuminate\Support\Facades\Session::put('sessionId', $session->id);

    //     return response()->json([
    //         'success' => 1,
    //         'message' => "Status changed successfully. New session is set."
    //     ]);
    // }


}