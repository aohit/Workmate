<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingScale extends Model
{
    use HasFactory;

    protected $fillable = ['label','is_include_na','display_type'];

    public function ratingScaleOption(){
        return $this->hasMany(RatingScaleOption::class)->orderBy('id', 'asc');
    }
}
