<?php

namespace Processton\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Processton\OrderDatabase\Factories\OrderFactory;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'customer_id',
        'total_amount',
        'currency',
        'order_date',
        'shipping_address',
        'billing_address',
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return OrderFactory::new();
    }
}
