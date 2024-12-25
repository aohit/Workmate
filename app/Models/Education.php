<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations';

    protected $fillable = [
        'employee_id',
        'qualification', 
        'percentage', 
        'passing_year', 
    ];


    public function employee()
    {
        return $this->hasOne(User::class,'id','employee_id');
    }
}
