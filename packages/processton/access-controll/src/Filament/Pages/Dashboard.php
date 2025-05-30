<?php

namespace Processton\AccessControll\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\View\View;

class Dashboard extends Page
{
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title = 'Custom Dashboard';
    protected static string $view = 'locale::dashboard';

}
