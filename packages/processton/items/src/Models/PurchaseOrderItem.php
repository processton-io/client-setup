<?php

namespace Processton\Items\Models;

use Illuminate\Database\Eloquent\Model;
use Processton\Items\Models\Item;

class PurchaseOrderItem extends Model
{
    protected $fillable = [
        'purchase_order_id',
        'item_id',
        'quantity',
        'unit_price',
        'tax_amount',
        'total_price',
        'notes',
    ];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
