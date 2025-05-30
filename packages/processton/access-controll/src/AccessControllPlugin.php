<?php

declare(strict_types=1);

namespace Processton\AccessControll;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use Processton\AccessControll\Filament\Resources\RoleResource;
use Processton\AccessControll\Filament\Resources\UserResource;

class AccessControllPlugin implements Plugin
{
    use EvaluatesClosures;

    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'access-controll';
    }

    public function register(Panel $panel): void
    {

        $panel->resources([
            UserResource::class,
            RoleResource::class,
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
