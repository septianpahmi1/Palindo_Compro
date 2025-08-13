<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estimation extends Model
{
    protected $fillable = [
        'no_account',
        'title',
        'balance',
        'end_balance',
    ];
}
