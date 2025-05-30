<?php

namespace Processton\Contact\Filament\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationLabel = 'Contact Dashboard';
    protected static ?string $title = 'Contact Dashboard';
    protected static string $view = 'contact::dashboard';
}
