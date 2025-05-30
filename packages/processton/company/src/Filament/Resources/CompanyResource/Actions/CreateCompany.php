<?php

namespace Processton\Company\Filament\Resources\CompanyResource\Actions;

use Filament\Forms\Form;
use Filament\Tables\Actions\CreateAction;
use Processton\Company\Filament\Resources\CompanyResource;
use Processton\Company\Filament\Resources\CompanyResource\Mutators\BeforeCreate;
use Processton\Company\Models\Company;

class CreateCompany
{
    public static function make(): CreateAction
    {
        return CreateAction::make()
            ->modalHeading(fn(Company $record): string => __("Create ".('Create' === 'Create' ? 'New ' : 'Edit').('Create' === 'Create' ? "company" : $record->name)))
            ->mutateFormDataUsing(fn(array $data) => BeforeCreate::mutate($data))
            ->modalWidth('7xl')
            ->form(fn(Form $form) => CompanyResource::form($form))
            ->requiresConfirmation(false)
            ->slideOver();
    }
}
