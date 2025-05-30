<?php

declare(strict_types=1);

namespace Processton\Org;

use Filament\Pages;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use Processton\Org\Filament\Pages\OrgSettings;

class OrgPlugin implements Plugin
{
    use EvaluatesClosures;

    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'org';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            // OrgResource::class
        ]);

        $panel->pages([
            OrgSettings::class,
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
