<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory; 
    protected $fillable = [
        'doc_name',
        'category_id', 
        'file', 
        'status', 
    ];

    public function DocumentCategory(){
        return $this->belongsTo(DocumentCategory::class, 'category_id');
    }
   
}
