<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activity';

    protected $fillable = [
        'date',
        'user_id',
        'goal_id',
        'title',
        'is_admin',
        'competencies_id',
        'responsibilities_id',
        'developments_id',
        'time',
    ];

    public function activityLog()
    {
        return $this->hasMany(ActivityLog::class,'activiy_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class,'user_id');
    }

    public function getAssociatedUserAttribute()
    {
        return $this->is_admin ? $this->admin : $this->user;
    }

   
}
