<?php

namespace Processton\Locale\Filament\Resources\CurrencyConversionResource\Pages;

use Processton\Locale\Filament\Resources\CurrencyConversionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Http;
use Processton\Locale\Models\Currency;
use Processton\Locale\Models\CurrencyConversion;
use Processton\Org\Models\Org;

class ListCurrencyConversions extends ListRecords
{
    protected static string $resource = CurrencyConversionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('updateConversionTable')
                ->label('Update Conversion Table')
                ->action(fn () => $this->updateConversionTable())
                ->color('primary'),
        ];
    }

    protected function updateConversionTable()
    {

        //Fetch primary and secondary currencies
        $currencies = Org::whereIn('org_key', ['primary_currency', 'other_currencies'])
            ->get();
        $primaryCurrencyConfig = $currencies->where('org_key', 'primary_currency')->first();
        $otherCurrencies = $currencies->where('org_key', 'other_currencies')->first();

        $primaryCurrency = Currency::find($primaryCurrencyConfig->org_value);

        $method = 'apilayer';

        if($method == 'apilayer'){
            $conversionRates = $this->fetchConversionRatesFromApiLayer($primaryCurrency->code);
            
            
            foreach ($conversionRates as $currencyCode => $conversionRate) {
                $currency = Currency::where('code', $currencyCode)->first();
                if (!$currency) {
                    continue; // Skip if the currency is not found
                }
                
                // Save the conversion rate to the database
                CurrencyConversion::updateOrCreate(
                    [
                        'from_currency_id' => $primaryCurrency->id,
                        'to_currency_id' => $currency->id,
                    ],
                    [
                        'conversion_rate' => $conversionRate,
                    ]
                );
            }

        }
        elseif($method == 'polygon'){

            foreach (json_decode($otherCurrencies->org_value, true) as $oc) {

                $currency = Currency::find($oc);
                if (!$currency) {
                    continue; // Skip if the currency is not found
                }
                
                // Fetch the conversion rate from the API
                $conversionRate = $this->fetchConversionRateFromPolygon($primaryCurrency->code, $currency->code);
                
                // Save the conversion rate to the database
                CurrencyConversion::updateOrCreate(
                    [
                        'from_currency_id' => $primaryCurrency->org_value,
                        'to_currency_id' => $currency->id,
                    ],
                    [
                        'conversion_rate' => $conversionRate,
                    ]
                );
            }
        }

    }

    public function fetchConversionRateFromPolygon($fromCurrency, $toCurrency)
    {
        $response = Http::get("https://api.polygon.io/v1/conversion/$fromCurrency/$toCurrency?apiKey=" . config('services.polygon.access_key'));
        
        if ($response->successful()) {
            $return = $response->json();

            return $return['converted'];
        }else{
            return null;
        }
    }

    public function fetchConversionRatesFromApiLayer($fromCurrency)
    {
        $response = Http::get("https://data.fixer.io/api/latest?base=$fromCurrency&access_key=" . config('services.apilayer.access_key'));
        
        if ($response->successful()) {
            $return = $response->json();

            return $return['rates'];
        }else{
            return null;
        }
    }
}
