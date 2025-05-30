<?php

namespace Processton\Client;

use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Widgets;
use Processton\Client\Filament\Resources\DashboardOverview;

class ClientServicePanelProvider extends PanelProvider
{

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('client')
            ->path('client')
            ->topNavigation(true)
            ->brandName('Client')
            ->brandLogo('/img/locale.png')
            ->maxContentWidth(MaxWidth::Full)
            ->colors([
                'primary' => Color::hex('#333333'),
            ])
            ->resources([])
            ->plugins([
                ClientPlugin::make()
            ])
            ->middleware(config('panels.locale.middleware.panel') ?? [])
            ->authMiddleware(config('panels.locale.middleware.auth') ?? []);
    }

}
