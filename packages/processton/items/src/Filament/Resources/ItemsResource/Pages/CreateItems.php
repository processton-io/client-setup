<?php

namespace Processton\Items\Filament\Resources\ItemsResource\Pages;

use Processton\Items\Filament\Resources\ItemsResource;
use Filament\Resources\Pages\CreateRecord;
use Processton\Items\Filament\Resources\ItemsResource\Forms\ItemsForm;
use Processton\Items\Filament\Resources\ItemsResource\Mutators\BeforeCreate;

class CreateItems extends CreateRecord
{
    protected static string $resource = ItemsResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return BeforeCreate::mutate($data);
    }

    // Generate Form
    public function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form
            ->schema(ItemsForm::makeCreateFrom());
    }

}
