<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\Widget;

class PresenceUserCountWidget extends Widget
{
    protected static string $view = 'filament.widgets.presence-user-count-widget';

    protected int|string|array $columnSpan = 1;

    public function getTodayUserCount(): int
    {
        return User::whereDate('created_at', now()->toDateString())->count();
    }

    public function getOnlineUserCount(): int
    {
        return User::where('last_online', '>=', now()->subMinutes(5))->count();
    }
}
