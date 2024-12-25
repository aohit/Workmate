<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewCycle extends Model
{
    use HasFactory;

    protected $table = 'review_cycles';

    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'status',
    ];
}
