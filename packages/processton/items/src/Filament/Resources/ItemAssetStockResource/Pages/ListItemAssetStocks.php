<?php

namespace Processton\Items\Filament\Resources\ItemAssetStockResource\Pages;

use Processton\Items\Filament\Resources\ItemAssetStockResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItemAssetStocks extends ListRecords
{
    protected static string $resource = ItemAssetStockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
