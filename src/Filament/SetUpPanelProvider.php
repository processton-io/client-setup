<?php

namespace Processton\Setup\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Processton\AccessControll\AccessControllPlugin;
use Processton\Locale\LocalePlugin;
use Processton\Org\OrgPlugin;
use Vormkracht10\FilamentMails\Facades\FilamentMails;

class SetUpPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('setup')
            ->path('/app/setup')
            ->brandName('Setup')
            ->maxContentWidth('full')
            ->colors([
                'primary' => Color::hex('#333333'),
            ])
            ->brandLogo('/img/settings.png')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                \App\Filament\Widgets\PresenceUserCountWidget::class,
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                ...config('panels.middleware.web',[]),
                ...config('panels.setup.middleware.web',[]),
            ])
            ->authMiddleware([
                ...config('panels.middleware.auth',[]),
                ...config('panels.setup.middleware.auth',[]),
            ])->plugins([
                OrgPlugin::make(),
                AccessControllPlugin::make(),
                LocalePlugin::make(),
            ]);
    }
}
