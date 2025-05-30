<?php

namespace Processton\Items\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Processton\ItemsDatabase\Factories\ItemsFactory;
use Processton\Locale\Models\Currency;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_type',
        'entity_id',
        'sku',
        'currency_id',
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
        return ItemsFactory::new();
    }

    public function getPriceStringAttribute()
    {
        return $this->price.' ' . $this->currency->symbol;
    }

    public function entity()
    {
        return $this->morphTo();
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'entity_id');
    }

    public function prices()
    {
        return $this->hasMany(ItemPrice::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function getPriceInCurrency($currencyId)
    {
        if ($this->currency_id == $currencyId) {
            return $this->price;
        }

        // Here you would typically convert the price to the desired currency
        // For simplicity, we will just return the original price
        // In a real application, you would use a currency conversion service or logic
        return $this->price; // Placeholder for actual conversion logic
    }


}
