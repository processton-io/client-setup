<?php

declare(strict_types=1);

namespace Processton\Locale;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;

class LocalePlugin implements Plugin
{
    use EvaluatesClosures;

    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'locale';
    }

    public function register(Panel $panel): void
    {

        // if (! Utils::isResourcePublished($panel)) {
            $panel->resources([
                \Processton\Locale\Filament\Resources\CurrencyResource::class,
                \Processton\Locale\Filament\Resources\CityResource::class,
                \Processton\Locale\Filament\Resources\ZoneResource::class,
                \Processton\Locale\Filament\Resources\CountryResource::class,
                \Processton\Locale\Filament\Resources\RegionResource::class,
                \Processton\Locale\Filament\Resources\AddressResource::class,
                \Processton\Locale\Filament\Resources\CurrencyConversionResource::class,

            ]);
        // }
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
