<?php

namespace Processton\Company\Filament\Resources\CompanyResource\Forms;

use Filament\Forms;

class CompanyForm
{
    public static function make(): array {
        return [
            Forms\Components\TextInput::make('name')->label('name')->required(),
            Forms\Components\TextInput::make('domain')->label('domain')->required(),
            Forms\Components\TextInput::make('phone')->label('phone')->required(),
            Forms\Components\TextInput::make('website')->label('website')->required(),
            Forms\Components\TextInput::make('industry')->label('industry')->required(),
            Forms\Components\TextInput::make('annual_revenue')->label('annual_revenue')->required(),
            Forms\Components\TextInput::make('number_of_employees')->label('number_of_employees')->required(),
            Forms\Components\TextInput::make('lead_source')->label('lead_source')->required(),
            Forms\Components\TextInput::make('description')->label('description')->required(),
            Forms\Components\TextInput::make('creator_id')->label('creator_id')->required(),
            Forms\Components\TextInput::make('address_id')->label('address_id')->required(),
        ];
    }
}
