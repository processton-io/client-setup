<?php

namespace Processton\Contact\Filament\Resources\ContactResource\Forms;

use Filament\Forms;

class ContactForm
{
    public static function make(): array {
        return [
            Forms\Components\Select::make('prefix')
                ->label('Prefix')
                ->options([
                    'Mr.' => 'Mr.',
                    'Ms.' => 'Ms.',
                    'Mrs.' => 'Mrs.',
                    'Dr.' => 'Dr.',
                ]),
            Forms\Components\TextInput::make('first_name'),
            Forms\Components\TextInput::make('last_name')
                ->required(),
            Forms\Components\TextInput::make('email')
                ->required()
                ->email()
        ];
    }
}
