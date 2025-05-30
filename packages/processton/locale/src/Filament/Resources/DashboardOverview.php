<?php

namespace Processton\Locale\Filament\Resources;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Processton\Locale\Filament\Resources\CityResource\Widgets\CityCountsWidget;
use Processton\Locale\Filament\Resources\CountryResource\Widgets\CountryCountWidget;
use Processton\Locale\Filament\Resources\RegionResource\Widgets\RegionCountWidget;
use Processton\Locale\Filament\Resources\ZoneResource\Widgets\ZonesCountWidget;

class DashboardOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';

    protected function getStats(): array
    {
        return [
            RegionCountWidget::getStat(),
            CountryCountWidget::getStat(),
            CityCountsWidget::getStat(),
            ZonesCountWidget::getStat()
        ];
    }
}
