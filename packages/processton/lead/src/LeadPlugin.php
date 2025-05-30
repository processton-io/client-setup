<?php

declare(strict_types=1);

namespace Processton\Lead;

use Filament\Pages;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use Processton\Lead\Filament\Pages\LeadsKanban;
use Processton\Lead\Filament\Resources\LeadResource;

class LeadPlugin implements Plugin
{
    use EvaluatesClosures;

    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'lead';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            // LeadResource::class
        ]);

        $panel->pages([
            LeadsKanban::class
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
