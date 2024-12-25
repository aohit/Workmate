<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueFormInput extends Model
{
    use HasFactory;

    protected $table = "que_form_inputs";

    protected $fillable = [
        'que_form_id',
        'que_form_section_id',
        'label',
        'placeholder',
        'input_type_id',
        'input_name',
        'rating_id',
    ];

    public function InputType()
    {
        return $this->belongsTo(InputType::class, 'input_type_id');
    }

    public function FormMultipleInput()
    {
        return $this->hasMany(QueFormMultipleInput::class,'temp_input_id');
    }

    public function questionnairesData()
    {
        return $this->hasMany(Questionnaire::class,'que_key');
    }

    public function RatingsData()
    {
        return $this->belongsTo(RatingScale::class,'rating_id'); 
    }

}
