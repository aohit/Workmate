<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueForm extends Model
{
    use HasFactory;

    protected $table = "que_forms";

    protected $fillable = [
        'title',
        'status',

    ];

    public function FormSection()
    {
        return $this->hasMany(QueFormSection::class,);
    }
}
