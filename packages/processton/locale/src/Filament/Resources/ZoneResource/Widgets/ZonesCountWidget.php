<?php

namespace Processton\Locale\Filament\Resources\ZoneResource\Widgets;

use Filament\Widgets\StatsOverviewWidget\Stat;
use Processton\Locale\Models\Zone;

class ZonesCountWidget
{

    public static function getStat(): Stat
    {
        return Stat::make('Zones', Zone::count())
            // ->description('3% increase')
            ->descriptionIcon('mdi-spider-web')
            // ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('success');
    }
}
