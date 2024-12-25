<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisciplinaryActionType extends Model
{
    use HasFactory;

    protected $table = 'disciplinary_action_type';
    protected $fillable = [
        'action_type',
        'status', 
    ];

}
