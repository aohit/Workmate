<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;
class LeaveRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_type',
        'employee_id',
        'description',
        'start_date',
        'end_date',
        'file_id', 
        'is_leave', 
        'comment', 
        'session_id',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope());
    }
    public function user()
    {
        return $this->belongsTo(User::class,'employee_id','id');
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class,'leave_type','id');
    } 

    
    public function leaveSchedules()
    {
        return $this->hasMany(LeaveSchedule::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class,'employee_id','id');
    }

    
     
}
