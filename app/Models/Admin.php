<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; 
use Illuminate\Database\Eloquent\Relations\hasOne;

class Admin extends Authenticatable
{
    
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard  = 'admin'; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'department_id',
        'employment_start',
        'employment_end',
        'd_o_b',
        'employee_code',
        'profile_image',
        'logo',
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function department(): hasOne
    {
        return $this->hasOne(Department::class,'id','department_id');
    }

    public function logoimage(){
        return $this->belongsTo(UploadFile::class,'logo');
    }

    public function prfileImage(){
        return $this->belongsTo(UploadFile::class,'profile_image');
    }

}
