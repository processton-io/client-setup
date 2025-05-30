<?php

namespace Processton\AccessControll\Filament\Resources\UserResource\Pages;

use Processton\AccessControll\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Filters\Tabs\Tab;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    // public function getTabs(): array
    // {
    //     return [
    //         'all' => Tab::make('All'),

    //         'active_vips' => Tab::make('Active VIPs')
    //             ->modifyQueryUsing(
    //                 fn($query) =>
    //                 $query->where('status', 'active')->where('type', 'vip')
    //             ),

    //         'inactive_regulars' => Tab::make('Inactive Regulars')
    //             ->modifyQueryUsing(
    //                 fn($query) =>
    //                 $query->where('status', 'inactive')->where('type', 'regular')
    //             ),

    //         'pending' => Tab::make('Pending Users')
    //             ->modifyQueryUsing(
    //                 fn($query) =>
    //                 $query->where('status', 'pending')
    //             ),
    //     ];
    // }
}
