<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportCost extends Model
{
    protected $fillable = ['image','user_id','title', 'description', 'status','price'];

     public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    
}
