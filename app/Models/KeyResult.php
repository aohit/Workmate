<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyResult extends Model
{
    use HasFactory;

    protected $table = 'key_results';

    protected $fillable = [
        'title',
        'traking',
        'traking_status',
        'target',
        'start',
        'goal_id',
        'current',
        'total_progress',
        'time',
        'competencies_id',
        'responsibilities_id',
        'developments_id',
    ];

    public function goal()
    {
        return $this->belongsTo(Goal::class,'goal_id');
    }
}
