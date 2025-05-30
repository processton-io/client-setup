<?php

namespace Processton\Items\Filament\Resources\ItemsResource\Actions;

use Filament\Forms\Form;
use Filament\Tables\Actions\CreateAction;
use Processton\Items\Filament\Resources\ItemsResource;
use Processton\Items\Filament\Resources\ItemsResource\Mutators\BeforeCreate;
use Processton\Items\Models\Items;

class CreateItems
{
    public static function make(): CreateAction
    {
        return CreateAction::make()
            ->modalHeading(fn(Items $record): string => __("Create ".('Create' === 'Create' ? 'New ' : 'Edit').('Create' === 'Create' ? "items" : $record->name)))
            ->mutateFormDataUsing(fn(array $data) => BeforeCreate::mutate($data))
            ->modalWidth('7xl')
            ->form(fn(Form $form) => ItemsResource::form($form))
            ->requiresConfirmation(false)
            ->slideOver();
    }
}
