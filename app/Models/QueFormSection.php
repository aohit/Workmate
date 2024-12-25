<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueFormSection extends Model
{
    use HasFactory;

    protected $table = "que_form_sections";

    protected $fillable = [
        'title',
        'status',
        'sec_id',
        'que_form_id',
    ];

    public function FormInput()
    {
        return $this->hasMany(QueFormInput::class,);
    }

    

}
