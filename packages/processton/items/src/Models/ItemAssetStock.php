<?php

namespace Processton\Items\Models;

use Illuminate\Database\Eloquent\Model;
use Processton\Items\Models\Asset;
use Processton\Items\Models\Item;
use Processton\Locale\Models\Currency;

class ItemAssetStock extends Model
{
    protected $fillable = [
        'item_id',
        'asset_id',
        'quantity',
        'cost_price',
        'selling_price',
        'currency_id',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
