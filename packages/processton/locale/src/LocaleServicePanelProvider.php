<?php

namespace Processton\Locale;

use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Widgets;
use Processton\Locale\Filament\Resources\DashboardOverview;

class LocaleServicePanelProvider extends PanelProvider
{

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('locale')
            ->path('locale')
            ->topNavigation(true)
            ->brandName('Localization')
            ->brandLogo('/img/locale.png')
            ->maxContentWidth(MaxWidth::Full)
            ->colors([
                'primary' => Color::hex('#333333'),
            ])
            ->resources([])
            ->plugins([
                LocalePlugin::make()
            ])
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                DashboardOverview::class,
            ])
            ->middleware(config('panels.locale.middleware.panel') ?? [])
            ->authMiddleware(config('panels.locale.middleware.auth') ?? []);
    }

}
