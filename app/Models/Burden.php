<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Burden extends Model
{
    protected $fillable = [
        'estimation_id',
        'number',
        'date',
        'date_expired',
        'total',
        'description',
        'status',
    ];

    public function estimation()
    {
        return $this->belongsTo(Estimation::class, 'estimation_id');
    }
}
