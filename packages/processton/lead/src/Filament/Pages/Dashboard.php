<?php

namespace Processton\Lead\Filament\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title = 'Custom Dashboard';
    protected static string $view = 'locale::dashboard';
}
