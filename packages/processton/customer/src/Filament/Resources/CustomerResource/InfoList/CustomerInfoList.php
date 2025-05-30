<?php

namespace Processton\Customer\Filament\Resources\CustomerResource\InfoList;

use Filament\Infolists\Components;

class CustomerInfoList
{
    public static function make(): array
    {
        return [
            Components\Section::make('Personal Info')
                ->schema([
                    Components\TextEntry::make('name'),
                    Components\TextEntry::make('email'),
                    Components\TextEntry::make('phone'),
                ]),

            Components\Section::make('Company')
                ->schema([
                    Components\TextEntry::make('company_name'),
                    Components\TextEntry::make('website'),
                ]),

            Components\Section::make('Portal Access')
                ->schema([
                    Components\TextEntry::make('enable_portal')
                        ->label('Portal Enabled'),
                ]),
        ];
    }
}
