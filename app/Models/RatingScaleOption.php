<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingScaleOption extends Model
{
    use HasFactory;
    
    protected $fillable = ['rating_scale_id','option_label'];
}
