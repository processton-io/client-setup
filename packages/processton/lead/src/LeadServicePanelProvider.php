<?php

namespace Processton\Lead;

use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Widgets;
use Processton\Lead\Filament\Resources\DashboardOverview;

class LeadServicePanelProvider extends PanelProvider
{

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('lead')
            ->path('lead')
            ->topNavigation(true)
            ->brandName('Lead')
            ->brandLogo('/img/locale.png')
            ->maxContentWidth(MaxWidth::Full)
            ->colors([
                'primary' => Color::hex('#333333'),
            ])
            ->resources([])
            ->plugins([
                LeadPlugin::make()
            ])
            ->middleware(config('panels.locale.middleware.panel') ?? [])
            ->authMiddleware(config('panels.locale.middleware.auth') ?? []);
    }

}
