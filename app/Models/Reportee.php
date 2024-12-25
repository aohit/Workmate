<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasOne;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Reportee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'reportee_id',  
    ];

    public function employee()
    {
        return $this->belongsTo(User::class,'reportee_id','id');
    } 
 
}
