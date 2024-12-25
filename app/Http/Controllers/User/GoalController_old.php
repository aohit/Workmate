<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\{Activity, ActivityLog, Goal, GoalCategory, GoalStatus, KeyResult, ReviewCycle, User,Department};  
use App\Models\Role; 
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Hash; 
use Carbon\Carbon;
use DataTables;
use Dompdf\Dompdf;
use Dompdf\Options;
// use Barryvdh\DomPDF\Facade as PDF;
use PDF;
use function PHPUnit\Framework\arrayHasKey;



class GoalController extends Controller
{
    /**
     * Display the login view.
     */

    function __construct()
    {
        
    }


     public function getPdf(Request $request)
    {
        $data['title'] = 'Goal';
        $data['sub_title'] = 'Goal List';
        $userid =  Auth::guard('web')->user()->id;
        $qry = User::where('id', $userid)->first();
        $goals = Goal::get();
        $pdf = PDF::loadView('user.pdf.mygoals', ['uinfo' => $qry, 'info' => $goals]);
        return $pdf->download('mygoals.pdf');
    }



 public function indexs($id)
    {
        $data['title'] = 'My Goals';
        $data['sub_title'] = 'Goal List';
        $userid = base64_decode($id);
        $data['goals'] = Goal::where('user_id', $userid)->get();
        $data['uinfo'] = User::with('Image', 'department')->find($userid);

        return view('user.goal.index', $data);
    }

 
 public function list(Request $request)
    {
        if ($request->ajax()) {


            $data = Goal::with('goalStatus', 'goalCategory', 'reviewCycle')->where('user_id',$request->id)->get();
            //   echo "<pre>"; print_r($data->toArray()); die;
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('title', function ($row) {
                    $title =  $row->title;
                    return $title;
                })
                ->addColumn('review_cycle', function ($row) {
                    $data = $row->reviewCycle->title;
                    return $data;
                })

                ->addColumn('type', function ($row) {
                    $data = $row->type;
                    return $data;
                })

                ->addColumn('status', function ($row) {

                    $status =   '<button type="button" class="btn btn-xs rounded-pill" style="background-color:' . $row->goalStatus->background_color . '; color:' . $row->goalStatus->label_color . '">' . $row->goalStatus->title . '</button>';

                    return $status;
                })
                ->addColumn('progressbar', function ($row) {

                    $progrebar = '<div class="progress mb-0">
                            <div class="progress-bar" role="progressbar" style="width: ' . $row->totalprogressbar . '%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">' . $row->totalprogressbar . '%' . '</div>
                        </div>';
                    return $progrebar;
                })

                ->addColumn('duedate', function ($row) {

                    $duedate =   $row->deadline;

                    return $duedate;
                })

                ->addColumn('action', function ($row) {

                    $editUrl = route('goal.update', base64_encode($row->id));
                    $deleteUrl = route('goal.delete');
                    $showUrl = route('goal.show');


                    $action =  '<a href="' . $editUrl . '"  class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Edit</a>&nbsp;&nbsp;&nbsp;';
                    // $action .=  '<button type="button" onclick = showForm(this,"'.$row->id.'","'. $showUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Show</button>&nbsp;&nbsp;&nbsp;';
                    $action .=  '<button type="button" onclick = deleteRow(this,"' . $row->id . '","' . $deleteUrl . '") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Delete</button>&nbsp;&nbsp;&nbsp;';
                    $action .=  '<button type="button" title="Activity" onclick = activities("' . $row->id . '") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1"><i class="mdi mdi-history"></i></button>&nbsp;&nbsp;&nbsp;';
                    return $action;
                })

                ->rawColumns(['title', 'status', 'review_cycle', 'progressbar', 'action', 'duedate', 'type'])
                ->make(true);
        }
    }

    public function create(Request $request)
    {
        $data['title'] = 'Add Goals';
        $data['sub_title'] = 'Create';
        $data['roles'] = Role::get();
        $data['goalstatuses'] = GoalStatus::where('status', 1)->get();
        $data['goalcategories'] = GoalCategory::where('status', 1)->get();
        $data['reviewcycles'] = ReviewCycle::where('status', 1)->get();
        $data['userId'] = $userId = base64_decode($request->id);
        $userManager = User::where('manager_id', $userId)->get();
        if (count($userManager) > 0) {
            return view('user.goal.createmanager', $data);
        }
        return view('user.goal.create', $data);
    }

    public function GoalKey(Request $request)
    {
        $data['title'] = 'Add Goal';
        $data['sub_title'] = 'Add Key Result';
        $data['time'] = $request->time;
        return view('user.goal.createkeyresult', $data);
    }

    public function EditGoalKey(Request $request)
    {
        $data['title'] = 'Update Goal';
        $data['sub_title'] = 'Update Key Result';
        $data['keyresult'] = KeyResult::find($request->id);
        $data['time'] = $request->time;
        return view('user.goal.editkeyresult', $data);
    }

    public function updateKeyHistory($table, $requestData)
    {

        $createActitive = Activity::create([
            'date' => date('Y-m-d'),
            'user_id' => Auth::guard('web')->user()->id,
            'goal_id' => $table->goal_id,
            'title' => "update this entry",
        ]);

        if ($table->title != $requestData->title) {
            $activities = ['Key result' => $table->title, 'Title' => $requestData->title];

            foreach ($activities as $key => $value) {
                ActivityLog::create([
                    'data_key' => $key,
                    'data_value' => $value,
                    'old_vaue' => $table->title,
                    'activiy_id' => $createActitive->id
                ]);
            }
        }

        if ($table->traking_status  !=  $requestData->completprogess) {
            if ($requestData->completprogess == 1) {
                $status  = "Completed";
            } else {
                $status  = "Pending";
            }
            if ($table->traking_status == 1) {
                $oldstatus  = "Completed";
            } else {
                $oldstatus  = "Pending";
            }
            $activities = ['Key result' => $requestData->title, 'Traking' => $status];

            foreach ($activities as $key => $value) {
                ActivityLog::create([
                    'data_key' => $key,
                    'data_value' => $value,
                    'old_vaue' => $oldstatus,
                    'activiy_id' => $createActitive->id
                ]);
            }
        }
        $trakings = false;
        if ($table->traking != $requestData->traking) {

            if ($requestData->traking == 'Quantifiable traget') {

                $keyActivities = ['Key Result' => $requestData->title, 'Tracking' => $requestData->traking, 'Start' => $requestData->start, 'Target' => $requestData->target, 'Current' => $requestData->current];
            } elseif ($requestData->traking == 'Milestone') {

                if ($requestData->traking_status == 1) {

                    $tradingstatus = 'Completed';
                } else {

                    $tradingstatus = 'Pending';
                }

                $keyActivities = ['Key Result' => $requestData->title, 'Tracking' => $requestData->traking, 'Traking' => $tradingstatus];
            }

            foreach ($keyActivities as $key => $value) {

                ActivityLog::create([
                    'data_key' => $key,
                    'data_value' => $value,
                    'activiy_id' => $createActitive->id
                ]);
            }
            $trakings = true;
        }

        if ($table->target != $requestData->target && $trakings == false && $requestData->traking == 'Quantifiable traget') {

            $activities = ['Key result' => $table->title, 'Target' => $requestData->target];
            foreach ($activities as $key => $value) {

                ActivityLog::create([
                    'data_key' => $key,
                    'data_value' => $value,
                    'old_vaue' => $table->target,
                    'activiy_id' => $createActitive->id
                ]);
            }
        }

        if ($table->current != $requestData->current && $trakings == false && $requestData->traking == 'Quantifiable traget') {

            $activities = ['Key result' => $table->title, 'Current' => $requestData->current];

            foreach ($activities as $key => $value) {
                ActivityLog::create([
                    'data_key' => $key,
                    'data_value' => $value,
                    'old_vaue' => $table->current,
                    'activiy_id' => $createActitive->id
                ]);
            }
        }

        if ($table->start != $requestData->start && $trakings == false && $requestData->traking == 'Quantifiable traget') {

            $activities = ['Key result' => $table->title, 'Current' => $requestData->current];

            foreach ($activities as $key => $value) {
                ActivityLog::create([
                    'data_key' => $key,
                    'data_value' => $value,
                    'old_vaue' => $table->start,
                    'activiy_id' => $createActitive->id
                ]);
            }
        }
    }

    public function StoreGoalKey(Request $request)
    {
        if ($request->id) {

            $validation = [
                'title' => 'required',
                'traking' => 'required',
            ];

            if ($request->traking == "Quantifiable traget") {
                $validation = [
                    'target' => 'required',
                ];
            }
            $request->validate($validation);

            if ($request->traking == "Milestone") {
                $target = 100;
                if (isset($request->completprogess)) {

                    $current = 100;
                } else {
                    $current = 0;
                }
                $start = 0;
            } else {
                $target = $request->target;
                $current = $request->current;
                $start = $request->start;
            }

            $totalProgress = (($current - $start) / ($target - $start)) * 100;

            $data = KeyResult::find($request->id);

            $this->updateKeyHistory($data, $request);

            $data->update([
                'title' => $request->title,
                'traking' => $request->traking,
                'traking_status' => $request->completprogess,
                'target' => $target,
                'start' => $start,
                'current' => $current,
                'time' => $request->time,
                'total_progress' => $totalProgress,
            ]);

            $keyresults = KeyResult::where('time', $request->time)->get();

            $view = view('user.goal.key.keyresultshow', compact('keyresults'))->render();

            return response()->json([
                'success' => 1,
                'message' => "Key Update successfully.",
                'view' => $view,
            ]);
        } else {
            $validation = [
                'title' => 'required',
                'traking' => 'required',
            ];

            if ($request->traking == "Quantifiable traget") {
                $validation = [
                    'target' => 'required',
                ];
            }
            $request->validate($validation);

            if ($request->traking == "Milestone") {
                $target = 100;
                if (isset($request->completprogess)) {

                    $current = 100;
                } else {
                    $current = 0;
                }
                $start = 0;
            } else {
                $target = $request->target;
                $current = $request->current;
                $start = $request->start;
            }
            $totalProgress = (($current - $start) / ($target - $start)) * 100;
            $totalpro = round($totalProgress);
            $data = KeyResult::create([
                'title' => $request->title,
                'traking' => $request->traking,
                'traking_status' => $request->completprogess,
                'target' => $target,
                'start' => $start,
                'current' => $current,
                'time' => $request->time,
                'total_progress' => $totalpro,
            ]);

            $createActitive = Activity::create([
                'date' => date('Y-m-d'),
                'user_id' => Auth::guard('web')->user()->id,
                'time' => $request->time,
                'title' => "update this entry",
            ]);


            if ($request->traking == 'Milestone') {
                if ($request->traking == 1) {
                    $tradingstatus = 'Completed';
                } else {
                    $tradingstatus = 'Pending';
                }
                $keyActivities = ['Key Result' => $request->title, 'Tracking' => $request->traking, 'Traking' => $tradingstatus];
            } elseif ($request->traking == 'Quantifiable traget') {

                $keyActivities = ['Key Result' => $request->title, 'Tracking' => $request->traking, 'Start' => $request->start, 'Target' => $request->target, 'Current' => $request->current];
            }

            foreach ($keyActivities as $key => $value) {

                ActivityLog::create([
                    'data_key' => $key,
                    'data_value' => $value,
                    'activiy_id' => $createActitive->id
                ]);
            }

            $keyresults = KeyResult::where('time', $request->time)->get();

            $view = view('user.goal.key.keyresultshow', compact('keyresults'))->render();

            return response()->json([
                'success' => 1,
                'message' => "Key created successfully.",
                'view' => $view,
            ]);
        }
    }

    public function deleteGoalKey(Request $request)
    {

        $data = KeyResult::find($request->id);
        $time = $data->time;
        $data->delete();
        $keyresults = KeyResult::where('time', $time)->get();

        $view = view('user.goal.key.keyresultshow', compact('keyresults'))->render();
        return response()->json([
            'success' => 1,
            'message' => "Goal Key deleted successfully.",
            'view' => $view
        ]);
    }

    public function update(Request $request, $id): View
    {
         $id = base64_decode($id);
        $data['title'] = 'My Goals';
        $data['sub_title'] = 'Update';
        $data['goal'] = $goal = Goal::find($id);
        $data['userId'] =  $goal->user_id;
        // echo "<pre>"; print_r($goal->toArray()); die;
        $data['goalstatuses'] = GoalStatus::where('status', 1)->get();
        $data['goalcategories'] = GoalCategory::where('status', 1)->get();
        $data['reviewcycles'] = ReviewCycle::where('status', 1)->get();
        $data['keyresults'] = KeyResult::where('goal_id', $id)->get();
        $userManager = User::where('manager_id', $goal->user_id)->get();
        if (count($userManager) > 0) {
            return view('user.goal.updatemanager', $data);
        }

        return view('user.goal.update', $data);
    }


    public function show(Request $request): View
    {
        $data['title'] = 'Goal';
        $data['sub_title'] = 'View';
        $data['goal'] = Goal::with('role')->find($request->id);
        return view('user.goal.show', $data);
    }

    public function store(Request $request)
    {

        if ($request->id) {

            request()->validate([
                'title' => 'required',
                'status' => 'required',
                'reviewcycle' => 'required',
                'category' => 'required',
                'description' => 'required',
            ]);
            $data = Goal::with(['user', 'reviewCycle', 'goalStatus', 'goalCategory'])->find($request->id);

            if ($request->title != $data->title || $request->reviewcycle != $data->review_cycle || $request->status != $data->status || $request->category != $data->category) {

                $createActitive = Activity::create([
                    'date' => date('Y-m-d'),
                    'user_id' => Auth::guard('web')->user()->id,
                    'goal_id' => $data->id,
                    'title' => "update this entry",
                ]);
            }
            

            if ($request->title != $data->title) {
                ActivityLog::create([
                    'data_key' => "Title",
                    'data_value' => $request->title,
                    'old_vaue' => $data->title,
                    'activiy_id' => $createActitive->id
                ]);
            }

            if ($request->reviewcycle != $data->review_cycle) {
                $revewckycle = ReviewCycle::find($request->reviewcycle);
                ActivityLog::create([
                    'data_key' => "Review cycle",
                    'data_value' => $revewckycle->title,
                    'old_vaue' => $data->reviewCycle->title,
                    'activiy_id' => $createActitive->id
                ]);
            }

            if ($request->status != $data->status) {
                $status = GoalStatus::find($request->status);
                ActivityLog::create([
                    'data_key' => "Status",
                    'data_value' => $status->title,
                    'old_vaue' => $data->goalStatus->title,
                    'activiy_id' => $createActitive->id
                ]);
            }

            if ($request->category != $data->category) {
                $category = GoalCategory::find($request->category);
                ActivityLog::create([
                    'data_key' => "Category",
                    'data_value' => $category->title,
                    'old_vaue' => $data->goalCategory->title,
                    'activiy_id' => $createActitive->id
                ]);
            }
            if (isset($request->type)  && !empty($request->type)) {
                $type = $request->type;
            } else {
                $type = 'Individual';
            }
            $user = User::find($request->userId);
            // echo "<pre>";print_r($user);die;
            $managerId = $user->manager_id;
            $data->update([
                'title' => $request->title,
                'status' => $request->status,
                'description' => $request->description,
                'deadline' => $request->end_date,
                'category' => $request->category,
                'review_cycle' => $request->reviewcycle,
                'time' => $request->time,
                'totalprogressbar' => $request->totalkeypregressbar,
                'user_id' => $user->id,
                'type' => $type,
                'manager_id' => $managerId,
            ]);

            $keyresults =  KeyResult::where('time', $request->time)->get();
            foreach ($keyresults as $keyresult) {
                $keyresult->goal_id = $data->id;
                $keyresult->save();
            }

            $activities =  Activity::where('time', $request->time)->get();
            foreach ($activities as $activity) {
                $activity->goal_id = $data->id;
                $activity->save();
            }

            return response()->json([
                'success' => 1,
                'message' => "Goal Updated successfully."
            ]);
        } else {
            request()->validate([
                'title' => 'required',
                'status' => 'required',
                'reviewcycle' => 'required',
                'category' => 'required',
                'description' => 'required',
            ]);

            if (isset($request->type)  && !empty($request->type)) {
                $type = $request->type;
            } else {
                $type = 'Individual';
            }
            $user = User::find($request->userid);
            $managerId = $user->manager_id;
            $data = Goal::create([
                'title' => $request->title,
                'status' => $request->status,
                'description' => $request->description,
                'deadline' => $request->end_date,
                'category' => $request->category,
                'review_cycle' => $request->reviewcycle,
                'time' => $request->time,
                'totalprogressbar' => $request->totalkeypregressbar,
                'user_id' => $user->id,
                'type' => $type,
                'manager_id' => $managerId,
            ]);

            $goalData = Goal::with('user', 'reviewCycle', 'goalStatus', 'goalCategory')->find($data->id);

            $createActitive = Activity::create([
                'date' => date('Y-m-d'),
                'user_id' => Auth::guard('web')->user()->id,
                'goal_id' => $data->id,
                'title' => "created this entry",
            ]);

            $goalData = Goal::with('user', 'reviewCycle', 'goalStatus', 'goalCategory')->find($data->id);

            $goalArray = ['Owner' => $goalData->user->name, 'Title' => $request->title, 'Goal Category' => $goalData->reviewCycle->title, 'Status' => $goalData->goalStatus->title, 'Category' => $goalData->goalCategory->title];
            foreach ($goalArray as $key => $vlaue) {
                ActivityLog::create([
                    'data_key' => $key,
                    'data_value' => $vlaue,
                    'activiy_id' => $createActitive->id
                ]);
            }


            $keyresults =  KeyResult::where('time', $request->time)->get();
            foreach ($keyresults as $keyresult) {
                $keyresult->goal_id = $data->id;
                $keyresult->save();
            }

            $activities =  Activity::where('time', $request->time)->get();
            foreach ($activities as $activity) {
                $activity->goal_id = $data->id;
                $activity->save();
            }

            return response()->json([
                'success' => 1,
                'message' => "Goal created successfully."
            ]);
        }
    }


    public function destroy(Request $request)
    {
        $data = Goal::find($request->id);
        $data->delete();
        $keies =  KeyResult::where('goal_id', $request->id)->get();
        foreach ($keies as $key) {
            $key->delete();
        }
        return response()->json([
            'success' => 1,
            'message' => "Goal deleted successfully."
        ]);
    }

    public function status(Request $request)
    {

        $data = Goal::find($request->id);
        $data->status = $request->status;
        $data->save();
        return response()->json([
            'success' => 1,
            'message' => "Goal status changed successfully."
        ]);
    }


    public function  myGoals(Request $request,$id)
    {
        $data['title'] = 'Goal';
        $data['sub_title'] = 'View';
        $data['id'] = base64_decode($id);
        // $data['goal'] = Goal::with('role')->find($request->id);
        return view('user.goal.goals', $data);
    }
        

    public function  competencies(Request $request)
    {
        $data['title'] = 'Goal Competencies';
        $data['sub_title'] = 'View';
        // $data['goal'] = Goal::with('role')->find($request->id); 
        return view('user.goal.competencies', $data);
    }

        
    public function  responsibility(Request $request)
    {
        $data['title'] = 'Responsibility';
        $data['sub_title'] = 'View';
        // $data['goal'] = Goal::with('role')->find($request->id); 
        return view('user.goal.responsibility', $data);
    }

    public function  development(Request $request)
    {
        $data['title'] = 'Development';
        // $data['sub_title'] = 'View';
        // $data['goal'] = Goal::with('role')->find($request->id); 
        // echo  "RR";die;
        return view('user.goal.development', $data);
    }

    public function histories(Request $request)
    {
        $activities = Activity::with(['activityLog', 'user.Image', 'admin'])->where('goal_id', $request->id)->orderBy('created_at', 'desc')->get();
        //    echo "<pre>"; print_r($activities->toArray()); die; 
        return view('user.goal.activity.goal_activity', compact('activities'));
    }
    
    public function goalOverView(Request $request)
    {
        // echo "<pre>"; print_r($request->toArray()); die;
        $title = 'Team Overview';
        
        if(isset($_GET['department'])){
            $departmentId = $_GET['department'];
        }else{
            $departmentId = '';
        }

        $departments = Department::get();
        // $users = User::with('goaloverview.keyresult', 'goaloverview.goalStatus')
        //     ->where('manager_id', Auth::guard('web')->user()->id)
        //     ->get();
          $query = User::with('goalOverview', 'goalStatus')->where('manager_id', Auth::guard('web')->user()->id);
        if (!empty($departmentId)) {
            $query->where('department_id', $departmentId);
        }
     
        $users = $query->get();
        $goalCount = 0;

        foreach ($users as $user) {
            $goalCount = $user->goaloverview->count();
            $arr = $count = $goalpailabel = $backgroundcolor  = [];
            $TotalProgressBar = $progress = $totalOfKey = $thisWeekDueCount = $totalDueCount = 0;
            foreach ($user->goaloverview as $Goals) {
                $key = $Goals->goalStatus->title;
                $bgkey = $Goals->goalStatus->background_color;
                $arr[$key][] = $Goals->id;
                $count[$key] = round((count($arr[$key]) * 100) / $goalCount);
                if($Goals->totalprogressbar  != 'NaN'){
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
            // echo "<pre>"; print_r($users->toArray());
            // die;
            if ($request->ajax()) {
                return  view('user.goal.teamoverview.teampartialgoaloverview', compact('users','title', 'departments'))->render();
            }
                return view('user.goal.teamoverview.teamoverview', compact('users', 'title','departments'));
    }
    
    
        public function goalOverViewList(Request $request,$id){
        $id =  base64_decode($id);
        $data['title'] = 'Goals';
        $data['sub_title'] = 'Goal List';
        $userid = $id;
        $data['goals'] = Goal::where('user_id', $userid)->get();
        $data['uinfo'] = User::with('Image', 'department')->find($userid);

        // echo "<pre>";print_r($data);die;
        return view('user.goal.teamoverview.fullListIndex', $data);
    }
    
      public function employee_goaloverview_filter(Request $request)
    {   // echo "<pre>";print_r($request->toArray());

        $username = $request->username;
        $department = $request->department;

        $title = 'Goal Overview';
       
        // if(isset($_GET['department'])){
        //     $departmentId = $_GET['department'];
        // }else{
        //     $departmentId = '';
        // }

        $username = $request->get('username');

        $managerId = Auth::guard('web')->user()->id;
    
        $query = User::with('goalOverview', 'goalStatus')->where('manager_id', $managerId);
        if (!empty($department)) {
            $query->where('department_id', $department);
        }
        if (!empty($username)) {
            $query->where('name', 'like', '%' . $username . '%');
        }
     
        $users = $query->get();

        // echo "<pre>";print_r($users->toArray());die;
    
        $departments = Department::get();
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
    

    return view('user.goal.teamoverview.teampartialgoaloverview' , compact('users', 'title', 'departments','username','department'));
    }
    
    
       public function hrGoalOverView(Request $request)
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
    
        $departments = Department::get();
        $reviewCycles = ReviewCycle::get();
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
    
        return view('user.goal.hroverview.overview', compact('users', 'title', 'departments','reviewCycles'));
    }

    public function hrSearchFilter(Request $request)
    {  
    //     $username = $request->username;
    //     $department = $request->department;

    //     $title = 'Goal Overview';
  
    //     $username = $request->get('username');

    //     $managerId = Auth::guard('web')->user()->id;
    
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
    // return view('user.goal.hroverview.allgoaloverview' , compact('users', 'title', 'departments','username','department'));

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
        $departments = Department::get();
        $reviewCycles = ReviewCycle::get();
        $goalCount = 0;
    
        foreach ($users as $user) {
            $goalCount = $user->goalOverview->count();
            $arr = $count = $goalpailabel = $backgroundcolor = [];
            $TotalProgressBar = $progress = $totalOfKey = $thisWeekDueCount = $totalDueCount = 0;
    
            foreach ($user->goalOverview as $Goals) {
                $key = $Goals->goalStatus->title;
                $bgkey = $Goals->goalStatus->background_color;
                $arr[$key][] = $Goals->id;
                $count[$key] = round((count($arr[$key]) * 100));
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
    
        return view('user.goal.hroverview.allgoaloverview', compact('users', 'title', 'departments', 'department', 'reviewCycles'));
    }  

      
        

 
}