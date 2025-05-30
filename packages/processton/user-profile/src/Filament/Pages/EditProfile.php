<?php

namespace Processton\UserProfile\Filament\Pages;

use Filament\Pages\Page;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Filament\Support\Enums\MaxWidth;

class EditProfile extends BaseEditProfile
{
    protected static ?string $navigationLabel = 'Edit Profile';
    protected static ?string $slug = 'edit';
    protected static ?string $title = 'Basic Profile';
    protected static string $view = 'user-profile::edit';
    

    // public static function getRelativeRouteName(): string
    // {
    //     return 'profile';
    // }

    // public static function getSlug(): string
    // {
    //     return static::$slug ?? 'profile';
    // }

    public function getLayout(): string
    {
        return 'filament-panels::components.layout.index';
    }

    protected function getLayoutData(): array
    {
        return [
            'hasTopbar' => $this->hasTopbar(true),
            'maxWidth' => MaxWidth::Full,
        ];
    }
}
