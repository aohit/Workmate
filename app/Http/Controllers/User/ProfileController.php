<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;  
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\{Appraisal, Certificate, CompanyAnnouncement, Department, Education, EmergencyContact, EmployeeLeaveHistory, Goal, GoalStatus, Holiday, KeyResult, Language, User,LeaveRequest, LeaveType, PublicHoliday, ReviewCycle, Skill, skills, Task, WagesAndBenefits,GoalReview,Session};
use App\Models\Document; 
use Illuminate\Support\Facades\Hash;
use DataTables;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    protected $route;

    //  public function __construct()
    //  {
    //        $this->route = new \stdClass;
    //        $this->route->edit = route('admin.pages.edit','');
    //  }


    public function edit(Request $request): View
    { 
        $data['title'] = 'My Dashboard';
        $userid =  Auth::guard('web')->user()->id;
        $data['uinfo']= $emp = User::find($userid);
      
        $data['tasks'] = $user = Appraisal::where('user_id',$userid)->where('self_review',0)->get();
        $data['mantaks'] = $manager = Appraisal::where('manager_id',$userid)->where('self_review',1)->where('manager_review',0)->get();
        // echo "<pre>"; print_r($data['tasks']); die;
        $data['announcements']= $announcement = CompanyAnnouncement::with('backgroundcolor','textcolor')->where('status',1)->get();
        $data['reviewCycles']= ReviewCycle::where('status',1)->get();
       $data['goalreview'] = GoalReview::where('employee_id',$userid)->where('self_review',0)->get();
      
         $data['managergoalreview'] = GoalReview::where('manager_id',$userid)->where('manager_review',0)->get();
        // echo "<pre>"; print_r($recentKeys->toArray()); die;
        return view('user.profile.tabs' ,$data); 
    }

    public function  myPerformanceReview(Request $request)
    { 
        $data['title'] = 'My performance review';
        $data['sub_title'] = 'My performance review';
        $userid =  Auth::guard('web')->user()->id;
        $data['uinfo']= $emp = User::find($userid);
      
        $data['tasks'] = $user = Appraisal::where('user_id',$userid)->where('self_review',0)->get();
        $data['mantaks'] = $manager = Appraisal::where('manager_id',$userid)->where('self_review',1)->where('manager_review',0)->get();
        $data['goalreview'] = GoalReview::where('employee_id',$userid)->where('self_review',0)->get();
         $data['managergoalreview'] = GoalReview::where('manager_id',$userid)->where('manager_review',0)->get();
        return view('user.profile.performancetabs.myperformance', $data);
    }

    public function  myTeamPerformanceReview(Request $request)
    {
        $data['title'] = 'My team performance review';
        $data['sub_title'] = 'My team performance review';
        $userid =  Auth::guard('web')->user()->id;
        $data['uinfo']= $emp = User::find($userid);
      
        $data['tasks'] = $user = Appraisal::where('user_id',$userid)->where('self_review',0)->get();
        $data['mantaks'] = $manager = Appraisal::where('manager_id',$userid)->where('self_review',1)->where('manager_review',0)->get();
    
    //    $data['goalreview'] = GoalReview::where('employee_id',$userid)->where('self_review',0)->get();
      
    //     $data['managergoalreview'] = GoalReview::where('manager_id',$userid)->where('manager_review',0)->get();
     
    $data['goalreview'] = GoalReview::where('employee_id',$userid)->where('self_review',0)->where('manager_review',0)->get();
      
    $data['managergoalreview'] = GoalReview::where('manager_id',$userid)->where('manager_review',0)->where('self_review',0)->get();
        return view('user.profile.performancetabs.myteamperformance', $data);
    }

    public function  hrTeamPerformance(Request $request)
    {
        $data['title'] = 'My Dashboard';
        $userid =  Auth::guard('web')->user()->id;
        $data['uinfo']= $emp = User::find($userid);
      
        $data['tasks'] = $user = Appraisal::where('self_review',0)->get();
        $data['mantaks'] = $manager = Appraisal::where('manager_id',$userid)->where('manager_review',0)->get();
        // echo "<pre>"; print_r($data['tasks']); die;
      
       $data['goalreview'] = GoalReview::where('self_review',0)->where('manager_review',1)->get();
      
         $data['managergoalreview'] = GoalReview::where('self_review',0)->where('manager_review',0)->get();
        return view('user.profile.performancetabs.hrteamperformance', $data);
    }

    public function DashboardChart(Request $request){
        $revireCycle =  $request->reviewcycle;
        $data['goalstatus'] = $goalstatus = GoalStatus::with(['goals' => function($query) use($revireCycle) {
            $query->where('user_id', Auth::guard('web')->user()->id);
            $query->where('review_cycle', $revireCycle);
        }])->where('status', 1)->get();
      
        $goalCount = 0;
        $goalCount = Goal::where('user_id', Auth::guard('web')->user()->id)->where('review_cycle', $revireCycle)->count();
        foreach ($goalstatus as $status) {
   
            $goalStatusCount = count($status->goals);
        
            $status->totalProgressPercentage = $goalStatusCount > 0 ? ($goalStatusCount *100) / $goalCount  : 0;
        }

        $goals = Goal::with(['keyresult' => function($query){
            // $query->where('traking', 'Quantifiable traget');
        }])->where('user_id',Auth::guard('web')->user()->id)->where('review_cycle', $revireCycle)->get();
        // echo "<pre>";print_r($goals->toArray());die;
        
        $target =0;
        $current =0;
        $start =0;
        $hundred = 100;
        $thisWeekDueCount =0;
        $totalDueCount =0;
        $totalkeyCount=0;
      
        $serialNumber = 0; 
        $total_progress = 0;
        foreach($goals as $goal) {
            foreach($goal->keyresult as $key) {
                $target += $key->target; 
                $current += $key->current; 
                $hundred += 100;
                $total_progress += $key->total_progress;
                $serialNumber++; 
            }

            $deadline = Carbon::parse($goal->deadline);
            $now = Carbon::now();
            $totalkeyCount += count($goal->keyresult);

            if ($deadline->isSameWeek($now)) {
                $thisWeekDueCount++;
            }
            if ($deadline->lessThanOrEqualTo($now)) {
                $totalDueCount++;
            }

            
        }
        $totalHun = $serialNumber*100;
        //  $totalProgressBar =number_format(($target > 0 ? ($current *100) / $target  : 0),2);
        //  $totalProgressBar = (($current - $start) / ($target - $start)) * 100;
        $totalProgressBar = round($target > 0 ?($total_progress * 100)/$totalHun : 0);
        $data['goalstatus'] = $goalstatus;
        $totalDueCount =0;
       $view =  view('user.profile.dashboardChart',compact('goalstatus','totalProgressBar','totalkeyCount','thisWeekDueCount','target','totalDueCount'))->render();

        return response()->json([
            'success'=> 1,
            'view' => $view,
            'goalstatus'=>$goalstatus
        ]); 
    }

    public function DashboardQuickOverView(Request $request){
        $recentKeys = [];
            if($request->quickoverciew == 'updaterecently'){

                $userid = Auth::guard('web')->user()->id;
                 $recentKeys = KeyResult::with(['goal.goalStatus'])
                 ->whereHas('goal', function($query) use($userid) {
                     $query->where('user_id', $userid);
                 })
                 ->orderByDesc('updated_at')
                 ->take(5)
                 ->get();
            }else if($request->quickoverciew == 'duesoon'){

                $now = Carbon::now();
                  $twoWeeksFromNow = $now->copy()->addWeeks(1);
                $userid = Auth::guard('web')->user()->id;

                $recentKeys = KeyResult::with(['goal.goalStatus'])
                ->whereHas('goal', function($query) use($userid, $now, $twoWeeksFromNow) {
                    $query->where('user_id', $userid)
                          ->whereBetween('deadline', [$now, $twoWeeksFromNow]);
                })
                ->orderByDesc('updated_at')
                ->take(5)
                ->get();
               
            }else if($request->quickoverciew == 'overdue'){
                $now = Carbon::now();
                    $userid = Auth::guard('web')->user()->id;
                $recentKeys = KeyResult::with(['goal.goalStatus'])
                ->whereHas('goal', function($query) use($userid, $now) {
                    $query->where('user_id', $userid)
                        ->where('deadline', '<', $now);
                })
                ->orderByDesc('updated_at')
                ->take(5)
                ->get();
            }

          $view =  view('user.profile.dashboardQuickView',compact('recentKeys'))->render();
          return response()->json([
            'success'=> 1,
            'view' => $view,
        ]); 
        
    }

    

    public function store(Request $request)
    {
      
        if($request->id){
            $id = $request->id;
            request()->validate([
                'name' => 'required', 
                'email' => 'required|email',  
                
                ]);
                $emp = User::find($request->id);
                if(!empty($request->password) && isset($request->password)){
                    
                    $emp->update([
                        'name' => $request->name,    
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                    ]);     
                }else{
                   
                    $emp->update([
                        'name' => $request->name,    
                        'email' => $request->email, 
                    ]);
                 
                }
           

            return response()->json([
                'success'=> 1,
                'message'=>"Your Profile Updated successfully."
            ]); 
        }   
       
    }


    
    public function myDashboardTabs(Request $request) 
    { 

        $userid =  Auth::guard('web')->user()->id;
        $data['uinfo']= $emp = User::find($userid);

           if($request->tab == 'my-profile'){ 
            $view = view('user.profile.tab.myprofile',$data)->render();
            return response()->json([
                'success'=> 1, 
                'view' => $view
            ]); 

           }elseif($request->tab == 'my-team'){
            $view = view('user.profile.tab.team',$data)->render();
            return response()->json([
                'success'=> 1,
                'view' => $view
            ]); 
           }elseif($request->tab == 'my-performance'){
            $view = view('user.profile.tab.performance',$data)->render();
            return response()->json([
                'success'=> 1,
                'view' => $view
            ]); 
           }elseif($request->tab == 'my-time-off'){
            $view = view('user.profile.tab.timeoff',$data)->render();
            return response()->json([
                'success'=> 1,
                'view' => $view
            ]); 
           }elseif($request->tab == 'my-training'){
            $view = view('user.profile.tab.training',$data)->render();
            return response()->json([
                'success'=> 1,
                'view' => $view
            ]); 
           }
    }

    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
    // }

    /**
     * Delete the user's account.
     */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/');
    // }
    public function list(Request $request)
    { 
        if ($request->ajax()) {

            
                $data = Document::get(); 
          
            return DataTables::of($data)
                    ->addIndexColumn()
                    
                    ->addColumn('date', function($row){ 
                            $status =  date('d-m-Y',strtotime($row->created_at));   
                        return $status;
                    })

                    ->addColumn('categoryData', function($row){ 

                    $category = $row->DocumentCategory->title; 
                    return $category;
                })

                    ->addColumn('action', function($row){ 

      
                        $file_path = asset('/upload/documents_attached') .'/'. $row->file;
                        $action =  '<a href="'. $file_path .'" download="" class="btn"><i class="fa fa-download" aria-hidden="true"></i></a>';
                        
                        return $action;
                    })
                   
                    ->rawColumns(['date','date','categoryData','action'])
                    ->make(true);
        }
    }

    public function myTeam()
    { 
        $data['title'] = 'My Team';
        $userid =  Auth::guard('web')->user()->department_id;
        if(auth('web')->user()->hasRole('HR')){
            $data['departments'] = Department::where('status' ,1)->orderBy('name', 'asc')->get();
        }else{
            $data['departments'] = Department::where('status' ,1)->orderBy('name', 'asc')->where('id',$userid)->get();
        }
        return view('user.team.index', $data); 
    }

        public function departmentTab(Request $request)
        { 
            if ($request->ajax()) {
                $data['department_id'] = $request->id;
                if(auth('web')->user()->hasRole('HR')){
                $data['teams'] = User::with('department','manager')->where('department_id',$request->id)->orderby('name','asc')->get();
                $users = User::with('department','manager')->where('department_id', $request->id )->orderby('name','asc')->get();
                }else{
                    $userid =  Auth::guard('web')->user()->department_id;
                    $data['teams'] = User::with('department','manager')->where('department_id',$userid)->orderby('name','asc')->get();
                    $users = User::with('department','manager')->where('department_id', $userid )->orderby('name','asc')->get();
                }
                $i=1;
                if($users->count() > 0){
                    $i=1;
                    $user_id = 1;
                    foreach($users as $val){
                        if($i==1){
                        $user_id = $val->id;
                        }
                        $i++;
                    }
                    $data['user_id'] = $user_id;
                    $view = view('admin.team.components.tabs', $data)->render();  
                    return response()->json([
                        'success'=> 1, 
                        'view' => $view
                    ]);
                }
            
            }
        }

    public function myTeamList(Request $request)
    { 
        $user =  Auth::guard('web')->user();
        $dep_id = $_POST['department_id'];
        
        if ($request->ajax()) {
            if($user->department_id == 2){
                $data = User::with('department','manager','Image')->where('department_id', $dep_id )->get(); 
            }else{
                $data = User::with('department','manager','Image')->where('department_id',$user->department_id)->get(); 
            }
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('employees', function($row){ 
                        $imageUrl = !empty($row->file_id) ? asset('upload/employee/'.$row->Image->file) : asset('assets/images/users/user-1.jpg');
                        $detail = '<div class="inbox-item">
                                            <a href="javascript:void(0);" onclick="profileDetail('.$row->id.')">
                                                <div class="inbox-item-img"><img src="'.$imageUrl.'" class=" rounded-circle" style="height: 40px; width: 40px;" style="border-radius: 50%;" alt=""></div>
                                                <h5 class="inbox-item-author mt-0 mb-1">'.ucfirst($row->name).'</h5>
                                                <p class="inbox-item-text">'.$row->email.'</p>
                                            </a>
                                        </div> ';

                        return $detail;
                    })
                    ->addColumn('department', function($row){ 
                        $department = $row->department->name; 
                        return '<span class="badge bg-secondary rounded-circle-1 noti-icon-badge"> Team</span> '.$department;
                    })
                    ->addColumn('manager', function($row) { 
                        $manager_name = ucfirst($row->manager->name);
                        $detail = '
                            <a href="javascript:void(0);" onclick="profileDetail('.$row->id.')" style="color: inherit; text-decoration: none; display: block;">
                                <div>
                                    '.$manager_name.'
                                </div>
                            </a>
                        ';
                        return $detail;
                    })
                    ->addColumn('job_title', function($row){ 
                        $job_title = ucfirst($row->job_title ?? 'Na');
                        $details = '
                            <a href="javascript:void(0);" onclick="profileDetail('.$row->id.')" style="color: inherit; text-decoration: none; display: block;">
                                <div>
                                    '.$job_title.'
                                </div>
                            </a>
                        ';
                        return $details;
                    })

                    ->rawColumns(['employees','manager','department','job_title'])
                    ->make(true);
        } 
    }

    public function myTeamProfileTab(Request $request)
    { 
        $data['title'] = 'My Team';
        $data['team'] =  User::with('department','reportingTo','manager','Image','county')->whereId($request->id)->first();
        $view = view('user.team.components.profile', $data)->render(); 
        return response()->json([
            'success'=> 1, 
            'view' => $view
        ]); 
    }
    
    public function teamProfile($id)
    { 
        $data['title'] = 'Team Profile'; 
        $data['team_emp_id'] = $id;
        $data['uinfo']= $emp = User::find($id);
     //    echo "<pre>";print_r($data);die;

        return view('user.myprofile', $data); 
    }
    
    public function teamProfileTab(Request $request)
    {  
        $tab = $request->tab;
        $userid = $request->team_emp_id;
        $data['title'] = ucfirst($tab); 
        $data['sub_title'] = 'View';

        switch ($tab) {
            case 'profile':
                $data['uinfo'] = User::with('Image')->find($userid);
                $view = 'user.team_tab.employee';
                break;
            case 'skills':
                // $data['employee'] = Skill::with('employee')->where('employee_id', $userid)->get();

                // $userid =  Auth::guard('web')->user()->id;
                $data['employee'] = Skill::with('employee')->where('employee_id',$userid)->get();  
                $data['uinfo']= $emp = User::with('Image')->find($userid);
                $data['skills'] = Skill::where('employee_id',$userid)->get();
                $view = 'user.team_tab.skills';
                break;
            case 'weges&benefits':
                // $data['employee'] = Education::with('employee')->where('employee_id', $userid)->get();
                $data['wageses'] = WagesAndBenefits::where('user_id',$userid)->get(); 
                $view = 'user.team_tab.education';
                break;
            case 'certificate':
                // $data['employee'] = Certificate::with('employee')->where('user_id', $userid)->get();
                $data['certificates'] = Certificate::with('employee')->where('user_id',$userid)->get();
                $view = 'user.team_tab.certificate';
                break;
            case 'language':
                $data['employee'] = User::select('users.*', DB::raw('(SELECT GROUP_CONCAT(languages.name) 
                    FROM languages WHERE FIND_IN_SET(languages.id, users.language_id)) AS language_names'))
                    ->where('id', $userid)->get();
                $data['lans'] = Language::get();
                $view = 'user.team_tab.language';
                break;
            case 'dependents':
                $view = 'user.team_tab.dependents';
                break;
            case 'emergency':
                $data['employee'] = EmergencyContact::where('user_id',$userid)->get();
                $view = 'user.team_tab.emergency';
                break;
            case 'basic_info':
                // $data['uinfo']= $emp = User::find($userid);
                $data['uinfo']= $emp = User::with('county')->find($userid);
                $dob = Carbon::parse($emp->d_o_b);
                $startEmployment = Carbon::parse($emp->employment_start);
                $data['dateOfBirth'] = $dob->format('d-m-Y');
                $data['startEmployment'] = $startEmployment->format('d-m-Y');
                //   echo "<pre>"; print_r($emp->toArray()); die;
                $view = 'user.team_tab.info.basicinfo'; 
            break;
            case 'login_info':
                $data['uinfo']= $emp = User::find($userid);
                $view = 'user.team_tab.info.logininfo'; 
                break;
            default:
               // abort(404); // Handle unknown tabs by returning a 404 error
               return response()->json([
                'success'=> 0, 
                'view' => 'NOT FOUND'
            ]);
        }

        return view($view, $data);
    }


    public function myTraining(Request $request)
    { 
        $data['title'] = 'My Training';
        $userid =  Auth::guard('web')->user()->id;
        return view('user.training.index', $data); 
    }

    public function myPerformance(Request $request)
    { 
        $data['title'] = 'My Performance'; 
        $userid =  Auth::guard('web')->user()->id;
        return view('user.myperformance.index', $data); 
    }

    
    public function myleave(Request $request)
    { 
        $data['title'] = 'My Leave Calendar';
        $userid =  Auth::guard('web')->user()->id; 
        $user = User::with('publicHoliday')->where('id' ,$userid)->first();
        $data['public_holidays'] = Holiday::where('status',1)->get();
        $data['annulLeaveTypes'] = LeaveType::where('status',1)->get();
        $data['leave'] = $leave = LeaveRequest::with('leaveType','leaveSchedules')->where('employee_id' ,$userid)->where('is_leave' ,1)->get();
        $data['lastLeave'] = LeaveRequest::with('leaveType')->where('employee_id' ,$userid)->latest()->first();
        // echo "<pre>"; print_r($data['annulLeaveTypes']->toArray()); die;
        $data['leaveTypes']=$leaveTypes =LeaveType::with(['leaverequest'=> function($query) use($userid) {
            $query->where('employee_id',$userid);
        }])->where('status',1)->get();
               foreach ($leaveTypes as $leaveType) {
            $weekendsCount= $totalDays = $weekendsTotal = $days = 0;
            foreach($leaveType->leaverequest as $leaveRequest){
                $weekendData = $this->countWeekends($leaveRequest->start_date, $leaveRequest->end_date);
                $days = $weekendData['totalDays'];
                $weekends = $weekendData['weekends'];
        
                $totalDays += $days;
                $weekendsTotal += $weekends;
            }
            $leaveType->weekendsCount = $weekendsTotal;
            $leaveType->totalLeavesrequest = $totalDays - $weekendsTotal;
            $leaveType->remainingLeaves = $leaveType->leave_days - $totalDays;
        }    
        $sessionyear = Session::where('is_default', 1)->first();
        // Parse the start and end dates into Carbon instances
        $startDate = Carbon::createFromFormat('m-Y', $sessionyear->start_year)
            ->startOfMonth(); // Set to the first day of the month

        $endDate = Carbon::createFromFormat('m-Y', $sessionyear->end_year)
            ->endOfMonth(); // Set to the last day of the month

        // Generate an array of months with dates in d-m-Y format
        $months = [];
        while ($startDate->lte($endDate)) {
            $months[] = $startDate->format('F'); // 'F' returns the full month name
            $startDate->addMonth(); // Move to the next month
        }

        // Output or return $months as needed
        $data['months'] =  $months;

// Result
// echo '<pre>'; print_r($months);die;

        
        return view('user.myleave.index',$data);
    }
    
    // public function leaveTypeData(Request $request){
    //     $userid =  Auth::guard('web')->user()->id; 
    //    $leaveTypes =LeaveType::with(['leaverequest'=> function($query) use($userid) {
    //         $query->where('employee_id',$userid);
    //     }])->where('status',1)->find($request->id);
        
    //     $weekendsCount= $totalDays = $weekendsTotal = $days = 0;
    //     foreach($leaveTypes->leaverequest as $leaveRequest){
    //         $weekendData = $this->countWeekends($leaveRequest->start_date, $leaveRequest->end_date);
    //         $days = $weekendData['totalDays'];
    //         $weekends = $weekendData['weekends'];
            
    //         $totalDays += $days;
    //         $weekendsTotal += $weekends;
    //     }
    //     $leaveTypes->weekendsCount = $weekendsTotal;
    //     $leaveTypes->totalLeavesrequest = ($totalDays - $weekendsTotal);
    //     $leaveTypes->remainingLeaves = ($leaveTypes->leave_days - ($totalDays - $weekendsTotal));

    //     $view =  view('user.myleave.quicksummary',compact('leaveTypes'))->render();
    //     return response()->json([
    //         'success'=> 1,
    //         'view'=>$view,
    //     ]);
    // }
    
    public function countWeekends($startDate, $endDate)
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        
        $period = CarbonPeriod::create($start, $end);
        $weekends = $totalDays = 0;
        foreach ($period as $date) {
            $totalDays++;
            if ($date->isWeekend()) { 
                $weekends++;
            }
        }

        return [
            'totalDays' => $totalDays,
            'weekends' => $weekends,
        ];
    }

    public function myLeaveSideModal(Request $request,$id)
    { 
        $userid =  Auth::guard('web')->user()->id; 
        $data['title'] = 'Leave Calendar';
        $data['sub_title'] = 'Leave Calendar'; 
        $data['leavedata'] = LeaveRequest::with('user:id,name,reporting_to','leaveType','leaveSchedules')->find($id);
        $data['employee_data'] = User::with('reportingTo')->find($userid); 
       //echo "<pre>";print_r($data['leavedata']);die;
        return view('user.myleave.sidemodal', $data); 
    }

    

    public function myprofile(Request $request)
    { 
        $data['title'] = 'My Profile'; 
        $userid =  Auth::guard('web')->user()->id;
        $data['uinfo']= $emp = User::find($userid);
    //    echo "<pre>";print_r($data);die;

        return view('user.profile.tab.myprofile', $data); 
    }
    public function basicinfo(Request $request)
    { 
        $data['title'] = 'My Profile'; 
        $userid =  Auth::guard('web')->user()->id;
        $data['uinfo']= $emp = User::with('county')->find($userid);
        // echo "<pre>"; print_r($emp->toArray()); die;
        $dob = Carbon::parse($emp->d_o_b);
        $startEmployment = Carbon::parse($emp->employment_start);
        $data['dateOfBirth'] = $dob->format('d-m-Y');
        $data['startEmployment'] = $startEmployment->format('d-m-Y');
        return view('user.profile.info.basicinfo', $data); 
    }
    
    public function loginInfo(Request $request)
    { 
        $data['title'] = 'My Profile'; 
        $userid =  Auth::guard('web')->user()->id;
        $data['uinfo']= $emp = User::find($userid);
       
        return view('user.profile.info.logininfo', $data); 
    }

    public function ResetPassword(Request $request){

        $validated = $request->validate([
            'newpassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newpassword',
            ]);

           $user = User::find(Auth::guard('web')->user()->id);
           $newPassword = Hash::make($request->newpassword);
           $user->password = $newPassword;
           $user->save();

           return response()->json([
            'success'=> 1,
            'message'=>"Password change successfully."
        ]);
    }

   
    
    public function leaveTypeData(Request $request)
    {
        $userid = Auth::guard('web')->user()->id;
    
        $employeeLeave = EmployeeLeaveHistory::with('leaveType')->where('leave_type_id',$request->id)->where('employee_id',$userid)->first();
        
        
        $total_leave_days = $employeeLeave->total_leave_days;
        $booked = $employeeLeave->booked;
        $remaining = $employeeLeave->remaining;
    
    
    
        $totalleavedayinHour = $employeeLeave->total_leave_days*8;
    
        $remainingDays = floor($remaining); 
        $remainingHours = ($remaining - $remainingDays) * 8; 
    
        // Format the output
        $remainingFormatted = "{$remainingDays} days and {$remainingHours} hours";
    
         $total_leave_days = $employeeLeave->total_leave_days;
    
        $view = view('user.myleave.quicksummary', compact('employeeLeave'))->render();
        return response()->json([
            'success' => 1,
            'view' => $view,
        ]);
    }
        
    

    



}
