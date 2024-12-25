<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasOne; 

class LeaveSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'employee_id',
        'leave_request_id',
        'type',
        'start_time',
        'end_time', 
        'days_in_hours'
    ];

    // public function leaveType(): hasOne
    // {
    //     return $this->hasOne(LeaveType::class,'id','leave_type');
    // } 
 
        public function leaveType(): hasOne
            {
                return $this->hasOne(LeaveType::class,'id','type');
            } 

        public function leaveRequests()
            {
                 return $this->belongsTo(LeaveRequest::class,'leave_request_id','id');
            } 

        public function employees(): hasOne
            {
                return $this->hasOne(User::class,'id','employee_id');
            } 
}