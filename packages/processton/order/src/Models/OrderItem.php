<?php

namespace Processton\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Processton\OrderDatabase\Factories\OrderItemFactory;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'item_id',
        'item_type', // e.g., 'product', 'service', 'asset'
        'quantity',
        'price',
        'total_price',
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return OrderItemFactory::new();
    }
}
