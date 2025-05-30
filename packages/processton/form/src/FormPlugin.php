<?php

namespace Processton\Form;

use Filament\Panel;
use Processton\Form\Filament\Resources\FormResource;
use Filament\Contracts\Plugin;

class FormPlugin implements Plugin
{
    public function register(Panel $panel): void
    {
        $panel->resources([
            FormResource::class,
        ]);
    }

    public function boot(Panel $panel): void
    {
        // Add boot logic here if needed
    }

    public function getId(): string
    {
        return 'processton-form-plugin';
    }

    public static function make(): static
    {
        return new static();
    }
}
