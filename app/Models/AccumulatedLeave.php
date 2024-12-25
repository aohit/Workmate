<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccumulatedLeave extends Model
{
    use HasFactory;

    protected $table = 'accumulated_leaves';

    protected $fillable = [
        'employee_id',
        'accumulated_leave', 
        'accumulate_leave_hours',
        'accumulate_leave_minutes', 
        'leave_type_id', 
        'session_id', 
    ];
}
