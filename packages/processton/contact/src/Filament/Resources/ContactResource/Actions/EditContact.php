<?php

namespace Processton\Contact\Filament\Resources\ContactResource\Actions;

use Filament\Forms\Form;
use Filament\Tables\Actions\EditAction;
use Processton\Contact\Filament\Resources\ContactResource;
use Processton\Contact\Filament\Resources\ContactResource\Mutators\BeforeEdit;
use Processton\Contact\Models\Contact;

class EditContact
{
    public static function make(): EditAction
    {
        return EditAction::make()
            ->modalHeading(fn(Contact $record): string => __("Edit ".('Edit' === 'Create' ? 'New ' : 'Edit').('Edit' === 'Create' ? "contact" : $record->name)))
            ->mutateFormDataUsing(fn(array $data) => BeforeEdit::mutate($data))
            ->modalWidth('7xl')
            ->form(fn(Form $form) => ContactResource::form($form))
            ->requiresConfirmation(false)
            ->slideOver();
    }
}
