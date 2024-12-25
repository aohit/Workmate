<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Department;
use App\Models\User;

class AdminDashboardController extends Controller
{
    /**
     * Display the login view.
     */

     public function index(): View
        { 
             
            $data['title'] = 'Workforce Overview';
            $data['department'] = Department::where('status',1)->get();
            $data['employee'] = User::get();
            return view('admin.dashboard',$data);
        }
 
}