<?php

namespace Processton\Locale\Filament\Resources\RegionResource\Widgets;

use Filament\Widgets\StatsOverviewWidget\Stat;
use Processton\Locale\Models\Region;

class RegionCountWidget
{

    public static function getStat(): Stat
    {
        return Stat::make('Regions', Region::count())
            // ->description('32k increase')
            ->descriptionIcon('majestic-map-marker-path-line')
            // ->chart([23, 45, 76, 12, 26, 15, 16])
            ->color('success');
    }
}
