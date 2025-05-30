<?php

namespace Processton\Contact\Filament\Resources\ContactResource\Actions;

use Filament\Forms\Form;
use Filament\Tables\Actions\ViewAction;
use Processton\Contact\Filament\Resources\ContactResource;
use Processton\Contact\Filament\Resources\ContactResource\Mutators\BeforeView;
use Processton\Contact\Models\Contact;

class ViewContact
{
    public static function make(): ViewAction
    {
        return ViewAction::make()
            ->modalHeading(fn(Contact $record): string => __("View ".('View' === 'Create' ? 'New ' : 'Edit').('View' === 'Create' ? "contact" : $record->name)))
            // ->mutateFormDataUsing(fn(array $data) => BeforeView::mutate($data))
            ->modalWidth('7xl')
            // ->form(fn(Form $form) => ContactResource::form($form))
            ->requiresConfirmation(false)
            ->slideOver()
            ->url(fn(Contact $record): string => ContactResource::getUrl('view', ['record' => $record]));
    }
}
