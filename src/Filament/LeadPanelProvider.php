<?php

namespace Processton\Setup\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
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
use Processton\Campaigns\CampaignPlugin;
use Processton\Form\FormPlugin;
use Processton\Locale\LocalePlugin;
use Processton\Lead\LeadPlugin;

class LeadPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('leads')
            ->path('/app/leads')
            ->brandName('Marketing Leads')
            ->topNavigation(true)
            ->maxContentWidth('full')
            ->colors([
                'primary' => Color::hex('#333333'),
            ])
            ->brandLogo('/img/leads.png')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                ...config('panels.middleware.web',[]),
                ...config('panels.locale.middleware.web',[]),
            ])
            ->authMiddleware([
                ...config('panels.middleware.auth',[]),
                ...config('panels.locale.middleware.auth',[]),
            ])->plugins([
                LeadPlugin::make(),
                CampaignPlugin::make(),
                FormPlugin::make(),
            ]);
    }
}
