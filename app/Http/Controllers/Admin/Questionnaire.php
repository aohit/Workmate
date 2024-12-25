<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Questionnaire extends Controller
{
    public function index(): View
    {
        $data['title'] = 'Questionnaire';
        $data['sub_title'] = 'Questionnaire';
        return view('admin.questionnaire.index',$data);
    }

    public function list(Request $request)
    {
        
        if ($request->ajax()) {

            
                $data = Admin::get(); 

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $name =  $row->name;
                        return $name;
                    })
                    ->addColumn('email', function($row){
                        $email =  $row->email;
                        return $email;
                    })
                    ->addColumn('roles', function($row){

                        $rolesArr =  $row->getRoleNames(); 
                        $roles = '';
                        foreach($rolesArr as $role){
                            $roles .= '<button type="button" class="btn-sm btn btn-light rounded-pill waves-effect">'.$role.'</button> ';
                        }
                          
                        return $roles;
                    })
                    ->addColumn('action', function($row){ 

                        $editUrl = route('admin.admin_user.update');
                        $action =  '<button type="button" onclick = editForm(this,"'.$row->id.'","'. $editUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</button>&nbsp;&nbsp;&nbsp;';

                        $deleteUrl = route('admin.admin_user.delete');
                        $action .=  '<button type="button" onclick = deleteRow(this,"'.$row->id.'","'. $deleteUrl .'") class="d-none btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
                        return $action;
                    })
                   
                    ->rawColumns(['name','email','roles','action'])
                    ->make(true);
        }
    }



}
