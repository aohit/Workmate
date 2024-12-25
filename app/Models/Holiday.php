<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;

class Holiday extends Model
{
    use HasFactory; 
    protected $fillable = [
        'title',
        'date', 
        'status',
        'country',
        'color',
        'session_id' 
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope());
    }
}
