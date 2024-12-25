<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;
class CompanyAnnouncement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'employee_id',
        'background_color_id',
        'text_color_id',
        'status',
        'session_id',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope());
    }

    public function backgroundcolor()
    {
        return $this->belongsTo(Color::class,'background_color_id');
    }

    public function textcolor()
    {
        return $this->belongsTo(Color::class,'text_color_id');
    }

}
