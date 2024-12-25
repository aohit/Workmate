<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasOne;
use App\Scopes\ActiveScope;

class Goal extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'status',
        'description',
        'deadline',
        'category',
        'review_cycle',
        'time',
        'totalprogressbar',
        'user_id',
        'type',
        'manager_id',
        'session_id',
    ];

    protected $appends = ['totalprogressbar'];
    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope());
    }
    public function goalStatus()
    {
        return $this->belongsTo(GoalStatus::class, 'status');
    }
    public function goalCategory()
    {
        return $this->belongsTo(GoalCategory::class, 'category');
    }
    public function reviewCycle()
    {
        return $this->belongsTo(ReviewCycle::class, 'review_cycle');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function keyresult()
    {
        return $this->hasMany(KeyResult::class,'goal_id');
    }

    public function GoalReviewStore()
    {
        return $this->hasMany(GoalReviewStore::class,'goal_id','id');
    }

    public function getTotalprogressbarAttribute(){
        $keyResults = $this->keyresult()->get();
        $keyCount = count($keyResults);
        $keyResults = $keyResults->sum('total_progress');
        
        $totalProgress = ($keyCount > 0) ?  ($keyResults / $keyCount) : 0 ;

        return number_format($totalProgress);
    }
}
