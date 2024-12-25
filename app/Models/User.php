<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use COM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; 
use Illuminate\Database\Eloquent\Relations\hasOne;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
  
    protected $guard  = 'web';
     
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
        'reporting_to', 
        'manager_id', 
        'national_id', 
        'phone_number', 
        'gender', 
        'nationality', 
        'marital_status', 
        'emergency_contact', 
        'language_id', 
        'file_id', 
        'residention_address',
        'job_title',
        'total_accumulated_leave',
        'carried_over_leave',
        'carried_over_leave_year',
        'total_leave',
        'total_used',
        'total_reamining',
        'carried_over_expire',
        'carried_over_is_expire',
        'session_id',
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
        // 'password' => 'hashed',
    ];



    public function department(): hasOne
    {
        return $this->hasOne(Department::class,'id','department_id');
    }

    public function reportees()
    {
        return $this->hasMany(Reportee::class,'employee_id','id');
    }

    public function EmergencyContact()
    {
        return $this->hasMany(EmergencyContact::class,);
    }


    public function reportingTo(): hasOne
    {
        return $this->hasOne(User::class,'id','reporting_to');
    }

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class,'employee_id','id');
    }

    public function manager(): hasOne
    {
        return $this->hasOne(User::class,'id','manager_id');
    }

    public function languages()
    {
        return $this->belongsTo(Language::class);
    }

    public function Image()
    {
        return $this->belongsTo(UploadFile::class ,'file_id');
    }
        
    public function languagesEmp()
    {
        return $this->hasMany(Language::class,'id','language_id');
    }
    public function skills()
    {
        return $this->hasMany(Skill::class,'employee_id','id');
    }
    public function education()
    {
        return $this->hasMany(Education::class,'employee_id','id');
    }
    public function publicHoliday()
    {
        return $this->hasMany(Holiday::class,'country','nationality');
    }
    public function county(){

        return $this->belongsTo(Country::class ,'nationality');
    }
    
        public function goaloverview(){

        return $this->hasMany(Goal::class,'user_id');   
    }
    
    public function goalStatus(){

        return $this->hasMany(Goal::class ,'user_id');
    } 
    
    public function Profile(){

        return $this->belongsTo(UploadFile::class ,'file_id');
    }
     
    public function leaveHistory(){

        return $this->hasMany(EmployeeLeaveHistory::class ,'employee_id');
    } 

    public function employeeRole()
    {
        return $this->hasMany(ModelHasRole::class ,'model_id','id');
    }
    
}
