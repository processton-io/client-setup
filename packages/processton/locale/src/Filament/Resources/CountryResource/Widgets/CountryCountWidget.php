<?php

namespace Processton\Locale\Filament\Resources\CountryResource\Widgets;

use Filament\Widgets\StatsOverviewWidget\Stat;
use Processton\Locale\Models\Country;

class CountryCountWidget
{

    public static function getStat(): Stat
    {
        return Stat::make('Countries', Country::count())
            // ->description('7% increase')
            ->descriptionIcon('heroicon-s-flag')
            // ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('danger');
    }
}
