<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoalStatus extends Model
{
    use HasFactory;

    protected $table = 'goal_statuses';

    protected $fillable = [
        'title',
        'status',
        'background_color',
        'label_color',
    ];


    public function goals()
    {
        return $this->hasMany(Goal::class, 'status');
    }
}
