<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasOne;
use App\Scopes\ActiveScope;

class Development extends Model
{
    use HasFactory; 

    protected $table = 'developments';
    
    protected $fillable = [
        'title',
        'status',
        'discription',
        'total_progress',
        'time',
        'user_id',
        'session_id'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope());
    }

    public function keyresult(){
        return $this->hasMany(KeyResult::class,'developments_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    
}
