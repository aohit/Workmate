<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;  
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\{Department, User,LeaveRequest};
use App\Models\Document; 
use Illuminate\Support\Facades\Hash;
use DataTables;
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    { 
        $data['title'] = 'My Dashboard';
        $userid =  Auth::guard('web')->user()->id;
        $data['uinfo']= $emp = User::find($userid);
        return view('user.profile.edit',$data); 
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

    // public function myTeam(Request $request)
    // { 
    //     $data['title'] = 'My Team';
    //     $userid =  Auth::guard('web')->user()->id;
    //     return view('user.team.index', $data); 
    // }

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
        // return view('user.myleave.index', $data); 
        $currentYear = Carbon::now('America/New_York')->year; 
        $months = [];

        for ($i = 1; $i <= 12; $i++) {
            $months[] = Carbon::create($currentYear, $i);

        }

        $data['leave'] = LeaveRequest::where('employee_id' ,$userid)->get();

        // echo "<pre>";print_r($data);die;
        return view('user.myleave.index', compact('months', 'currentYear'),$data);
      
    }

    

    public function myprofile(Request $request)
    { 
        $data['title'] = 'My Profile'; 
        $userid =  Auth::guard('web')->user()->id;
        $data['uinfo']= $emp = User::find($userid);
       
        
        return view('user.profile.tab.myprofile', $data); 
    }

    


    public function employeesProfile(Request $request)
    {
        $data['title'] = 'My Profile'; 
        $userid =  Auth::guard('web')->user()->id;
        $data['uinfo']= $emp = User::find($userid);
        // $tabId = $request->input('tab_id');

        // echo "RR";die;
        return view('user.profile.tab.employee',$data); 

    }


    
    public function empSkills(Request $request)
    {
        $data['title'] = 'My Profile'; 
        $userid =  Auth::guard('web')->user()->id;
        $data['uinfo']= $emp = User::find($userid);
        // $tabId = $request->input('tab_id');

        // echo "RR";die;
        return view('user.profile.tab.employee',$data); 

    }

    public function myTeam()
    { 
        $data['title'] = 'My Team';
        $userid =  Auth::guard('web')->user()->department_id;
        $data['departments'] = Department::orderBy('name', 'asc')->where('id',$userid)->get();
        return view('user.team.index', $data); 
    }

    public function departmentTab(Request $request)
    { 
        // print_r($user->department_id);die;
        if ($request->ajax()) {
            $data['department_id'] = $request->id;
            $data['teams'] = User::with('department','reportingTo','manager')->where('department_id',$request->id)->get();
            $users = User::with('department','reportingTo','manager')->where('department_id', $request->id )->get();
            $i=1;
            foreach($users as $val){
                if($i==1){
                $data['user_id'] = $val->id;
                }
                $i++;
            }
            $view = view('admin.team.components.tabs', $data)->render();  
            return response()->json([
                'success'=> 1, 
                'view' => $view
            ]);
        }
    }

    public function myTeamList(Request $request)
    { 
        $user =  Auth::guard('web')->user();
        $dep_id = $_POST['department_id'];
        
        if ($request->ajax()) {
            if($user->department_id == 2){
                $data = User::with('department','reportingTo','manager')->where('department_id', $dep_id )->get(); 
            }else{
                $data = User::with('department','reportingTo','manager')->where('department_id',$user->department_id)->get(); 
            }
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('employees', function($row){ 
                        $detail = '<div class="inbox-widget">
                                        <div class="inbox-item">
                                            <a href="javascript:void(0);" onclick="profileDetail('.$row->id.')">
                                                <div class="inbox-item-img"><img src="'.asset('assets/images/users/user-1.jpg').'" class="rounded-circle" alt=""></div>
                                                <h5 class="inbox-item-author mt-0 mb-1">'.$row->name.'</h5>
                                                <p class="inbox-item-text">'.$row->email.'</p>
                                            </a>
                                        </div> 
                                    </div>';

                        return $detail;
                    })
                    ->addColumn('department', function($row){ 
                        $department = $row->department->name; 
                        return '<span class="badge bg-secondary rounded-circle-1 noti-icon-badge"> Team</span> '.$department;
                    })
                    ->addColumn('manager', function($row){ 
                        $department = $row->manager->name; 
                        return $department;
                    })

                    ->rawColumns(['employees','department'])
                    ->make(true);
        } 
    }

    public function myTeamProfileTab(Request $request)
    { 
        $data['title'] = 'My Team';
        $data['team'] =  User::with('department','reportingTo','manager')->whereId($request->id)->first();
        $view = view('user.team.components.profile', $data)->render(); 
        return response()->json([
            'success'=> 1, 
            'view' => $view
        ]); 
    }

		




}
