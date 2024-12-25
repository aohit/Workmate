<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;
class GoalReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'que_employee_value',
        'que_manager_value',
        'review_cycle_id',
        'input_type_id',
        'rating_id',
        'goalcomment_id',
        'manager_id',
        'que_self_rating',
        'que_manager_rating',
        'goal_id',
        'input_type_name',
        'self_popup',
        'manager_popup',
        'self_popup_date',
        'manager_popup_date',
        'sendmail',
        'total_self_rating',
        'total_manager_rating',
        'total_gap',
        'manager_average_rating',
        'total_goals',
        'total_rating_number',
        'session_id',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope());
    }
    public function user()
    {
        return $this->belongsTo(User::class,'employee_id');
    }

    public function Manager()
    {
        return $this->belongsTo(User::class,'manager_id');
    }

    public function Goals()
    {
        return $this->hasMany(Goal::class,'user_id','employee_id');
    }

    public function reviewCycle()
    {
        return $this->belongsTo(ReviewCycle::class,'review_cycle_id');
    }

    public function InputsData()
    {
        return $this->belongsTo(QueFormInput::class,'que_key');
    }

    public function rating()
    {
        return $this->belongsTo(RatingScale::class,'rating_id');
    }

    public function InputTypesData()
    {
        return $this->belongsTo(InputType::class,'input_type_id');
    }

    public function Competency()
    {
        return $this->hasMany(Competencies::class,'user_id','employee_id');
    }

    public function responsibility()
    {
        return $this->hasMany(Responsibility::class,'user_id','employee_id');
    }

    public function development()
    {
        return $this->hasMany(Development::class,'user_id','employee_id');
    }
    
    public function GoalReviewStore()
    {
        return $this->hasMany(GoalReviewStore::class,'goal_review_id','id');
    }

}
