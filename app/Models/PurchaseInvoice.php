<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
{
    protected $fillable = [
        'supplier_id',
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

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
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
