<?php
namespace Processton\AccessControll;

use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;

class AccessControllPanelProvider extends PanelProvider
{

    public function panel(Panel $panel): Panel
    {

        $panel = $panel
            ->id('access-controll')
            ->path('access-controll')
            ->topNavigation(true)
            ->brandName('Access Controll')
            ->brandLogo('/img/access-controll.png')
            ->maxContentWidth(MaxWidth::Full)
            ->colors([
                'primary' => Color::hex('#333333'),
            ])
            ->pages([
                Pages\Dashboard::class,
            ])
            ->middleware(config('panels.access-controll.middleware.panel') ?? [])
            ->authMiddleware(config('panels.access-controll.middleware.auth') ?? [])
            ->plugins([
                AccessControllPlugin::make()
            ])
            ->resources([])
            ->widgets([]);

        return $panel;

    }

}
