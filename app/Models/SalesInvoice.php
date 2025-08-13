<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesInvoice extends Model
{
    protected $fillable = [
        'customer_id',
        'category_id',
        'estimation_id',
        'number',
        'price',
        'quantity',
        'discount',
        'total',
        'date',
        'ket',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function category()
    {
        return $this->belongsTo(categories::class, 'category_id');
    }
    public function estimation()
    {
        return $this->belongsTo(Estimation::class, 'estimation_id');
    }
}
