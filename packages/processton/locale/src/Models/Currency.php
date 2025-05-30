<?php

namespace Processton\Locale\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{

    protected $guarded = [];



    public static function convertTocurrency(float $amount, string $toCurrency, $fromCurrency): float
    {
        $conversion = CurrencyConversion::query()
            ->where('from_currency_id', $fromCurrency)
            ->where('to_currency_id', $toCurrency)
            ->firstOrFail();

        return $amount; // For now, just return the original amount.
    }


}
