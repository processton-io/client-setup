<?php

namespace Processton\Customer\Filament\Resources\CustomerResource\Actions;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Tables\Actions\EditAction;
use Processton\Customer\Filament\Resources\CustomerResource;
use Processton\Customer\Filament\Resources\CustomerResource\Mutators\BeforeEdit;
use Processton\Customer\Models\Customer;

class EditCustomer
{
    public static function make(): EditAction
    {
        return EditAction::make()
            ->modalHeading(fn(Customer $record): string => __("Edit {$record->name}"))
            ->modalSubheading(fn(Customer $record): string => $record->identifier)
            ->mutateFormDataUsing(fn(array $data) => BeforeEdit::mutate($data))
            ->modalWidth('7xl')
            ->form(fn(Form $form) => CustomerResource::form($form))
            ->requiresConfirmation(false)
            ->slideOver();
    }
}
