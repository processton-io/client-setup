<?php

namespace Processton\Customer\Filament\Resources\CustomerResource\Forms;

use Filament\Forms;
use Processton\Customer\Filament\Resources\CustomerResource\Components\CustomerCompany;
use Processton\Customer\Filament\Resources\CustomerResource\Components\CustomerContact;
use Processton\Customer\Filament\Resources\CustomerResource\Components\CustomerContacts;

class CustomerForm
{
    public static function make(): array {
        return [
            Forms\Components\Split::make([
                Forms\Components\Section::make([
                    Forms\Components\Select::make('currency')
                        ->relationship('currency', 'name')
                        ->label('Currency')
                        ->disabledOn('edit')
                        ->required(),
                    Forms\Components\Tabs::make('Tabs')
                        ->tabs([
                            Forms\Components\Tabs\Tab::make('Company Information')
                                ->schema([
                                        CustomerCompany::make()
                                    ])
                                ->hidden(fn($get): bool => $get('is_personal') === true) // Ensure reactivity
                                ->reactive(),
                            Forms\Components\Tabs\Tab::make('Contacts')
                                ->schema([
                                    CustomerContacts::make()
                                ])
                                ->hidden(fn($get): bool => $get('is_personal') === true),
                            Forms\Components\Tabs\Tab::make('Contact Info')
                                ->schema([CustomerContact::make()])
                                ->hidden(fn($get): bool => $get('is_personal') !== true),
                        ])
                        ->reactive(), // Ensure the Tabs component itself is reactive
                ]),
                Forms\Components\Section::make([
                    Forms\Components\Toggle::make('is_personal')
                        ->label('Is Personal')
                        ->reactive()
                        ->disabledOn('edit'),
                    Forms\Components\Toggle::make('enable_portal')
                        ->label('Enable Portal'),
                ])->grow(false),
            ])->from('md'),

        ];
    }
}
