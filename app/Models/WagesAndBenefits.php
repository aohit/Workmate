<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WagesAndBenefits extends Model
{
    use HasFactory;

    protected $table = 'wages_and_benefits';


    protected $fillable = [
        'user_id',
        'items',
        'currency',
        'amount',
        'file_path'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    } 



}
