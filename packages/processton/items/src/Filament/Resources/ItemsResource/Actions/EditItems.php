<?php

namespace Processton\Items\Filament\Resources\ItemsResource\Actions;

use Filament\Forms\Form;
use Filament\Tables\Actions\EditAction;
use Processton\Items\Filament\Resources\ItemsResource;
use Processton\Items\Filament\Resources\ItemsResource\Mutators\BeforeEdit;
use Processton\Items\Models\Items;

class EditItems
{
    public static function make(): EditAction
    {
        return EditAction::make()
            ->modalHeading(fn(Items $record): string => __("Edit ".('Edit' === 'Create' ? 'New ' : 'Edit').('Edit' === 'Create' ? "items" : $record->name)))
            ->mutateFormDataUsing(fn(array $data) => BeforeEdit::mutate($data))
            ->modalWidth('7xl')
            ->form(fn(Form $form) => ItemsResource::form($form))
            ->requiresConfirmation(false)
            ->slideOver();
    }
}
