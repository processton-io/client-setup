<?php

namespace Processton\Items\Models;

use Illuminate\Database\Eloquent\Model;
use Processton\Locale\Models\Currency;

class PurchaseOrder extends Model
{
    protected $fillable = [
        'vendor_id',
        'order_number',
        'order_date',
        'expected_delivery_date',
        'total_amount',
        'status', // e.g., pending, completed
        'notes',
        'currency_id',
        'created_by',
    ];

    public function vendor()
    {
        return $this->belongsTo(ItemVendor::class);
    }

    public function orderItems()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
