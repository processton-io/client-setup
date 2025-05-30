<?php

namespace Processton\Contact\Filament\Resources\ContactResource\Actions;

use Filament\Forms\Form;
use Filament\Tables\Actions\CreateAction;
use Processton\Contact\Filament\Resources\ContactResource;
use Processton\Contact\Filament\Resources\ContactResource\Mutators\BeforeCreate;
use Processton\Contact\Models\Contact;

class CreateContact
{
    public static function make(): CreateAction
    {
        return CreateAction::make()
            ->modalHeading(fn(Contact $record): string => __("Create ".('Create' === 'Create' ? 'New ' : 'Edit').('Create' === 'Create' ? "contact" : $record->name)))
            ->mutateFormDataUsing(fn(array $data) => BeforeCreate::mutate($data))
            ->modalWidth('7xl')
            ->form(fn(Form $form) => ContactResource::form($form))
            ->requiresConfirmation(false)
            ->slideOver();
    }
}
