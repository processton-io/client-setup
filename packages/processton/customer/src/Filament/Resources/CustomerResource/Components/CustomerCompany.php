<?php

namespace Processton\Customer\Filament\Resources\CustomerResource\Components;

use Filament\Forms;

class CustomerCompany
{
    public static function make(): Forms\Components\Group
    {
        return Forms\Components\Group::make()
            ->relationship('company')
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->columnSpan(2),
                Forms\Components\TextInput::make('domain')
                    ->label('Domain Name')
                    ->placeholder('example.com'),
                Forms\Components\TextInput::make('website')
                    ->label('Website')
                    ->url(),
                Forms\Components\TextInput::make('phone')
                    ->label('Phone Number')
                    ->tel()
                    ->columnSpan(2),
                Forms\Components\TextInput::make('lead_source')
                    ->label('Lead Source')
                    ->placeholder('e.g., Referral, Ad, etc.'),
                Forms\Components\Select::make('industry')
                    ->label('Industry')
                    ->options([
                        'Software' => 'Software',
                        'Retail' => 'Retail',
                        'Finance' => 'Finance',
                        // Add more industries as needed
                    ])
                    ->placeholder('e.g., Software, Retail, etc.'),
                Forms\Components\TextInput::make('annual_revenue')
                    ->label('Annual Revenue')
                    ->numeric()
                    ->placeholder('e.g., 1000000'),
                Forms\Components\TextInput::make('number_of_employees')
                    ->label('Number of Employees')
                    ->numeric()
                    ->placeholder('e.g., 50'),
                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->placeholder('Company description or notes')
                    ->columnSpan(2),
            ])
            ->columns(2);
    }
}
