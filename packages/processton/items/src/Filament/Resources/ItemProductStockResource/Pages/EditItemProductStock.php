<?php

namespace Processton\Items\Filament\Resources\ItemProductStockResource\Pages;

use Processton\Items\Filament\Resources\ItemProductStockResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItemProductStock extends EditRecord
{
    protected static string $resource = ItemProductStockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
