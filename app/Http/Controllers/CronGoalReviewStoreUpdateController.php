<?php

namespace App\Http\Controllers;

use App\Models\GoalReview;
use Illuminate\Routing\Controller as BaseController;
use App\Models\InputType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Role;
use App\Models\LeaveRequest;
use App\Models\{Appraisal, Goal, GoalReviewStore, QueForm, RatingScale,ReviewCycle};
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Illuminate\Support\Facades\Validator;
use PDF;
use App\Mail\ManagerGoalReviewMail;
use Illuminate\Support\Facades\Mail;
class CronGoalReviewStoreUpdateController extends BaseController
{
    
   public function index(Request $request)
{ 
    $data['questionnaires'] = $queDatas = GoalReview::with(['GoalReviewStore'])
        ->where('self_review', 1)
        //->where('id', 23)
        ->get();
    
    foreach($queDatas as $queData) {

        $totalGoals = $queData->Goals->where('user_id', $queData->employee_id)
            ->where('review_cycle', $queData->review_cycle_id)
            ->count();

        $totalRatingOption = $queData->rating?->ratingScaleOption->count();   

        $user_id = $queData->employee_id;
        $goalreview = GoalReview::find($queData->id);      
        $totalSumAllGoals = $totalmanagerSumAllGoals = 0;
        $ratingEmpDataArray = $queData->GoalReviewStore;

        foreach($ratingEmpDataArray as $ratingEmpData) {
            $totalSumAllGoals += $ratingEmpData->que_self_rating;
            $totalmanagerSumAllGoals += $ratingEmpData->que_manager_rating;
            $ratingEmpData->total_gaps = abs($ratingEmpData->que_self_rating - $ratingEmpData->que_manager_rating);
            $ratingEmpData->save();
        }

        $goalreview->self_review = 1;
        $goalreview->manager_id = $queData->manager_id;
        $goalreview->input_type_name = $queData->goal_input_type;
        $goalreview->self_review_submitted = date("Y-m-d h:i:s A");
        $goalreview->total_self_rating = $totalSumAllGoals;
        $goalreview->total_manager_rating = $totalmanagerSumAllGoals;
        $goalreview->total_goals = $totalGoals;
        $finalTotalRating = $totalmanagerSumAllGoals - $totalSumAllGoals;
        $goalreview->total_gap = abs($finalTotalRating);

        $totalGoals1 = $queData->total_goals;
        $goalreview->save();
        // Check if totalGoals1 is greater than zero before division
        if ($totalGoals1 > 0) {
            $average_rating = $totalmanagerSumAllGoals / $totalGoals1;
            $goalreview->manager_average_rating = number_format($average_rating, 2);
        } else {
            $goalreview->manager_average_rating = 0; // or another default value
        }

        $goalreview->total_rating_number = $totalRatingOption;
        $goalreview->save();
    }
}
    
                   
       
    

}



