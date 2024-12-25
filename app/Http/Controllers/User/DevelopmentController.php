<?php

namespace App\Http\Controllers\User;

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

    public function indexs(Request $request): View
    {
        $data['title'] = 'Responsibility';
        $data['sub_title'] = 'View';
       $data['userid'] = $userid =  base64_decode($request->id);
        $data['responsibilities'] = Development::with('keyresult')->where('user_id',$userid)->get();
        // echo "<pre>"; print_r($data['responsibilities']->toArray()); die;
        return view('user.goal.development.development',$data); 
    }


    public function create(Request $request): View
    {
        // echo "<pre>"; print_r($request->toArray()); die;
        $data['title'] = 'Add Responsibility';
        $data['sub_title'] = 'Create';
        $data['userid'] = base64_decode($request->id);
        $data['goalstatuses'] = GoalStatus::where('status', 1)->get();
        return view('user.goal.development.create', $data);
    }

    public function update($id)
    {
        // echo "<pre>"; print_r($id); die;
        $data['title'] = 'Add Responsibility';
        $data['sub_title'] = 'Create';
        $data['development'] = Development::with('keyresult')->find(base64_decode($id));
        // echo "<pre>"; print_r($data['competencies']->toArray()); die;
        return view('user.goal.development.update', $data);
    }



    public function store(Request $request)
    {
        // echo "<pre>"; print_r($request->all()); die;
        if ($request->id) {

            request()->validate([
                'title' => 'required',
                'status' => 'required',
                'description' => 'required',
            ]);
            $data = Development::with('user')->find($request->id);

            if ($request->title != $data->title  || $request->status != $data->status) {

                $createActitive = Activity::create([
                    'date' => date('Y-m-d'),
                    'user_id' => Auth::guard('admin')->user()->id,
                    'developments_id' => $data->id,
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
                'total_progress' => $request->totalkeypregressbar,
                'user_id' => $request->userid,
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
            ]);

            $data = Development::create([
                'title' => $request->title,
                'status' => $request->status,
                'discription' => $request->description,
                'time' => $request->time,
                'total_progress' => $request->totalkeypregressbar,
               'user_id' => $request->userid,
               'session_id' => session('sessionId'),

            ]);

            $createActitive = Activity::create([
                'date' => date('Y-m-d'),
                'user_id' => Auth::guard('web')->user()->id,
                'developments_id' => $data->id,
                'title' => "created this entry",
            ]);

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

    public function updateKeyHistory($table, $requestData)
    {

        $createActitive = Activity::create([
            'date' => date('Y-m-d'),
            'user_id' => Auth::guard('web')->user()->id,
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



    public function StoredevelopmentkeyKey(Request $request)
    {
        // echo "<pre>"; print_r($request->all()); die;
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
            $data = KeyResult::create([
                'title' => $request->title,
                'traking' => $request->traking,
                'traking_status' => $request->completprogess,
                'target' => $target,
                'start' => $start,
                'current' => $current,
                'time' => $request->time,
                'total_progress' => $totalProgress,
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

    public function destory(Request $request)
    {
        // echo "<pre>"; print_r($request->all()); die;
        $data = Development::find($request->id); 
        $data->delete(); 
       $keies =  KeyResult::where('competencies_id',$request->id)->get();
        foreach($keies as $key){
            $key->delete();
        }
        return response()->json([
            'success'=> 1,
            'message'=>"Responsibility deleted successfully."
        ]);
     
      
    }

    public function histories(Request $request)
    {
        $activities = Activity::with(['activityLog', 'user.Image', 'admin'])->where('developments_id', $request->id)->orderBy('created_at', 'desc')->get();
        //    echo "<pre>"; print_r($activities->toArray()); die; 
        return view('user.goal.activity.goal_activity', compact('activities'));
    }

   
}
