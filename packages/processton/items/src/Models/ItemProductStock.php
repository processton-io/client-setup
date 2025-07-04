<?php

namespace Processton\Items\Models;

use Illuminate\Database\Eloquent\Model;
use Processton\Items\Models\Item;
use Processton\Items\Models\Product;
use Processton\Locale\Models\Currency;

class ItemProductStock extends Model
{
    protected $fillable = [
        'item_id',
        'product_id',
        'quantity',
        'cost_price',
        'selling_price',
        'currency_id',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
