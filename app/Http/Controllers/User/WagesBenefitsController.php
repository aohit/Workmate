<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WagesAndBenefits;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;
use App\Enums\TaskStatusEnum;

class WagesBenefitsController extends Controller
{
    public function index(): View
    {
        $data['title'] = 'Employee Wages And Benefits';
        $data['sub_title'] = 'Employee Wages And Benefits';
        return view('user.wagesbenefits.index',$data);
    }

    public function list(Request $request)
    {
        //   echo "<pre>"; print_r($request->toArray()); die;
        if ($request->ajax())
        {
      
        //   $data = WagesAndBenefits::get(); 
        if (auth('web')->user()->hasPermissionTo('wages-and-benefits')){
            $data = WagesAndBenefits::get(); 
        }elseif(auth('web')->user()->hasPermissionTo('employee-wages-and-benefits')){
            $userId = Auth::guard('web')->user()->id;  
            // echo "<pre>";print_r($userId);die;
            $data = WagesAndBenefits::where('user_id',$userId)->get(); 
            
        }
  
           return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user_id', function($row){
                    $user = User::where('id',$row->user_id)->select('name')->first();
                    // echo "<pre>";print_r($user);die;
                    $user_id =  ucwords($user->name);
                    return $user_id;
                }) 
                ->addIndexColumn()
                ->addColumn('items', function($row){
                    $items =  $row->items;
                    return $items;
                })
                ->addColumn('currency', function($row){
                    $currency =  $row->currency;
                    return $currency;
                })
                ->addColumn('amount', function($row){
                    $amount =  $row->amount;
                    return $amount;
                    // return $row->user->name;
                })
                ->addColumn('action', function($row){ 

                    $editUrl = route('wages-benefits.update');
                    $action =  '<button type="button" onclick = editForm(this,"'.$row->id.'","'. $editUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1 uk">Edit</button>&nbsp;&nbsp;&nbsp;';

                     $deleteUrl = route('wages-benefits.delete');
                    $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';

                    // echo "<pre>";print_r($action);die;
                    return $action;
                })
               
                ->rawColumns(['user_id','items','currency','amount','action'])
                ->make(true);
        }
    }

    public function create(Request $request)
    {
         $data['title'] = 'Wages And Benefits';
        $data['sub_title'] = 'Wages And Benefits'; 
        $data['employees'] = User::get();
        return view('user.wagesbenefits.create',$data); 
    }

    public function update(Request $request)
    {  
        $data['title'] = 'Wages And Benefits';
        $data['sub_title'] = 'Wages And Benefits';  
        $data['employees'] = User::get();   
        $data['uinfo'] = WagesAndBenefits::with('user')->find($request->id);
        return view('user.wagesbenefits.update',$data); 
    }

    public function store(Request $request)
    {     
        // echo "<pre>"; print_r($request->all()); die; 
            if($request->id){ 
              $id = $request->id;
                request()->validate([
                    'user_id' => 'required',  
                    'items' => 'required', 
                    'currency' => 'required', 
                    'amount' => 'required', 
                    
                    ]);

                $admin = WagesAndBenefits::find($request->id);
               
                    $admin->update([
                        'user_id' => $request->user_id,    
                        'items' => $request->items,
                        'currency' => $request->currency,
                        'amount' => $request->amount,
                    ]);     
               
                return response()->json([
                    'success'=> 1,
                    'message'=>"Wages and benefits Updated successfully."
                ]);

            }else{ 
                request()->validate([
                   'user_id' => 'required',  
                    'items' => 'required', 
                    'currency' => 'required', 
                    'amount' => 'required', 
                ]);
    
                $emp = WagesAndBenefits::create([
                    'user_id' => $request->user_id,    
                    'items' => $request->items,
                    'currency' => $request->currency,
                    'amount' => $request->amount,
                ]);

                return response()->json([
                    'success'=> 1,
                    'message'=>"Wages and Benefits Insert Successfully."
                ]);
            }
    }

    public function destroy(Request $request)
    {
       
        $data = WagesAndBenefits::find($request->id); 
        $data->delete(); 

        return response()->json([
            'success'=> 1,
            'message'=>"Wages and benefits deleted successfully."
        ]);
     
      
    }


}
