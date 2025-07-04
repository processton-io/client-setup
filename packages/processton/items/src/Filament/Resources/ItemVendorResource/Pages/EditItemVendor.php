<?php

namespace Processton\Items\Filament\Resources\ItemVendorResource\Pages;

use Processton\Items\Filament\Resources\ItemVendorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItemVendor extends EditRecord
{
    protected static string $resource = ItemVendorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
