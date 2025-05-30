<?php

declare(strict_types=1);

namespace Processton\Company;

use Filament\Pages;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use Processton\Company\Filament\Resources\CompanyResource;

class CompanyPlugin implements Plugin
{
    use EvaluatesClosures;

    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'company';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            CompanyResource::class
        ]);

        $panel->pages([
            Pages\Dashboard::class,
        ]);
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
