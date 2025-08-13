<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'estimation_id',
        'employee_id',
        'number',
        'date',
        'salary',
        'allowance',
        'deduction',
        'total',
        'date_expired',
        'status',
        'description',
    ];

    public function estimation()
    {
        return $this->belongsTo(Estimation::class, 'estimation_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
