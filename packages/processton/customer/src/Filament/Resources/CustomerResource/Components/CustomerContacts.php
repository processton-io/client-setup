<?php

namespace Processton\Customer\Filament\Resources\CustomerResource\Components;

use Filament\Forms;
use Processton\Contact\Filament\Resources\ContactResource\Components\SelectContact;

class CustomerContacts
{
    public static function make(): Forms\Components\Repeater
    {
        return Forms\Components\Repeater::make('Contacts')
                    ->relationship('customerContacts')
                    ->schema([
                        SelectContact::make()
                            ->columns(6)->columnSpan(6),
                        Forms\Components\TextInput::make('job_title')->columnSpan(3),
                        Forms\Components\TextInput::make('department')->columnSpan(3),
                    ])
                    ->itemLabel(fn(array $state): ?string => array_key_exists('contact_name', $state) ? implode(", ", [
                        $state['contact_name'],
                        $state['job_title'],
                        $state['department']
                    ]) : null)
                    ->collapsed()
                    ->columns(6);
    }
}
