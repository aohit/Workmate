<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;  
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\{Admin,Department,User,Certificate,Education, EmergencyContact, KeyResult, Language,Skill, UploadFile,WagesAndBenefits,ReviewCycle};
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $userid =  Auth::guard('admin')->user()->id;
        $data['title'] = 'Profile';
        $data['uinfo']= $admin = Admin::with('logoimage','prfileImage')->find($userid); 
        return view('admin.profile.edit',$data);
        
    }


    public function store(Request $request)
    {
        // echo "<pre>"; print_r($request->toArray()); die;
        if($request->id){
            $id = $request->id;
            request()->validate([
                'name' => 'required', 
                'email' => 'required|email',  
                
                ]);
                $admin = Admin::find($request->id);
                if(!empty($request->password) && isset($request->password)){
                    
                    $admin->update([
                        'name' => $request->name,    
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                    ]);     
                }else{
                   
                    $admin->update([
                        'name' => $request->name,    
                        'email' => $request->email, 
                    ]);
                 
                }
           

            return response()->json([
                'success'=> 1,
                'message'=>"Admin Profile Updated successfully."
            ]);
           
        }else{
            request()->validate([
                'name' => 'required', 
                'email' => 'required|unique:admins,email', 
                'password' => 'required|min:8|confirmed', 
               
            ]);

            
            $admin = Admin::create([
                'name' => $request->name,    
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
 
            return response()->json([
                'success'=> 1,
                'message'=>"Admin User created successfully."
            ]);
        }
       
    }

    public function storeImages(Request $request){
        // echo "<pre>"; print_r($request->toArray()); die;

        request()->validate([
            'file_id' => 'required', 
            'system_logo_file_id' => 'required',  
            
            ]);

            $admin = Admin::find($request->id);

                $admin->update([
                    'profile_image' => $request->file_id,    
                    'logo' => $request->system_logo_file_id, 
                ]);

        return response()->json([
            'success'=> 1,
            'message'=>"Admin Profile Updated successfully."
        ]);
    }

    public function imageupload(Request $request)
    {
        $type = $request->type;
        $path = $request->input($type . '_path');
        $name = $request->input($type . '_name');
        $file = $request->file($name);

        if ($file) {
            $ext = $file->getClientOriginalExtension();
            $destinationPath = public_path() . '/' . $path;
            $fileName = time() . "." . $ext;
            $file->move($destinationPath, $fileName);
            $movedFile = $fileName;

            $file_data = UploadFile::create([
                'file' => $movedFile,
            ]);

            return response()->json(['status' => 1, 'file_id' => $file_data->id, 'file_path' => asset($path . $file_data->file)]);
        } else {
            return response()->json(['status' => 0, 'msg' => 'File type not allowed']);
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

    public function myTeam()
    { 
        $data['title'] = 'Employee Directory';
        $data['departments'] = Department::where('status',1)->orderBy('name', 'asc')->get();
        return view('admin.team.index', $data); 
	}

    
     public function departmentTab(Request $request)
    { 
        // print_r($user->department_id);die;
        if ($request->ajax()) {
            $data['department_id'] = $request->id;
            $data['teams'] = User::with('department','manager')->where('department_id',$request->id)->orderby('name','asc')->get();
            $users = User::with('department','manager')->where('department_id', $request->id )->orderby('name','asc')->get();
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
            }else{
                return response()->json([
                    'success'=> 0, 
                    'view' => 'Not Found'
                ]);
            }
            
        }
    }

    public function myTeamList(Request $request)
    { 
        $dep_id = $_POST['department_id'];
        
        if ($request->ajax()) {
            $data = User::with('department','manager','Image')->where('department_id', $dep_id )->get(); 
            return DataTables::of($data)
                    ->addIndexColumn()
                         ->addColumn('employees', function($row){ 
                        if(isset($row->Image->file) && $row->Image->file != ''){
                            $image_url = url('/upload/employee/' . $row->Image->file);
                        }else{
                            $image_url = url('assets/images/users/user-1.jpg');
                        }
                        if(isset($row->Image->file) && $row->Image->file != ''){
                            $image_url = url('/upload/employee/' . $row->Image->file);
                        }else{
                            $image_url = url('assets/images/users/user-1.jpg');
                        }
                        $detail = '<div class="inbox-item  m-0 p-0 d-flex">
                        <a href="javascript:void(0);" onclick="profileDetail('.$row->id.')">
                            <div class="inbox-item-img">
                            <img src="'.( $image_url ).'" class=" rounded-circle" style="height: 40px; width: 40px;" style="border-radius: 50%;">

                            </div>
                            <div class="details mx-2">
                            <h6 class="inbox-item-author" style="font-size: 14px;">'.ucfirst($row->name).'</h6>
                            <p class="inbox-item-text m-0 p-0" style=" color: cadetblue;">'.$row->email.'</p>
                            <div>
                        </a>
                    </div>'; 

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
                        // return '<a href="javascript:void(0);" onclick="profileDetail('.$row->id.')">'  . ucfirst($row->job_title ?? 'Na') .  '</a>'; 
                        $job_title = ucfirst($row->job_title ?? 'N/A');
                        $details = '
                            <a href="javascript:void(0);" onclick="profileDetail('.$row->id.')" style="color: inherit; text-decoration: none; display: block;">
                                <div>
                                    '.$job_title.'
                                </div>
                            </a>
                        ';
                        return $details;
                    })

                    ->rawColumns(['employees','department','manager','job_title'])
                    ->make(true);
        } 
    }
    
    public function myTeamProfileTab(Request $request)
    { 
        $data['title'] = 'My Team';
          $data['team'] =  User::with('department','manager','Image','county')->whereId($request->id)->first();
        $view = view('admin.team.components.profile', $data)->render(); 
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

        return view('admin.myprofile', $data); 
    }
    
        public function teamProfileTab(Request $request)
    {   $tab = $request->tab;
        $userid = $request->team_emp_id;
        $data['title'] = ucfirst($tab); 
        $data['sub_title'] = 'View';

        switch ($tab) {
            case 'profile':
                $data['uinfo'] = User::with('Image')->find($userid);
                $view = 'admin.team_tab.employee';
                break;
                case 'skills':
                    $data['employee'] = Skill::with('employee')->where('employee_id',$userid)->get();  
                    $data['uinfo']= $emp = User::with('Image')->find($userid);
                    $data['skills'] = Skill::where('employee_id',$userid)->get();
                    // $data['employee'] = Skill::with(' ')->where('employee_id', $userid)->get();
                    // echo "<pre>";print_r($data['employee']->toArray());die;
                    // echo "<pre>";print_r($userid);die;
                    $view = 'admin.team_tab.skills';
                    break;
                case 'education':
                    $data['wageses'] = WagesAndBenefits::where('user_id',$userid)->get();  
                    // $data['employee'] = Education::with('employee')->where('employee_id', $userid)->get();
                    $view = 'admin.team_tab.education';
                    break;
                case 'certificate':
                    $data['certificates'] = Certificate::with('employee')->where('user_id', $userid)->get();
                    $view = 'admin.team_tab.certificate';
                    break;
            // case 'language':
            //     $data['employee'] = User::select('users.*', DB::raw('(SELECT GROUP_CONCAT(languages.name) 
            //         FROM languages WHERE FIND_IN_SET(languages.id, users.language_id)) AS language_names'))
            //         ->where('id', $userid)->get();
            //     $data['lans'] = Language::get();
            //     $view = 'admin.team_tab.language';
            //     break;
            // case 'dependents':
            //     $view = 'admin.team_tab.dependents';
            //     break;
            case 'emergency':
                $data['employee'] = EmergencyContact::where('user_id',$userid)->get();
                $view = 'admin.team_tab.emergency';
                break;
            case 'basic_info':
                $data['uinfo']= $emp = User::find($userid);
                $view = 'admin.team_tab.info.basicinfo'; 
            break;
            case 'login_info':
                $data['uinfo']= $emp = User::find($userid);
                $view = 'admin.team_tab.info.logininfo'; 
                break;
            default:
               // abort(404); // Handle unknown tabs by returning a 404 error
               return response()->json([
                'success'=> 0, 
                'view' => 'nOT FOUND'
            ]);
        }

        return view($view, $data);
    }
    
    //     public function adminGoalOverView(Request $request)
    // {
    //     $title = 'Team Overview';
    //     $users = User::with('goalOverview','goalStatus')
    //         ->get();
    //     $goalCount = 0;

    //     // echo "<pre>";print_r($users->toArray());die;
    //     foreach ($users as $user) {
    //         $goalCount = $user->goaloverview->count();
    //         $arr = $count = $goalpailabel = $backgroundcolor  = [];
    //         $TotalProgressBar = $progress = $totalOfKey = $thisWeekDueCount = $totalDueCount = 0;
    //         foreach ($user->goaloverview as $Goals) {
    //             $key = $Goals->goalStatus->title;
    //             $bgkey = $Goals->goalStatus->background_color;
    //             $arr[$key][] = $Goals->id;
    //             $count[$key] = round((count($arr[$key]) * 100) / $goalCount);
    //             if($Goals->totalprogressbar  != 'NaN'){
    //                 $TotalProgressBar += $Goals->totalprogressbar;
    //                 }
    //             $goalpailabel[] = $key;
    //             $backgroundcolor[] = $bgkey;
    //             $totalOfKey += count($Goals->keyresult);
    //             $now = Carbon::now();
    //             $deadline = Carbon::parse($Goals->deadline);
    //             if ($deadline->isSameWeek($now)) {
    //                 $thisWeekDueCount++;
    //             }
    //             if ($deadline->lessThanOrEqualTo($now)) {
    //                 $totalDueCount++;
    //             }
    //         }
    //         $keyResults = KeyResult::with('goal.goalStatus')->whereHas('goal', function ($query) use ($user) {
    //                 $query->where('user_id', $user->id);
    //             })->orderBy('updated_at', 'desc')->take(4)->get();

                
                
    //             $progress = round($goalCount > 0 ? ($TotalProgressBar * 100) / ($goalCount * 100) : 0);
    //             $totalProgress = round($totalOfKey > 0 ? ($TotalProgressBar * 100) / ($totalOfKey * 100) : 0);
    //             $user->totalProgress = $totalProgress;
    //             $user->totalOfKey = $totalOfKey;
    //             $user->thisWeekDueCount = $thisWeekDueCount;
    //             $user->totalDueCount = $totalDueCount;
    //             $user->progress = $progress;
    //             $user->goalpie = $count;
    //             $user->goalpailabel = array_values(array_unique($goalpailabel));
    //             $user->paibackgroundcolor = array_values(array_unique($backgroundcolor));
    //             $user->keyResults = $keyResults;
    //         }

    //     // echo "<pre>"; print_r($users->toArray()); die;
    //     return view('admin.goal.goaloverview', compact('users', 'title'));
    // }
    
    
    
    // public function adminGoalOverView(Request $request)
    // {    
        
    //     $title = 'Goal Overview';
        
    //    if(isset($_GET['department'])){
    //         $departmentId = $_GET['department'];
    //     }else{
    //         $departmentId = '';
    //     }
       
    //     $username = $request->get('username');
    
    //     $query = User::with('goalOverview', 'goalStatus');
    //     if (!empty($departmentId)) {
    //         $query->where('department_id', $departmentId);
    //     }
    //     if (!empty($username)) {
    //         $query->where('name', 'like', '%' . $username . '%');
    //     }
    //     $users = $query->get();
    
    //     $departments = Department::get();
    //     $goalCount = 0;
    
    //     foreach ($users as $user) {
    //         $goalCount = $user->goaloverview->count();
    //         $arr = $count = $goalpailabel = $backgroundcolor = [];
    //         $TotalProgressBar = $progress = $totalOfKey = $thisWeekDueCount = $totalDueCount = 0;
    
    //         foreach ($user->goaloverview as $Goals) {
    //             $key = $Goals->goalStatus->title;
    //             $bgkey = $Goals->goalStatus->background_color;
    //             $arr[$key][] = $Goals->id;
    //             $count[$key] = round((count($arr[$key]) * 100) / $goalCount);
    //             if ($Goals->totalprogressbar != 'NaN') {
    //                 $TotalProgressBar += $Goals->totalprogressbar;
    //             }
    //             $goalpailabel[] = $key;
    //             $backgroundcolor[] = $bgkey;
    //             $totalOfKey += count($Goals->keyresult);
    //             $now = Carbon::now();
    //             $deadline = Carbon::parse($Goals->deadline);
    //             if ($deadline->isSameWeek($now)) {
    //                 $thisWeekDueCount++;
    //             }
    //             if ($deadline->lessThanOrEqualTo($now)) {
    //                 $totalDueCount++;
    //             }
    //         }
    
    //         $keyResults = KeyResult::with('goal.goalStatus')->whereHas('goal', function ($query) use ($user) {
    //             $query->where('user_id', $user->id);
    //         })->orderBy('updated_at', 'desc')->take(4)->get();
    
    //         $progress = round($goalCount > 0 ? ($TotalProgressBar * 100) / ($goalCount * 100) : 0);
    //         $totalProgress = round($totalOfKey > 0 ? ($TotalProgressBar * 100) / ($totalOfKey * 100) : 0);
    //         $user->totalProgress = $totalProgress;
    //         $user->totalOfKey = $totalOfKey;
    //         $user->thisWeekDueCount = $thisWeekDueCount;
    //         $user->totalDueCount = $totalDueCount;
    //         $user->progress = $progress;
    //         $user->goalpie = $count;
    //         $user->goalpailabel = array_values(array_unique($goalpailabel));
    //         $user->paibackgroundcolor = array_values(array_unique($backgroundcolor));
    //         $user->keyResults = $keyResults;
    //     }
    
    //     // if ($request->ajax()) {
    //     //     return  view('admin.goal.partial_goal_overview', compact('users','title', 'departments'))->render();
    //     // }
    
    //     return view('admin.goal.goaloverview', compact('users', 'title', 'departments'));
    // }
    
    
    //  public function userSearch(Request $request)
    // {   // echo "<pre>";print_r($request->toArray());

    //     $username = $request->username;
    //     $department = $request->department;

    //     $title = 'Goal Overview';
       
    //     if(isset($_GET['department'])){
    //         $departmentId = $_GET['department'];
    //     }else{
    //         $departmentId = '';
    //     }

    //     $username = $request->get('username');
    
    
    //     $query = User::with('goalOverview', 'goalStatus');
    //     if (!empty($department)) {
    //         $query->where('department_id', $department);
    //     }
    //     if (!empty($username)) {
    //         $query->where('name', 'like', '%' . $username . '%');
    //     }
     
    //     $users = $query->get();
    
    //     $departments = Department::get();
    //     $goalCount = 0;

    //     foreach ($users as $user) {
    //         $goalCount = $user->goaloverview->count();
    //         $arr = $count = $goalpailabel = $backgroundcolor = [];
    //         $TotalProgressBar = $progress = $totalOfKey = $thisWeekDueCount = $totalDueCount = 0; 
    //         foreach ($user->goaloverview as $Goals) {
    //             $key = $Goals->goalStatus->title;
    //             $bgkey = $Goals->goalStatus->background_color;
    //             $arr[$key][] = $Goals->id;
    //             $count[$key] = round((count($arr[$key]) * 100) / $goalCount);
    //             if ($Goals->totalprogressbar != 'NaN') {
    //                 $TotalProgressBar += $Goals->totalprogressbar;
    //             }
    //             $goalpailabel[] = $key;
    //             $backgroundcolor[] = $bgkey;
    //             $totalOfKey += count($Goals->keyresult);
    //             $now = Carbon::now();
    //             $deadline = Carbon::parse($Goals->deadline);
    //             if ($deadline->isSameWeek($now)) {
    //                 $thisWeekDueCount++;
    //             }
    //             if ($deadline->lessThanOrEqualTo($now)) {
    //                 $totalDueCount++;
    //             }
    //         }
    //         $keyResults = KeyResult::with('goal.goalStatus')->whereHas('goal', function ($query) use ($user) {
    //             $query->where('user_id', $user->id);
    //         })->orderBy('updated_at', 'desc')->take(4)->get();
    
    //         $progress = round($goalCount > 0 ? ($TotalProgressBar * 100) / ($goalCount * 100) : 0);
    //         $totalProgress = round($totalOfKey > 0 ? ($TotalProgressBar * 100) / ($totalOfKey * 100) : 0);
    //         $user->totalProgress = $totalProgress;
    //         $user->totalOfKey = $totalOfKey;
    //         $user->thisWeekDueCount = $thisWeekDueCount;
    //         $user->totalDueCount = $totalDueCount;
    //         $user->progress = $progress;
    //         $user->goalpie = $count;
    //         $user->goalpailabel = array_values(array_unique($goalpailabel));
    //         $user->paibackgroundcolor = array_values(array_unique($backgroundcolor));
    //         $user->keyResults = $keyResults;
    //     }
    

    // return view('admin.goal.user_goal_overview' , compact('users', 'title', 'departments','username','department'));
    // }

    public function adminGoalOverView(Request $request)
    {    
        $title = 'Goal Overview';
       
        if(isset($_GET['department'])){
            $departmentId = $_GET['department'];
        }else{
            $departmentId = '';
        }

        $username = $request->get('username');
    
    
        $query = User::with('goalOverview', 'goalStatus');
        if (!empty($departmentId)) {
            $query->where('department_id', $departmentId);
        }
        if (!empty($username)) {
            $query->where('name', 'like', '%' . $username . '%');
        }
     
        $users = $query->get();
    
        $departments = Department::where('status',1)->get();
        $reviewCycles = ReviewCycle::where('status',1)->get();
        $goalCount = 0;

        foreach ($users as $user) {
            $goalCount = $user->goaloverview->count();
            $arr = $count = $goalpailabel = $backgroundcolor = [];
            $TotalProgressBar = $progress = $totalOfKey = $thisWeekDueCount = $totalDueCount = 0; 
            foreach ($user->goaloverview as $Goals) {
                $key = $Goals->goalStatus->title;
                $bgkey = $Goals->goalStatus->background_color;
                $arr[$key][] = $Goals->id;
                $count[$key] = round((count($arr[$key]) * 100) / $goalCount);
                if ($Goals->totalprogressbar != 'NaN') {
                    $TotalProgressBar += $Goals->totalprogressbar;
                }
                $goalpailabel[] = $key;
                $backgroundcolor[] = $bgkey;
                $totalOfKey += count($Goals->keyresult);
                $now = Carbon::now();
                $deadline = Carbon::parse($Goals->deadline);
                if ($deadline->isSameWeek($now)) {
                    $thisWeekDueCount++;
                }
                if ($deadline->lessThanOrEqualTo($now)) {
                    $totalDueCount++;
                }
            }
            $keyResults = KeyResult::with('goal.goalStatus')->whereHas('goal', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->orderBy('updated_at', 'desc')->take(4)->get();
    
            $progress = round($goalCount > 0 ? ($TotalProgressBar * 100) / ($goalCount * 100) : 0);
            $totalProgress = round($totalOfKey > 0 ? ($TotalProgressBar * 100) / ($totalOfKey * 100) : 0);
            $user->totalProgress = $totalProgress;
            $user->totalOfKey = $totalOfKey;
            $user->thisWeekDueCount = $thisWeekDueCount;
            $user->totalDueCount = $totalDueCount;
            $user->progress = $progress;
            $user->goalpie = $count;
            $user->goalpailabel = array_values(array_unique($goalpailabel));
            $user->paibackgroundcolor = array_values(array_unique($backgroundcolor));
            $user->keyResults = $keyResults;
        }
    
        // if ($request->ajax()) {
        //     return  view('admin.goal.partial_goal_overview', compact('users','title', 'departments'))->render();
        // }
    
        return view('admin.goal.goaloverview', compact('users', 'title', 'departments','reviewCycles'));
    }

    public function userSearch(Request $request)
    {
        $username = $request->username;
        $department = $request->department;
    
        $title = 'Goal Overview';
    
        $departmentId = $request->get('department', '');
        $reviewcycleID = $request->get('reviewcycle', '');
    
        $query = User::with(['goalOverview' => function ($query) use ($reviewcycleID) {
            if (!empty($reviewcycleID)) {
                $query->where('review_cycle', $reviewcycleID);
            }
        }, 'goalStatus']);
    
        if (!empty($departmentId)) {
            $query->where('department_id', $departmentId);
        }
    
        if (!empty($username)) {
            $query->where('name', 'like', '%' . $username . '%');
        }
    
        $users = $query->get();
        $departments = Department::where('status',1)->get();
        $reviewCycles = ReviewCycle::where('status',1)->get();
        $goalCount = 0;
    
        foreach ($users as $user) {
            $goalCount = $user->goalOverview->count();
            $arr = $count = $goalpailabel = $backgroundcolor = [];
            $TotalProgressBar = $progress = $totalOfKey = $thisWeekDueCount = $totalDueCount = 0;
    
            foreach ($user->goalOverview as $Goals) {
                $key = $Goals->goalStatus->title;
                $bgkey = $Goals->goalStatus->background_color;
                $arr[$key][] = $Goals->id;
                $count[$key] = round((count($arr[$key]) * 100) / $goalCount);
                if ($Goals->totalprogressbar != 'NaN') {
                    $TotalProgressBar += $Goals->totalprogressbar;
                }
                $goalpailabel[] = $key;
                $backgroundcolor[] = $bgkey;
                $totalOfKey += count($Goals->keyresult);
                $now = Carbon::now();
                $deadline = Carbon::parse($Goals->deadline);
                if ($deadline->isSameWeek($now)) {
                    $thisWeekDueCount++;
                }
                if ($deadline->lessThanOrEqualTo($now)) {
                    $totalDueCount++;
                }
            }
    
            if ($reviewcycleID) {
                $keyResults = KeyResult::with(['goal' => function ($query) use ($reviewcycleID) {
                    $query->where('review_cycle', $reviewcycleID)
                        ->with('goalStatus');
                }])->whereHas('goal', function ($query) use ($user, $reviewcycleID) {
                    $query->where('user_id', $user->id)
                        ->where('review_cycle', $reviewcycleID);
                })->orderBy('updated_at', 'desc')->take(4)->get();
            } else {
                $keyResults = KeyResult::with('goal.goalStatus')->whereHas('goal', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->orderBy('updated_at', 'desc')->take(4)->get();
            }
    
            $progress = round($goalCount > 0 ? ($TotalProgressBar * 100) / ($goalCount * 100) : 0);
            $totalProgress = round($totalOfKey > 0 ? ($TotalProgressBar * 100) / ($totalOfKey * 100) : 0);
            $user->totalProgress = $totalProgress;
            $user->totalOfKey = $totalOfKey;
            $user->thisWeekDueCount = $thisWeekDueCount;
            $user->totalDueCount = $totalDueCount;
            $user->progress = $progress;
            $user->goalpie = $count;
            $user->goalpailabel = array_values(array_unique($goalpailabel));
            $user->paibackgroundcolor = array_values(array_unique($backgroundcolor));
            $user->keyResults = $keyResults;
        }
    
        return view('admin.goal.user_goal_overview', compact('users', 'title', 'departments', 'username', 'department', 'reviewCycles'));
    }
}
