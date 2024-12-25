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
use App\Models\{Appraisal, Goal, GoalReviewStore, QueForm, RatingScale,ReviewCycle,Questionnaire};
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Illuminate\Support\Facades\Validator;
use PDF;
use App\Mail\ManagerGoalReviewMail;
use Illuminate\Support\Facades\Mail;
class CronAppraisalRatingUpdateController extends BaseController
{
    
   public function index(Request $request)
{ 
    $appraisals = Appraisal::with('questionnaires')->get();

        foreach($appraisals as $appraisal) {
            // if($appraisal->manager_id == $user_id){
                $AppraisalRatings = Questionnaire::where('appraisal_id', $appraisal->id)
                ->where('employ_id', $appraisal->user_id)
                  ->get();
                
              $totalSelfRating = 0;
              $totalManagerRating = 0;
              $totalGap = 0;
              
              foreach ($AppraisalRatings as $AppraisalRating) {
                  $selfRating = $AppraisalRating->que_self_rating;
                  $managerRating = $AppraisalRating->que_manager_rating;
                  $gap = $managerRating - $selfRating;
              
                  $AppraisalRating->update([
                      'total_gaps' => abs($gap),
                  ]);
              
                  $totalSelfRating += $selfRating;
                  $totalManagerRating += $managerRating;
                  $totalGap += $gap;
              }  
              
              $appraisal->total_self_rating = $totalSelfRating;
              $appraisal->total_manager_rating = $totalManagerRating;
              $appraisal->total_gap = $totalGap; 

              $appraisal->save();
        
        }
}
    
                   
       
    

}



