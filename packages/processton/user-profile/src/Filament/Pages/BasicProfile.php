<?php

namespace Processton\UserProfile\Filament\Pages;

use Filament\Pages\Page;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Filament\Support\Enums\MaxWidth;

class BasicProfile extends Page
{
    protected static ?string $navigationLabel = 'Basic Profile';
    protected static ?string $slug = 'basic';
    protected static ?string $title = 'Basic Profile';
    protected static string $view = 'user-profile::profile';
    

    
}
