<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    
    protected $table = 'certificate';

    protected $fillable = [
        'user_id',
        'file', 
        'certificate_name',
        'department_id', 
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

}
