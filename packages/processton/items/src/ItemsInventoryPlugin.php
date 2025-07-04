<?php

declare(strict_types=1);

namespace Processton\Items;

use Filament\Pages;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use Processton\Items\Filament\Resources\ItemAssetStockResource;
use Processton\Items\Filament\Resources\ItemProductStockResource;
use Processton\Items\Filament\Resources\ItemVendorResource;
use Processton\Items\Filament\Resources\PurchaseOrderResource;

class ItemsInventoryPlugin implements Plugin
{
    use EvaluatesClosures;

    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'inventory';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            ItemAssetStockResource::class,
            ItemProductStockResource::class,
            ItemVendorResource::class,
            PurchaseOrderResource::class,
        ]);

        // $panel->pages([
        //     Pages\Dashboard::class,
        // ]);
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
