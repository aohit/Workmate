<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use HasFactory;

    protected $fillable = [
                'appraisal_id',
                 'que_key',
                'employ_id',
                'que_employ_value',
                'que_manager_value',
                'employ_id', 
                'manager_id',
                'que_self_rating',
                'que_manager_rating',
                'total_gaps'
            ];


            public function username()
            {
                return $this->hasOne(User::class,'id','employ_id');
            }

            public function InputsData()
            {
                return $this->belongsTo(QueFormInput::class,'que_key');
            }

}
