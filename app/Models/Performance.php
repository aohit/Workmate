<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasOne;

class Performance extends Model
{
    use HasFactory; 
    protected $fillable = [
        'employee_id',
        'goal_id',
        'start_date',
        'end_date',
        'due_date',
        'status', 
    ];

    // public function role(): hasOne
    // {
    //     return $this->hasOne(Role::class,'id','role_id');
    // }
    public function user(): hasOne
    {
        return $this->hasOne(User::class,'id','assign_manager_id');
    }

    public function employee(): hasOne
    {
        return $this->hasOne(User::class,'id','employee_id');
    }

    public function reviewTemp(): hasOne
    {
        return $this->hasOne(ReviewTemplate::class,'id','review_temp');
    }

    
}
