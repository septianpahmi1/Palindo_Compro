<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpendingStatus extends Model
{
    protected $fillable = [
        'spending_id',
        'note',
        'status',

    ];

    public function spending()
    {
        return $this->belongsTo(Spending::class, 'spending_id');
    }
}
