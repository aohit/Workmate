<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplinary extends Model
{
    use HasFactory;

    protected $table = 'disciplinary_letters';

    protected $fillable = [
        'title',
        'issue_date',
        'department_id',
        'action_type_id',
        'file', 
        'employee_id',
        'session_id'
    ];

    public function actionType()
    {
        return $this->belongsTo(DisciplinaryActionType::class, 'action_type_id');
    }

    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
