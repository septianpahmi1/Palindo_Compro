<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'position',
        'email',
        'phone',
        'phone_business',
        'whatsapp',
        'address',
        'website',
        'description',

    ];
}
