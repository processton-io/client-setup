<?php

namespace Processton\Items\Filament\Resources\ItemsResource\Pages;

use Processton\Items\Filament\Resources\ItemsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItems extends ListRecords
{
    protected static string $resource = ItemsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
