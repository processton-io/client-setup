<?php

namespace Processton\Contact\Filament\Resources\ContactResource\InfoList;

use Filament\Infolists\Components;

class ContactInfoList
{
    public static function make(): array
    {
        return [
            Components\Section::make('General Info')
                ->schema([
                    Components\TextEntry::make('prefix')->label('prefix'),
                    Components\TextEntry::make('first_name')->label('first_name'),
                    Components\TextEntry::make('last_name')->label('last_name'),
                    Components\TextEntry::make('email')->label('email'),
                    Components\TextEntry::make('phone')->label('phone'),
                    Components\TextEntry::make('linkedin_profile')->label('linkedin_profile'),
                    Components\TextEntry::make('twitter_handle')->label('twitter_handle'),
                    Components\TextEntry::make('notes')->label('notes'),
                ]),
        ];
    }
}
