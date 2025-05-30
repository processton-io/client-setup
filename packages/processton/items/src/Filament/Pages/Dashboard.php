<?php

namespace Processton\Items\Filament\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationLabel = 'Items Dashboard';
    protected static ?string $title = 'Items Dashboard';
    protected static string $view = 'items::dashboard';
}
