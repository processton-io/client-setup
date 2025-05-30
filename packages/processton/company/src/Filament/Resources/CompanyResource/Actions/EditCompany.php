<?php

namespace Processton\Company\Filament\Resources\CompanyResource\Actions;

use Filament\Forms\Form;
use Filament\Tables\Actions\EditAction;
use Processton\Company\Filament\Resources\CompanyResource;
use Processton\Company\Filament\Resources\CompanyResource\Mutators\BeforeEdit;
use Processton\Company\Models\Company;

class EditCompany
{
    public static function make(): EditAction
    {
        return EditAction::make()
            ->modalHeading(fn(Company $record): string => __("Edit ".('Edit' === 'Create' ? 'New ' : 'Edit').('Edit' === 'Create' ? "company" : $record->name)))
            ->mutateFormDataUsing(fn(array $data) => BeforeEdit::mutate($data))
            ->modalWidth('7xl')
            ->form(fn(Form $form) => CompanyResource::form($form))
            ->requiresConfirmation(false)
            ->slideOver();
    }
}
