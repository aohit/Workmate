<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;

class Training extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $table = "trainings";
    protected $fillable = [
        'title', 'status', 'description', 'start_time', 'end_time', 'certificate', 'user_id','institution_or_training_provider','certificate_award','completion_date','start_date','session_id'
    ];

    /**
     * Get the user that owns the training.
     */

     protected static function booted()
     {
         static::addGlobalScope(new ActiveScope());
     }
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
