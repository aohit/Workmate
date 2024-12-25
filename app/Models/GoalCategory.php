<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoalCategory extends Model
{
    use HasFactory;

    protected $table = 'goal_categories';

    protected $fillable = [
        'title',
        'status',
    ];
}
