<?php

namespace App\Providers\Filament;

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
use Processton\Company\CompanyPlugin;
use Processton\Customer\CustomerPlugin;
use Processton\Contact\ContactPlugin;
use Processton\Items\ItemsPlugin;
use Processton\Lead\LeadPlugin;

class CrmPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('crm')
            ->path('crm')
            ->brandName('CRM')
            ->topNavigation(true)
            ->colors([
                'primary' => Color::hex('#333333'),
            ])
            ->maxContentWidth('full')
            ->brandLogo('/img/crm.png')
            ->discoverResources(in: app_path('Filament/App/Resources'), for: 'App\\Filament\\App\\Resources')
            ->discoverPages(in: app_path('Filament/App/Pages'), for: 'App\\Filament\\App\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/App/Widgets'), for: 'App\\Filament\\App\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                ...config('panels.middleware.web',[]),
            ])
            ->authMiddleware([
                ...config('panels.middleware.auth',[]),
            ])
            ->plugins([
                LeadPlugin::make(),
                CustomerPlugin::make(),
                CompanyPlugin::make(),
                ContactPlugin::make(),
                ItemsPlugin::make(),
            ]);
    }
}
