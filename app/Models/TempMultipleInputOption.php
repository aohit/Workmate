<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TempMultipleInputOption extends Model
{
    use HasFactory;

    protected $table = 'temp_multiple_input_options';
    
    protected $fillable = [
        'label',
        'type',
        'temp_input_id',
    ];
}
