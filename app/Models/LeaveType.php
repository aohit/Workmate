<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'status', 
        'color_code',
        'leave_days',
        'days_in_minutes',
        'leave_accurals',
        'carry_over_days',
        'expire_after',
        'expire_number',
        'days_in_hours',
        'is_exceed',
    ];

    public function leaverequest(){
        return $this->hasMany(LeaveRequest::class ,'leave_type');
    }

    public function LeaveHistory()
    {
        return $this->hasOne(EmployeeLeaveHistory::class,'leave_type_id','id');
    } 
    // EmployeeLeaveHistory
}
