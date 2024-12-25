<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;

class PdfUpload extends Model
{
    use HasFactory;

    protected $table = 'pdf_uploads'; 
    protected $fillable = ['file_name','category','file_path','user_id','department_id','session_id'];

    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope());
    }
}
