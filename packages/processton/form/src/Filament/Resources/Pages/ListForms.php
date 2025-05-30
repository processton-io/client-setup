<?php

namespace Processton\Form\Filament\Resources\Pages;

use Filament\Resources\Pages\ListRecords;
use Processton\Form\Filament\Resources\FormResource;

class ListForms extends ListRecords
{
    protected static string $resource = FormResource::class;

    public function getTitle(): string
    {
        return __('Web Forms');
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Pages\Actions\CreateAction::make(),
        ];
    }
}
