<?php

namespace Processton\Items\Filament\Resources\ItemsResource\Pages;

use Processton\Items\Filament\Resources\ItemsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Processton\Items\Filament\Resources\ItemsResource\Mutators\BeforeEdit;

class EditItems extends EditRecord
{
    protected static string $resource = ItemsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return BeforeEdit::mutate($data);
    }

    


}
