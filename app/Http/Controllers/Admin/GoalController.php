<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\{Activity, ActivityLog, Goal, GoalCategory, GoalStatus, KeyResult, ReviewCycle, User};
use App\Models\Role;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Dompdf\Dompdf;
use Dompdf\Options;
// use Barryvdh\DomPDF\Facade as PDF;
use PDF;




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
        // $data['title'] = 'Goal';
        // $data['sub_title'] = 'Goal List';
        // $userid =  Auth::guard('web')->user()->id;
        // $qry = User::where('id', $userid)->first();
        // $goals = Goal::get();
        // $pdf = PDF::loadView('user.pdf.mygoals', ['uinfo' => $qry, 'info' => $goals]);
        // return $pdf->download('mygoals.pdf');
    }


    public function index(): View
    {
        $data['title'] = 'Goals';
        $data['sub_title'] = 'Goal List';
        // echo "<pre>";print_r($data);die;
        return view('admin.goal.index', $data);
    }

    public function list(Request $request)
    {
        // echo "<pre>"; print_r($request->all()); die;
        if ($request->ajax()) {


            $data = Goal::with('goalStatus', 'goalCategory', 'reviewCycle','user')->orderBy('id', 'desc')->get();
            //   echo "<pre>"; print_r($data->toArray()); die;
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    $name =  ucwords($row->user?->name);
                    return $name;
                })
                ->addColumn('title', function ($row) {
                    $title =  @$row->title;
                    return $title;
                })
                ->addColumn('review_cycle', function ($row) {
                    $data = @$row?->reviewCycle->title;
                    return $data;
                })

                ->addColumn('status', function ($row) {

                    $status =   '<button type="button" class="btn btn-xs rounded-pill" style="background-color:' . @$row->goalStatus->background_color . '; color:' . @$row->goalStatus->label_color . '">' . $row->goalStatus->title . '</button>';

                    return $status;
                })
                ->addColumn('progressbar', function ($row) {

                    $progrebar = '<div class="progress mb-0">
                            <div class="progress-bar" role="progressbar" style="width: ' . $row->totalprogressbar . '%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">' . $row->totalprogressbar . '%' . '</div>
                        </div>';
                    return $progrebar;
                })

                ->addColumn('action', function ($row) {
                    
                    $editUrl = route('admin.goal.update', $row->id);
                    $deleteUrl = route('admin.goal.delete');
                    $showUrl = route('goal.show');
                
                    $action = '<div class="flexblockclass gap-1">';
                    $action .= '<a href="' . $editUrl . '" title="Edit" class="btn-sm btn btn-outline-dark waves-effect waves-light me-1">Edit</a>';
                    $action .= '<button type="button" title="Delete" onclick="deleteRow(this, \'' . $row->id . '\', \'' . $deleteUrl . '\')" class="btn-sm btn btn-outline-dark waves-effect waves-light me-1">Delete</button>';
                    $action .= '<button type="button" title="Activity" onclick="activities(\'' . $row->id . '\')" class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1"><i class="fadeIn animated bx bx-history"></i></button>';
                    $action .= '</div>';
                
                    return $action;
                })

                ->rawColumns(['title', 'status', 'review_cycle', 'progressbar', 'action'])
                ->make(true);
        }
    }

    public function create(): View
    {
        $data['title'] = 'Add Goal';
        $data['sub_title'] = 'Create';
        $data['roles'] = Role::get();
        $data['goalstatuses'] = GoalStatus::where('status', 1)->get();
        $data['goalcategories'] = GoalCategory::where('status', 1)->get();
        $data['reviewcycles'] = ReviewCycle::where('status', 1)->get();
        $data['users'] = User::get();
        return view('admin.goal.create', $data);
    }

    public function GoalKey(Request $request)
    {
        $data['title'] = 'Add Goal';
        $data['sub_title'] = 'Add Key Result';
        $data['time'] = $request->time;
        return view('admin.goal.createkeyresult', $data);
    }

    public function EditGoalKey(Request $request)
    {
        $data['title'] = 'Update Goal';
        $data['sub_title'] = 'Update Key Result';
        $data['keyresult'] = KeyResult::find($request->id);
        $data['time'] = $request->time;
        return view('admin.goal.editkeyresult', $data);
    }

    public function updateKeyHistory($table, $requestData)
    {

        $createActitive = Activity::create([
            'date' => date('Y-m-d'),
            'user_id' => Auth::guard('admin')->user()->id,
            'is_admin' => 1,
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

            if ($requestData->traking == 'Quantiflable traget') {

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

        if ($table->target != $requestData->target && $trakings == false && $requestData->traking == 'Quantiflable traget') {

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

        if ($table->current != $requestData->current && $trakings == false && $requestData->traking == 'Quantiflable traget') {

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

        if ($table->start != $requestData->start && $trakings == false && $requestData->traking == 'Quantiflable traget') {

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

            if ($request->traking == "Quantiflable traget") {
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

            $totalProgress = round((($current - $start) / ($target - $start)) * 100);

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

            $view = view('admin.goal.key.keyresultshow', compact('keyresults'))->render();

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

            if ($request->traking == "Quantiflable traget") {
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
            $totalProgress = round((($current - $start) / ($target - $start)) * 100);
            $totalpro  = round($totalProgress);
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
                'user_id' => Auth::guard('admin')->user()->id,
                'is_admin' => 1,
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
            } elseif ($request->traking == 'Quantiflable traget') {

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

            $view = view('admin.goal.key.keyresultshow', compact('keyresults'))->render();

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

        $view = view('admin.goal.key.keyresultshow', compact('keyresults'))->render();
        return response()->json([
            'success' => 1,
            'message' => "Goal Key deleted successfully.",
            'view' => $view
        ]);
    }

    public function update(Request $request, $id): View
    {
        $data['title'] = 'Goals';
        $data['sub_title'] = 'Update';
        $data['goal'] = Goal::with('user')->find($id);
        $data['goalstatuses'] = GoalStatus::where('status', 1)->get();
        $data['goalcategories'] = GoalCategory::where('status', 1)->get();
        $data['reviewcycles'] = ReviewCycle::where('status', 1)->get();
        $data['keyresults'] = KeyResult::where('goal_id', $request->id)->get();
        $data['users'] = User::get();
        // echo "<pre>"; print_r($data['goal']->toArray()); die;
        return view('admin.goal.update', $data);
    }


    public function show(Request $request): View
    {
        $data['title'] = 'Goals';
        $data['sub_title'] = 'View';
        $data['goal'] = Goal::with('role')->find($request->id);
        return view('admin.goal.show', $data);
    }

    public function store(Request $request)
    {
        // echo "<pre>"; print_r($request->all()); die;
        if ($request->id) {

            request()->validate([
                'title' => 'required',
                'status' => 'required',
                'reviewcycle' => 'required',
                'category' => 'required',
                'description' => 'required',
                'user' => 'required',
            ]);

            $data = Goal::with(['user', 'reviewCycle', 'goalStatus', 'goalCategory'])->find($request->id);

            if ($request->user != $data->user_id || $request->title != $data->title || $request->reviewcycle != $data->review_cycle || $request->status != $data->status || $request->category != $data->category) {

                $createActitive = Activity::create([
                    'date' => date('Y-m-d'),
                    'user_id' => Auth::guard('admin')->user()->id,
                    'is_admin' => 1,
                    'goal_id' => $data->id,
                    'title' => "update this entry",
                ]);
            }

            if ($request->user != $data->user_id) {
                $user =   User::find($request->user);
                ActivityLog::create([
                    'data_key' => "Owner",
                    'data_value' => $user->name,
                    'old_vaue' => $data->user->name,
                    'activiy_id' => $createActitive->id
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
            $data->update([
                'title' => $request->title,
                'status' => $request->status,
                'description' => $request->description,
                'deadline' => $request->end_date,
                'category' => $request->category,
                'review_cycle' => $request->reviewcycle,
                'time' => $request->time,
                'totalprogressbar' => round($request->totalkeypregressbar),
                'user_id' => $request->user,
                'session_id' => session('sessionId'),
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
                'user' => 'required',
            ]);

            $data = Goal::create([
                'title' => $request->title,
                'status' => $request->status,
                'description' => $request->description,
                'deadline' => $request->end_date,
                'category' => $request->category,
                'review_cycle' => $request->reviewcycle,
                'time' => $request->time,
                'totalprogressbar' => round($request->totalkeypregressbar),
                'user_id' => $request->user,
                'session_id' => session('sessionId'),
            ]);
            $goalData = Goal::with('user', 'reviewCycle', 'goalStatus', 'goalCategory')->find($data->id);

            $createActitive = Activity::create([
                'date' => date('Y-m-d'),
                'user_id' => Auth::guard('admin')->user()->id,
                'is_admin' => 1,
                'goal_id' => $data->id,
                'title' => "created this entry",
            ]);

            $goalData = Goal::with('user', 'reviewCycle', 'goalStatus', 'goalCategory')->find($data->id);

            $goalArray = ['Owner' => $goalData->user->name, 'Title' => $request->title, 'Goal Category' => $goalData->reviewCycle->title, 'Status' => $goalData->goalStatus->title, 'Category' => $goalData->goalCategory->title];
            // echo "<pre>"; print_r($goalArray); die;
            foreach ($goalArray as $key => $vlaue) {
                ActivityLog::create([
                    'data_key' => $key,
                    'data_value' => $vlaue,
                    'activiy_id' => $createActitive->id
                ]);
            }

            $keyresults =  KeyResult::where('time', $request->time)->get();
            foreach ($keyresults as $key => $keyresult) {
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




    public function  myGoals(Request $request)
    {
        $data['title'] = 'Goal';
        $data['sub_title'] = 'View';
        $data['goal'] = Goal::with('role')->find($request->id);
        return view('admin.goal.goals', $data);
    }


    public function  competencies(Request $request)
    {
        $data['title'] = 'Goal Competencies';
        $data['sub_title'] = 'View';
        // $data['goal'] = Goal::with('role')->find($request->id); 
        return view('admin.goal.competencies', $data);
    }


    public function  responsibility(Request $request)
    {
        $data['title'] = 'Responsibility';
        $data['sub_title'] = 'View';
        // $data['goal'] = Goal::with('role')->find($request->id); 
        return view('admin.goal.responsibility', $data);
    }

    public function  development(Request $request)
    {
        $data['title'] = 'Development';
        // $data['sub_title'] = 'View';
        // $data['goal'] = Goal::with('role')->find($request->id); 
        // echo  "RR";die;
        return view('admin.goal.development', $data);
    }

    public function histories(Request $request)
    {
        $activities = Activity::with(['activityLog', 'user.Image', 'admin'])->where('goal_id', $request->id)->orderBy('created_at', 'desc')->get();
        //    echo "<pre>"; print_r($activities->toArray()); die;
        return view('admin.goal.activity.goal_activity', compact('activities'));
    }
}
