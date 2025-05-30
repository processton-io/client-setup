<?php

namespace Processton\Campaigns;

use Filament\Panel;
use Processton\Campaigns\Filament\Resources\CampaignResource;
use Filament\Contracts\Plugin;

class CampaignPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'campaign';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            CampaignResource::class,
        ]);
    }

    public function boot(Panel $panel): void
    {
        // Implement any boot logic here if needed
    }
}
