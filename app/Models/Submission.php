<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'user_id',
        'image',
        'title',
        'description',
        'importance',
        'total',
        'quantity',
        'price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function statuses()
    {
        return $this->hasMany(SubmissionStatus::class, 'submission_id');
    }
}
