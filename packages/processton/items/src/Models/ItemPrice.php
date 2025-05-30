<?php

namespace Processton\Items\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Processton\ItemsDatabase\Factories\ItemPricesFactory;

class ItemPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency_id',
        'item_id',
        'price'
    ];

    protected $appends = [
        'price_string'
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return ItemPricesFactory::new();
    }

    public function getPriceStringAttribute()
    {
        return $this->price.' ' . $this->currency->symbol;
    }


    public function entity()
    {
        return $this->morphTo();
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function currency()
    {
        return $this->belongsTo(\Processton\Locale\Models\Currency::class);
    }

}
