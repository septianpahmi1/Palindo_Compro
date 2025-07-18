<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentStatus extends Model
{
    protected $fillable = ['document_id', 'category_id', 'status'];

    public function document()
    {
        return $this->belongsTo(Documents::class, 'document_id');
    }
    public function category()
    {
        return $this->belongsTo(categories::class, 'category_id');
    }
}
