<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeaveHistory extends Model
{
    use HasFactory;

    protected $table = 'employee_leave_history';
    protected $fillable = [
        'employee_id',
        'leave_type_id', 
        'total_leave_days',
        'booked',
        'remaining',
        'status',
        'session_id',
        'carried_over_leave',
        'carried_over_expire',
        'carried_over_is_expire',
        'carried_over_leave_active',
        'accumulated_leave',
        'advance_leave',
       
    ];
    // public function leaverequest(){
    //     return $this->hasMany(LeaveRequest::class ,'leave_type');
    // }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class,'leave_type_id');
    } 
    public function employeeId()
    {
        return $this->belongsTo(User::class,'employee_id');
    } 
}
