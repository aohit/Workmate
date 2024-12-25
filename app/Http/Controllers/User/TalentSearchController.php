<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Holiday; 
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Hash; 
use DataTables;

class TalentSearchController extends Controller
{
    /**
     * Display the login view.
     */
 
     public function index(): View
        { 
            $data['title'] = 'Talent Search';
            $data['sub_title'] = 'Talent Search';
            return view('user.talent_search.index',$data);
        }
 
 
}