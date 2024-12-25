<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
    protected $table = 'emergency_contacts';

    protected $fillable = ['name', 'number', 'relation', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

   
}

