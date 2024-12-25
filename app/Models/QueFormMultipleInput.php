<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueFormMultipleInput extends Model
{
    use HasFactory;

    protected $table = "que_form_multiple_inputs";

    protected $fillable = [
        'label',
        'type',
        'temp_input_id',
        'que_form_id',
    ];

}
