<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    protected $fillable = ['user_id', 'registration_id', 'name', 'email', 'phone', 'address', 'nation'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function statuses()
    // {
    //     return $this->hasMany(DocumentStatus::class)->latest('updated_at');
    // }

    public function statuses()
    {
        return $this->hasMany(DocumentStatus::class, 'document_id');
    }

    public function category()
    {
        return $this->hasMany(categories::class, 'category_id');
    }

    public function latestStatus()
    {
        return $this->hasOne(DocumentStatus::class)->latestOfMany();
    }
}
