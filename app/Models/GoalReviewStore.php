<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoalReviewStore extends Model
{
    use HasFactory;

    protected $fillable = [
        'goal_review_id',
        'que_employ_value',
        'que_manager_value',
        'employ_id',
        'manager_id',
        'que_self_rating',
        'que_manager_rating',
        'goal_id',
        'goal_comments',
        'manager_comment',
        'total_gaps',
    ];

    public function goalsReview()
    {
        return $this->belongsTo(GoalReview::class,'goal_review_id','id');
    }
}
