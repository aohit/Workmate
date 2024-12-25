<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Appraisal;
use App\Models\CompanyAnnouncement;
use App\Models\ReviewCycle;
use App\Models\GoalReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class UserDashboardController extends Controller
{
    /**
     * Display the login view.
     */

     public function index(): View
        { 
            $data['title'] = 'My Dashboard';
            $userid =  Auth::guard('web')->user()->id;
            $data['uinfo']= $emp = User::find($userid);
          
            $data['tasks'] = $user = Appraisal::where('user_id',$userid)->where('self_review',0)->get();
            $data['mantaks'] = $manager = Appraisal::where('manager_id',$userid)->where('self_review',1)->where('manager_review',0)->get();
            // echo "<pre>"; print_r($data['tasks']); die;
            $data['announcements']= $announcement = CompanyAnnouncement::with('backgroundcolor','textcolor')->where('status',1)->get();
            $data['reviewCycles']= ReviewCycle::where('status',1)->get();
            // echo "<pre>"; print_r($announcement->toArray()); die;
            
             $data['goalreview'] = GoalReview::where('employee_id',$userid)->where('self_review',0)->get();
            $data['managergoalreview'] = GoalReview::where('manager_id',$userid)->where('manager_review',0)->get();
            
            return view('user.profile.tabs',$data);
        }
 
}