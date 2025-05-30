<?php

namespace Processton\Locale\Filament\Resources\CityResource\Widgets;

use Filament\Widgets\StatsOverviewWidget\Stat;
use Processton\Locale\Models\City;

class CityCountsWidget
{

    public static function getStat(): Stat
    {
        return Stat::make('Cities', City::count())
            // ->description('7% increase')
            ->descriptionIcon('solar-city-line-duotone')
            // ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('success');
    }
}
