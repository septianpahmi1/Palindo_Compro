<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmissionStatus extends Model
{
    protected $fillable = [
        'submission_id',
        'status',
        'note',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class, 'submission_id');
    }
}
