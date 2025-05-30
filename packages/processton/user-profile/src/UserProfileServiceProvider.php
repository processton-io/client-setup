<?php
namespace Processton\UserProfile;


use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Processton\Locale\Filament\Resources\DashboardOverview;
use Processton\UserProfile\Filament\Pages\BasicProfile;
use Processton\UserProfile\Filament\Pages\EditProfile;
use Filament\Navigation\NavigationItem;

class UserProfileServiceProvider extends PanelProvider
{

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('profile')
            ->path('profile')
            ->profile(EditProfile::class)
            ->topNavigation(false)
            ->brandName('Profile')
            ->brandLogo('/img/profile.png')
            ->maxContentWidth(MaxWidth::Full)
            ->colors([
                'primary' => Color::hex('#333333'),
            ])
            ->navigationItems([
            ])
            ->resources([
            ])
            // ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            // ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                BasicProfile::class,
            ])
            ->widgets([
                // DashboardOverview::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'user-profile');

        if ($this->app->runningInConsole()) {
            // Export the migration
            // $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }
        // $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
    }
}
