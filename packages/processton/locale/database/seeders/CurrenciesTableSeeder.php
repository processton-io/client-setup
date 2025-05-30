<?php

namespace Processton\LocaleDatabase\Seeders;

use Processton\Locale\Models\Currency;
use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            [
                'color' => '#6B8E23', // Olive green for US Dollar
                'name' => 'US Dollar',
                'code' => 'USD',
                'symbol' => '$',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#00247D', // Dark blue for British Pound
                'name' => 'British Pound',
                'code' => 'GBP',
                'symbol' => '£',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FFD700', // Gold for Euro
                'name' => 'Euro',
                'code' => 'EUR',
                'symbol' => '€',
                'precision' => '2',
                'thousand_separator' => '.',
                'decimal_separator' => ',',
                'swap_currency_symbol' => true,
            ],
            [
                'color' => '#008000', // Green for South African Rand
                'name' => 'South African Rand',
                'code' => 'ZAR',
                'symbol' => 'R',
                'precision' => '2',
                'thousand_separator' => '.',
                'decimal_separator' => ',',
            ],
            [
                'color' => '#FF4500', // Orange for Danish Krone
                'name' => 'Danish Krone',
                'code' => 'DKK',
                'symbol' => 'kr',
                'precision' => '2',
                'thousand_separator' => '.',
                'decimal_separator' => ',',
                'swap_currency_symbol' => true,
            ],
            // [
            //     'color' => '#4682B4', // Steel blue for Israeli Shekel
            //     'name' => 'Israeli Shekel',
            //     'code' => 'ILS',
            //     'symbol' => 'NIS ',
            //     'precision' => '2',
            //     'thousand_separator' => ',',
            //     'decimal_separator' => '.',
            // ],
            [
                'color' => '#B22222', // Firebrick red for Swedish Krona
                'name' => 'Swedish Krona',
                'code' => 'SEK',
                'symbol' => 'kr',
                'precision' => '2',
                'thousand_separator' => '.',
                'decimal_separator' => ',',
                'swap_currency_symbol' => true,
            ],
            [
                'color' => '#FFD700', // Gold for Kenyan Shilling
                'name' => 'Kenyan Shilling',
                'code' => 'KES',
                'symbol' => 'KSh ',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#8B0000', // Dark red for Kuwaiti Dinar
                'name' => 'Kuwaiti Dinar',
                'code' => 'KWD',
                'symbol' => 'KWD ',
                'precision' => '3',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#1E90FF', // Dodger blue for Canadian Dollar
                'name' => 'Canadian Dollar',
                'code' => 'CAD',
                'symbol' => 'C$',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FF6347', // Tomato red for Philippine Peso
                'name' => 'Philippine Peso',
                'code' => 'PHP',
                'symbol' => 'P ',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FF4500', // Orange for Nepali Rupee
                'name' => 'Nepali Rupee',
                'code' => 'NPR',
                'symbol' => 'रू',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FF9933', // Saffron for Indian Rupee
                'name' => 'Indian Rupee',
                'code' => 'INR',
                'symbol' => '₹',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#00008B', // Dark blue for Australian Dollar
                'name' => 'Australian Dollar',
                'code' => 'AUD',
                'symbol' => '$',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#00BFFF', // Deep sky blue for Singapore Dollar
                'name' => 'Singapore Dollar',
                'code' => 'SGD',
                'symbol' => 'S$',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#8A2BE2', // Blue violet for Norske Kroner
                'name' => 'Norske Kroner',
                'code' => 'NOK',
                'symbol' => 'kr',
                'precision' => '2',
                'thousand_separator' => '.',
                'decimal_separator' => ',',
                'swap_currency_symbol' => true,
            ],
            [
                'color' => '#32CD32', // Lime green for New Zealand Dollar
                'name' => 'New Zealand Dollar',
                'code' => 'NZD',
                'symbol' => '$',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FF4500', // Orange for Vietnamese Dong
                'name' => 'Vietnamese Dong',
                'code' => 'VND',
                'symbol' => '₫',
                'precision' => '0',
                'thousand_separator' => '.',
                'decimal_separator' => ',',
            ],
            [
                'color' => '#FFD700', // Gold for Swiss Franc
                'name' => 'Swiss Franc',
                'code' => 'CHF',
                'symbol' => 'Fr.',
                'precision' => '2',
                'thousand_separator' => '\'',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#228B22', // Forest green for Guatemalan Quetzal
                'name' => 'Guatemalan Quetzal',
                'code' => 'GTQ',
                'symbol' => 'Q',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FF8C00', // Dark orange for Malaysian Ringgit
                'name' => 'Malaysian Ringgit',
                'code' => 'MYR',
                'symbol' => 'RM',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#8B0000', // Dark red for Brazilian Real
                'name' => 'Brazilian Real',
                'code' => 'BRL',
                'symbol' => 'R$',
                'precision' => '2',
                'thousand_separator' => '.',
                'decimal_separator' => ',',
            ],
            [
                'color' => '#FF6347', // Tomato red for Thai Baht
                'name' => 'Thai Baht',
                'code' => 'THB',
                'symbol' => '฿',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#008000', // Green for Nigerian Naira
                'name' => 'Nigerian Naira',
                'code' => 'NGN',
                'symbol' => '₦',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#000000', // Updated to appropriate colors
                'name' => 'Argentine Peso',
                'code' => 'ARS',
                'symbol' => '$',
                'precision' => '2',
                'thousand_separator' => '.',
                'decimal_separator' => ',',
            ],
            [
                'color' => '#00A859', // Green for Bangladeshi Taka
                'name' => 'Bangladeshi Taka',
                'code' => 'BDT',
                'symbol' => 'Tk',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#007FFF', // Blue for United Arab Emirates Dirham
                'name' => 'United Arab Emirates Dirham',
                'code' => 'AED',
                'symbol' => 'DH ',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FF0000', // Red for Hong Kong Dollar
                'name' => 'Hong Kong Dollar',
                'code' => 'HKD',
                'symbol' => 'HK$',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FF4500', // Orange for Indonesian Rupiah
                'name' => 'Indonesian Rupiah',
                'code' => 'IDR',
                'symbol' => 'Rp',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#008000', // Green for Mexican Peso
                'name' => 'Mexican Peso',
                'code' => 'MXN',
                'symbol' => '$',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FFD700', // Gold for Egyptian Pound
                'name' => 'Egyptian Pound',
                'code' => 'EGP',
                'symbol' => 'E£',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FF6347', // Tomato red for Colombian Peso
                'name' => 'Colombian Peso',
                'code' => 'COP',
                'symbol' => '$',
                'precision' => '2',
                'thousand_separator' => '.',
                'decimal_separator' => ',',
            ],
            [
                'color' => '#008080', // Teal for Central African Franc
                'name' => 'Central African Franc',
                'code' => 'XAF',
                'symbol' => 'CFA ',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FFA500', // Orange for West African Franc
                'name' => 'West African Franc',
                'code' => 'XOF',
                'symbol' => 'CFA ',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FF4500', // Orange for Chinese Renminbi
                'name' => 'Chinese Renminbi',
                'code' => 'CNY',
                'symbol' => 'RMB ',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FFD700', // Gold for Rwandan Franc
                'name' => 'Rwandan Franc',
                'code' => 'RWF',
                'symbol' => 'RF ',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#008000', // Green for Tanzanian Shilling
                'name' => 'Tanzanian Shilling',
                'code' => 'TZS',
                'symbol' => 'TSh ',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FF4500', // Orange for Netherlands Antillean Guilder
                'name' => 'Netherlands Antillean Guilder',
                'code' => 'ANG',
                'symbol' => 'NAƒ',
                'precision' => '2',
                'thousand_separator' => '.',
                'decimal_separator' => ',',
            ],
            [
                'color' => '#FF6347', // Tomato red for Trinidad and Tobago Dollar
                'name' => 'Trinidad and Tobago Dollar',
                'code' => 'TTD',
                'symbol' => 'TT$',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#4682B4', // Steel blue for East Caribbean Dollar
                'name' => 'East Caribbean Dollar',
                'code' => 'XCD',
                'symbol' => 'EC$',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FFD700', // Gold for Ghanaian Cedi
                'name' => 'Ghanaian Cedi',
                'code' => 'GHS',
                'symbol' => '‎GH₵',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#8B0000', // Dark red for Bulgarian Lev
                'name' => 'Bulgarian Lev',
                'code' => 'BGN',
                'symbol' => 'Лв.',
                'precision' => '2',
                'thousand_separator' => ' ',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FF4500', // Orange for Aruban Florin
                'name' => 'Aruban Florin',
                'code' => 'AWG',
                'symbol' => 'Afl. ',
                'precision' => '2',
                'thousand_separator' => ' ',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FFD700', // Gold for Turkish Lira
                'name' => 'Turkish Lira',
                'code' => 'TRY',
                'symbol' => 'TL ',
                'precision' => '2',
                'thousand_separator' => '.',
                'decimal_separator' => ',',
            ],
            [
                'color' => '#FFD700', // Gold for Romanian New Leu
                'name' => 'Romanian New Leu',
                'code' => 'RON',
                'symbol' => 'RON',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FF4500', // Orange for Croatian Kuna
                'name' => 'Croatian Kuna',
                'code' => 'HRK',
                'symbol' => 'kn',
                'precision' => '2',
                'thousand_separator' => '.',
                'decimal_separator' => ',',
            ],
            [
                'color' => '#008000', // Green for Saudi Riyal
                'name' => 'Saudi Riyal',
                'code' => 'SAR',
                'symbol' => '‎SِAR',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FF6347', // Tomato red for Japanese Yen
                'name' => 'Japanese Yen',
                'code' => 'JPY',
                'symbol' => '¥',
                'precision' => '0',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#4682B4', // Steel blue for Maldivian Rufiyaa
                'name' => 'Maldivian Rufiyaa',
                'code' => 'MVR',
                'symbol' => 'Rf',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FFA500', // Orange for Costa Rican Colón
                'name' => 'Costa Rican Colón',
                'code' => 'CRC',
                'symbol' => '₡',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FF9933', // Saffron for Pakistani Rupee
                'name' => 'Pakistani Rupee',
                'code' => 'PKR',
                'symbol' => 'Rs ',
                'precision' => '0',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FFD700', // Gold for Polish Zloty
                'name' => 'Polish Zloty',
                'code' => 'PLN',
                'symbol' => 'zł',
                'precision' => '2',
                'thousand_separator' => ' ',
                'decimal_separator' => ',',
                'swap_currency_symbol' => true,
            ],
            [
                'color' => '#FF4500', // Orange for Sri Lankan Rupee
                'name' => 'Sri Lankan Rupee',
                'code' => 'LKR',
                'symbol' => 'LKR',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
                'swap_currency_symbol' => true,
            ],
            [
                'color' => '#4682B4', // Steel blue for Czech Koruna
                'name' => 'Czech Koruna',
                'code' => 'CZK',
                'symbol' => 'Kč',
                'precision' => '2',
                'thousand_separator' => ' ',
                'decimal_separator' => ',',
                'swap_currency_symbol' => true,
            ],
            [
                'color' => '#FF6347', // Tomato red for Uruguayan Peso
                'name' => 'Uruguayan Peso',
                'code' => 'UYU',
                'symbol' => '$',
                'precision' => '2',
                'thousand_separator' => '.',
                'decimal_separator' => ',',
            ],
            [
                'color' => '#1E90FF', // Dodger blue for Namibian Dollar
                'name' => 'Namibian Dollar',
                'code' => 'NAD',
                'symbol' => '$',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FF4500', // Orange for Tunisian Dinar
                'name' => 'Tunisian Dinar',
                'code' => 'TND',
                'symbol' => '‎د.ت',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FF6347', // Tomato red for Russian Ruble
                'name' => 'Russian Ruble',
                'code' => 'RUB',
                'symbol' => '₽',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#4682B4', // Steel blue for Mozambican Metical
                'name' => 'Mozambican Metical',
                'code' => 'MZN',
                'symbol' => 'MT',
                'precision' => '2',
                'thousand_separator' => '.',
                'decimal_separator' => ',',
                'swap_currency_symbol' => true,
            ],
            [
                'color' => '#FFD700', // Gold for Omani Rial
                'name' => 'Omani Rial',
                'code' => 'OMR',
                'symbol' => 'ر.ع.',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FF4500', // Orange for Ukrainian Hryvnia
                'name' => 'Ukrainian Hryvnia',
                'code' => 'UAH',
                'symbol' => '₴',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#4682B4', // Steel blue for Macanese Pataca
                'name' => 'Macanese Pataca',
                'code' => 'MOP',
                'symbol' => 'MOP$',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FF6347', // Tomato red for Taiwan New Dollar
                'name' => 'Taiwan New Dollar',
                'code' => 'TWD',
                'symbol' => 'NT$',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FFD700', // Gold for Dominican Peso
                'name' => 'Dominican Peso',
                'code' => 'DOP',
                'symbol' => 'RD$',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FF4500', // Orange for Chilean Peso
                'name' => 'Chilean Peso',
                'code' => 'CLP',
                'symbol' => '$',
                'precision' => '2',
                'thousand_separator' => '.',
                'decimal_separator' => ',',
            ],
            [
                'color' => '#4682B4', // Steel blue for Serbian Dinar
                'name' => 'Serbian Dinar',
                'code' => 'RSD',
                'symbol' => 'RSD',
                'precision' => '2',
                'thousand_separator' => '.',
                'decimal_separator' => ',',
            ],
            [
                'color' => '#FF6347', // Tomato red for Kyrgyzstani som
                'name' => 'Kyrgyzstani som',
                'code' => 'KGS',
                'symbol' => 'С̲ ',
                'precision' => '2',
                'thousand_separator' => '.',
                'decimal_separator' => ',',
            ],
            [
                'color' => '#FFD700', // Gold for Iraqi Dinar
                'name' => 'Iraqi Dinar',
                'code' => 'IQD',
                'symbol' => 'ع.د',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FF4500', // Orange for Peruvian Soles
                'name' => 'Peruvian Soles',
                'code' => 'PEN',
                'symbol' => 'S/',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FFD700', // Gold for Moroccan Dirham
                'name' => 'Moroccan Dirham',
                'code' => 'MAD',
                'symbol' => 'DH',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FF4500', // Orange for Jamaican Dollar
                'name' => 'Jamaican Dollar',
                'code' => 'JMD',
                'symbol' => '$',
                'precision' => '0',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
            ],
            [
                'color' => '#FFD700', // Gold for Macedonian Denar
                'name' => 'Macedonian Denar',
                'code' => 'MKD',
                'symbol' => 'ден',
                'precision' => '0',
                'thousand_separator' => '.',
                'decimal_separator' => ',',
                'swap_currency_symbol' => true,
            ],
        ];


        foreach ($currencies as $currency) {
            Currency::create($currency);
        }
    }
}
