<?php

namespace Processton\Customer;

use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Widgets;
use Processton\Customer\Filament\Resources\DashboardOverview;

class CustomerServicePanelProvider extends PanelProvider
{

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('customer')
            ->path('customer')
            ->topNavigation(true)
            ->brandName('Customer')
            ->brandLogo('/img/locale.png')
            ->maxContentWidth(MaxWidth::Full)
            ->colors([
                'primary' => Color::hex('#333333'),
            ])
            ->resources([])
            ->plugins([
                CustomerPlugin::make()
            ])
            ->middleware(config('panels.locale.middleware.panel') ?? [])
            ->authMiddleware(config('panels.locale.middleware.auth') ?? []);
    }

}
