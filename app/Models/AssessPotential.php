<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessPotential extends Model
{
    use HasFactory;

    protected $fillable = [
        'potential',
        'retention', 
        'loss_impact', 
        'achievable_level', 
        'performance_id', 
        'status', 
    ];
}
