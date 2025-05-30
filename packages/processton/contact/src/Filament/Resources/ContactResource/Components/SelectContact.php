<?php

namespace Processton\Contact\Filament\Resources\ContactResource\Components;

use Filament\Forms;
use Processton\Contact\Filament\Resources\ContactResource\Forms\ContactForm;

class SelectContact
{
    public static function make(): Forms\Components\Select
    {
        return Forms\Components\Select::make('contact_id')
            ->relationship('contact', 'email')
            ->label('Contact')
            ->searchable()
            ->createOptionForm(ContactForm::make());
    }
}
