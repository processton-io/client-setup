<?php

namespace Processton\Company\Filament\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationLabel = 'Company Dashboard';
    protected static ?string $title = 'Company Dashboard';
    protected static string $view = 'company::dashboard';
}
