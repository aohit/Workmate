<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasOne;
use App\Scopes\ActiveScope;

class Responsibility extends Model
{
    use HasFactory; 

    protected $table = 'responsibilities';
    
    protected $fillable = [
        'title',
        'status',
        'discription',
        'total_progress',
        'time',
        'session_id'
    ];
    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope());
    }

    public function keyresult(){
        return $this->hasMany(KeyResult::class,'responsibilities_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    
}
