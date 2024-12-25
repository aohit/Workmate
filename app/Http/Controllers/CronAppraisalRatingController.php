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
class CronAppraisalRatingController extends BaseController
{
    
   public function index(Request $request)
{ 
    $appraisals = Appraisal::with('questionnaires')->get();

        foreach($appraisals as $appraisal) {
           
            $totalSelfRating = $totalManagerRating = $totalGap =  0;
        
            foreach($appraisal->questionnaires as $questionnaire) {                
                $totalSelfRating += $questionnaire->que_self_rating;
                $totalManagerRating += $questionnaire->que_manager_rating;
                $totalGap = $totalManagerRating - $totalSelfRating;
            }
           
            $appraisal->total_self_rating = $totalSelfRating;
            $appraisal->total_manager_rating = $totalManagerRating;
            $appraisal->total_gap = $totalGap;
            $appraisal->save();
        
        }
}
    
                   
       
    

}



