<?php

namespace Processton\Items\Filament\Resources\ItemProductStockResource\Pages;

use Processton\Items\Filament\Resources\ItemProductStockResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItemProductStocks extends ListRecords
{
    protected static string $resource = ItemProductStockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
