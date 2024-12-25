<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempInputType extends Model
{
    use HasFactory;

    protected $table = "temp_input_types";

    protected $fillable = [
        'label',
        'input_type_id',
        'placeholder',
        'input_name',
        'rating_id',
    ];
    public function inputType()
    {
        return $this->belongsTo(InputType::class);
    }

    public function multipleinput()
    {
        return $this->hasMany(TempMultipleInputOption::class,'temp_input_id');
    }

    public function RatingsData()
    {
        return $this->belongsTo(RatingScale::class,'rating_id'); 
    }

}
