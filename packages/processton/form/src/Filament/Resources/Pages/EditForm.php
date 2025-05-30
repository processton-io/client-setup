<?php

namespace Processton\Form\Filament\Resources\Pages;

use Filament\Resources\Pages\EditRecord;
use Processton\Form\Filament\Resources\FormResource;

class EditForm extends EditRecord
{
    protected static string $resource = FormResource::class;
    protected function mutateFormDataBeforeSave(array $data): array
    {
        return parent::mutateFormDataBeforeSave($data);
    }
}