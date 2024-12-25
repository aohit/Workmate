<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\{Activity, ActivityLog, Competencies, Development, Goal, GoalCategory, GoalStatus, KeyResult, Responsibility, ReviewCycle, User};
use App\Models\Role;
use DataTables;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Hash;
// use Barryvdh\DomPDF\Facade as PDF;
use PDF;
use Svg\Tag\Rect;

class DevelopmentController extends Controller
{
    /**
     * Display the login view.
     */

    function __construct()
    {
    }

    public function index(): View
    {
        $data['title'] = 'Responsibility';
        $data['sub_title'] = 'View';
        // echo "<pre>"; print_r($data['responsibilities']->toArray()); die;
        return view('admin.goal.development.development', $data);
    }

    public function list(Request $request)
    {
        // echo "<pre>"; print_r($request->all()); die;
        if ($request->ajax()) {
            $data = Development::with('user')->get();
            //   echo "<pre>"; print_r($data->toArray()); die;
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function ($row) {
                    $userNmae =  @$row->user->name;
                    return $userNmae;
                })
                ->addColumn('title', function ($row) {
                    $data = $row->title;
                    return $data;
                })

                ->addColumn('status', function ($row) {

                    $status =   '<button type="button" class="btn btn-primary rounded-pill waves-effect waves-light">' . $row->status . '</button>';

                    return $status;
                })
                ->addColumn('progressbar', function ($row) {

                    $progrebar = '<div class="progress mb-0">
            <div class="progress-bar" role="progressbar" style="width: ' . $row->total_progress . '%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">' . $row->total_progress . '%' . '</div>
        </div>';
                    return $progrebar;
                })

                ->addColumn('action', function ($row) {

                    $editUrl = route('admin.updatedevelopment', $row->id);

                    $showUrl = route('goal.show');

                    $action = '<div class="flexblockclass gap-1">';
                    $action .= '<a href="' . $editUrl . '" class="btn-sm btn btn-outline-dark waves-effect waves-light me-1">Edit</a>';
                    // $action .=  '<button type="button" onclick = showForm(this,"'.$row->id.'","'. $showUrl .'") class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1">Show</button>&nbsp;&nbsp;&nbsp;';
                     $action .= '<button type="button" onclick="deletedata(' . $row->id . ')" class="btn-sm btn btn-outline-dark waves-effect waves-light me-1">Delete</button>';
                     
                    $action .= '<button type="button" title="Activity" onclick="activities(\'' . $row->id . '\')" class="btn-sm btn btn-outline-dark waves-effect waves-light mr-1"><i class="fadeIn animated bx bx-history"></i></button>';
                    $action .= '</div>';
                    return $action;
                })

                ->rawColumns(['title', 'user', 'status', 'progressbar', 'action'])
                ->make(true);
        }
    }


    public function create(Request $request): View
    {
        // echo "<pre>"; print_r($request->toArray()); die;
        $data['title'] = 'Add Development';
        $data['sub_title'] = 'Create';
        $data['goalstatuses'] = GoalStatus::where('status', 1)->get();
        $data['users'] = User::get();
        return view('admin.goal.development.create', $data);
    }

    public function update($id)
    {
        // echo "<pre>"; print_r($id); die;
        $data['title'] = 'Update Development';
        $data['sub_title'] = 'Create';
        $data['development'] = Development::with('keyresult')->find($id);
        $data['users'] = User::get();
        // echo "<pre>"; print_r($data['competencies']->toArray()); die;
        return view('admin.goal.development.update', $data);
    }

    public function updateKeyHistory($table, $requestData)
    {
        // echo "<pre>"; print_r($request->all()); die;

        $createActitive = Activity::create([
            'date' => date('Y-m-d'),
            'user_id' => Auth::guard('admin')->user()->id,
            'is_admin' => 1,
            'developments_id' => $table->developments_id,
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




    public function store(Request $request)
    {
        // echo "<pre>"; print_r($request->all()); die;
        if ($request->id) {

            request()->validate([
                'title' => 'required',
                'status' => 'required',
                'description' => 'required',
                'user' => 'required',
            ]);
            $data = Development::find($request->id);

            if ($request->user != $data->user_id || $request->title != $data->title  || $request->status != $data->status) {

                $createActitive = Activity::create([
                    'date' => date('Y-m-d'),
                    'user_id' => Auth::guard('admin')->user()->id,
                    'is_admin' => 1,
                    'developments_id' => $data->id,
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

            if ($request->status != $data->status) {
                ActivityLog::create([
                    'data_key' => "Status",
                    'data_value' => $request->status,
                    'old_vaue' => $data->status,
                    'activiy_id' => $createActitive->id
                ]);
            }

            $data->update([
                'title' => $request->title,
                'status' => $request->status,
                'discription' => $request->description,
                'time' => $request->time,
                'total_progress' => round($request->totalkeypregressbar),
                'user_id' => $request->user,
                'session_id' => session('sessionId'),
            ]);

            $keyresults =  KeyResult::where('time', $request->time)->get();
            foreach ($keyresults as $keyresult) {
                $keyresult->developments_id = $data->id;
                $keyresult->save();
            }
            $activities =  Activity::where('time', $request->time)->get();
            foreach ($activities as $activity) {
                $activity->developments_id = $data->id;
                $activity->save();
            }
            
            return response()->json([
                'success' => 1,
                'message' => "Development Updated successfully."
            ]);
        } else {
            request()->validate([
                'title' => 'required',
                'status' => 'required',
                'description' => 'required',
                'user' => 'required',
            ]);

            $data = Development::create([
                'title' => $request->title,
                'status' => $request->status,
                'discription' => $request->description,
                'time' => $request->time,
                'total_progress' => round($request->totalkeypregressbar),
                'user_id' => $request->user,
                'session_id' => session('sessionId'),

            ]);

            $createActitive = Activity::create([
                'date' => date('Y-m-d'),
                'user_id' => Auth::guard('admin')->user()->id,
                'is_admin' => 1,
                'developments_id' => $data->id,
                'title' => "created this entry",
            ]);
            // echo "<pre>"; print_r($createActitive->all()); die;
            $competencies =    Development::with('user')->find($data->id);

            $competenceArray = ['Owner' => $competencies->user->name, 'Title' => $request->title, 'Status' => $request->status];
            foreach ($competenceArray as $key => $vlaue) {
                ActivityLog::create([
                    'data_key' => $key,
                    'data_value' => $vlaue,
                    'activiy_id' => $createActitive->id
                ]);
            }


            $keyresults =  KeyResult::where('time', $request->time)->get();
            foreach ($keyresults as $keyresult) {
                $keyresult->developments_id = $data->id;
                $keyresult->save();
            }

            $activities =  Activity::where('time', $request->time)->get();
            foreach ($activities as $activity) {
                $activity->developments_id = $data->id;
                $activity->save();
            }

            return response()->json([
                'success' => 1,
                'message' => "Development created successfully."
            ]);
        }
    }



    public function StoredevelopmentkeyKey(Request $request)
    {
        // echo "<pre>"; print_r($request->all()); die;
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

            $totalProgress = (($current - $start) / ($target - $start)) * 100;
            $totalpro = round($totalProgress);
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
                'total_progress' => $totalpro,
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
            $totalProgress = (($current - $start) / ($target - $start)) * 100;
            $totalPro = round($totalProgress);
            $data = KeyResult::create([
                'title' => $request->title,
                'traking' => $request->traking,
                'traking_status' => $request->completprogess,
                'target' => $target,
                'start' => $start,
                'current' => $current,
                'time' => $request->time,
                'total_progress' => $totalPro,
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

    public function destory(Request $request)
    {
        // echo "<pre>"; print_r($request->all()); die;
        $data = Development::find($request->id);
        $data->delete();
        $keies =  KeyResult::where('competencies_id', $request->id)->get();
        foreach ($keies as $key) {
            $key->delete();
        }
        return response()->json([
            'success' => 1,
            'message' => "Responsibility deleted successfully."
        ]);
    }

    public function histories(Request $request)
    {
        $activities = Activity::with(['activityLog', 'user.Image', 'admin'])->where('developments_id', $request->id)->orderBy('created_at', 'desc')->get();
        //    echo "<pre>"; print_r($activities->toArray()); die; 
        return view('admin.goal.activity.goal_activity', compact('activities'));
    }
}
