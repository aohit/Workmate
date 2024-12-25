<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;
class Appraisal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'self_review',
        'self_review_deadline',
        'manager_id',
        'manager_review',
        'manager_review_deadlin',
        'status',
        'review_cycle',
        'results_shared',
        'questionnaire',
        'self_popup',
        'self_popup',
        'manager_popup',
        'self_popup_date',
        'manager_popup_date',
        'self_review_submited',
        'manager_review_submited',
        'sendmail',
        'total_self_rating',
        'total_manager_rating',
        'total_gap',
        'total_questions',
        'session_id',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope());
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function FormQue()
    {
        return $this->belongsTo(QueForm::class, 'questionnaire');
    }

    public function reviewcycle(){

        return $this->belongsTo(ReviewCycle::class, 'review_cycle'); 
    }

    public function QuestionnairesData()
    {
        return $this->belongsTo(Questionnaire::class,'questionnaire');
    }
    public function Questionnaires()
    {
        return $this->hasMany(Questionnaire::class,'appraisal_id','id');
    }

}
