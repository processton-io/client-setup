<?php

namespace Processton\Customer\Filament\Resources\CustomerResource\Components;

use Filament\Forms;
use Processton\Contact\Filament\Resources\ContactResource\Components\SelectContact;

class CustomerContact
{
    public static function make(): Forms\Components\Group
    {
        return Forms\Components\Group::make()
                    ->relationship('customerContact')
                    ->schema([
                        SelectContact::make()
                            ->columns(6)->columnSpan(6),
                        Forms\Components\TextInput::make('job_title')->columnSpan(3),
                        Forms\Components\TextInput::make('department')->columnSpan(3),
                    ])
                    ->columns(6);
    }
}
