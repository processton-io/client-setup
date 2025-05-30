<?php

namespace Processton\Company\Filament\Resources\CompanyResource\InfoList;

use Filament\Infolists\Components;

class CompanyInfoList
{
    public static function make(): array
    {
        return [
            Components\Section::make('General Info')
                ->schema([
                    Components\TextEntry::make('name')->label('Name')->columnSpan([
                        'default' => 12,
                        'sm' => 6,
                        'md' => 4,
                        'lg' => 4,
                        'xl' => 3,
                    ]),
                    Components\TextEntry::make('domain')->label('Domain')->columnSpan([
                        'default' => 12,
                        'sm' => 6,
                        'md' => 4,
                        'lg' => 4,
                        'xl' => 3,
                    ]),
                    Components\TextEntry::make('phone')->label('Phone')->columnSpan([
                        'default' => 12,
                        'sm' => 6,
                        'md' => 4,
                        'lg' => 4,
                        'xl' => 3,
                    ]),
                    // Components\TextEntry::make('website')->label('Website'),
                    Components\TextEntry::make('industry')->label('Industry')->columnSpan([
                        'default' => 12,
                        'sm' => 6,
                        'md' => 4,
                        'lg' => 4,
                        'xl' => 3,
                    ]),
                    Components\TextEntry::make('annual_revenue')->label('Annual Revenue')->columnSpan([
                        'default' => 12,
                        'sm' => 6,
                        'md' => 4,
                        'lg' => 4,
                        'xl' => 3,
                    ]),
                    Components\TextEntry::make('number_of_employees')->label('Number of Employees')->columnSpan([
                        'default' => 12,
                        'sm' => 6,
                        'md' => 4,
                        'lg' => 4,
                        'xl' => 3,
                    ]),
                    // Components\TextEntry::make('lead_source')->label('Lead Source'),
                    Components\TextEntry::make('description')->label('Description')->columnSpan(12),
                ])->columns(12),

            Components\Tabs::make('customers')
                ->schema([
                    Components\Tabs\Tab::make('Customers')
                        ->schema([
                            Components\TextEntry::make('customer_count')
                                ->label('Customer Count'),
                            Components\TextEntry::make('customer_value')
                                ->label('Customer Value'),
                        ]),
                    Components\Tabs\Tab::make('Contacts')
                        ->schema([
                            Components\TextEntry::make('contact_count')
                                ->label('Contact Count'),
                            Components\TextEntry::make('contact_value')
                                ->label('Contact Value'),
                        ]),
                    Components\Tabs\Tab::make('Leads')
                        ->schema([
                            Components\TextEntry::make('lead_count')
                                ->label('Lead Count'),
                            Components\TextEntry::make('lead_value')
                                ->label('Lead Value'),
                        ]),
                    Components\Tabs\Tab::make('Opportunities')
                        ->schema([
                            Components\TextEntry::make('opportunity_count')
                                ->label('Opportunity Count'),
                            Components\TextEntry::make('opportunity_value')
                                ->label('Opportunity Value'),
                        ]),
                ]),
        ];
    }
}
