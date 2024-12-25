<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 
        'skills', 
        'experience', 
    ];


    public function employee()
    {
        return $this->hasOne(User::class,'id','employee_id');
    }

}
