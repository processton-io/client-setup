<?php

namespace Processton\Abacus\Filament\Resources;

use Processton\Abacus\Filament\Resources\AbacusTransactionResource\Pages;
use Processton\Abacus\Models\AbacusTransaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Processton\Locale\Models\Currency;

class AbacusTransactionResource extends Resource
{
    protected static ?string $model = AbacusTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-s-table-cells';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Enteries';

    protected static ?string $breadcrumb = 'Enteries';



    public static function form(Form $form): Form
    {
        $currency = Currency::find(config('org.primary_currency'));
        return $form
            ->schema([
                Forms\Components\TextInput::make('amount')
                    ->label('Amount')
                    ->suffix($currency?->code, true)
                    ->required()
                    ->numeric()
                    ->minValue(0),
                Forms\Components\DatePicker::make('date')
                    ->label('Date')
                    ->required()
                    ->default(now()),
                Forms\Components\Select::make('entry_type')
                    ->label('Entry Type')
                    ->options([
                        'credit' => 'Credit',
                        'debit' => 'Debit',
                    ])
                    ->required(),
                Forms\Components\Select::make('account_id')
                    ->label('Account')
                    ->relationship('account', 'name')
                    ->required(),
                Forms\Components\Select::make('year_id')
                    ->label('Year')
                    ->relationship('year', 'id')
                    ->getOptionLabelFromRecordUsing(function ($record) {
                        $start = $record->start_date ? \Carbon\Carbon::parse($record->start_date)->format('M-y') : '';
                        $end = $record->end_date ? \Carbon\Carbon::parse($record->end_date)->format('M-y') : '';
                        return $start && $end ? "{$start} - {$end}" : ($start ?: $end);
                    })
                    ->preload()
            ]);
    }

    public static function infolist(\Filament\Infolists\Infolist $infolist): \Filament\Infolists\Infolist
    {
        $currency = Currency::find(config('org.primary_currency'));
        return $infolist
            ->schema([
                \Filament\Infolists\Components\Section::make('Entry')
                    ->schema([
                        \Filament\Infolists\Components\TextEntry::make('date')
                            ->label('Date')
                            ->formatStateUsing(fn ($state) => $state?->format('d-m-Y')),
                        \Filament\Infolists\Components\TextEntry::make('amount')
                            ->label('Amount')
                            ->numeric()
                            ->money($currency?->code, true),
                        \Filament\Infolists\Components\TextEntry::make('entry_type')
                            ->label('Type'),
                        \Filament\Infolists\Components\TextEntry::make('account.name')
                            ->label('Account'),
                        \Filament\Infolists\Components\TextEntry::make('year_range')
                            ->label('Book')
                            ->getStateUsing(function ($record) {
                                $start = optional($record->year)->start_date ? \Carbon\Carbon::parse($record->year->start_date)->format('M-y') : '';
                                $end = optional($record->year)->end_date ? \Carbon\Carbon::parse($record->year->end_date)->format('M-y') : '';
                                return $start && $end ? "{$start} - {$end}" : ($start ?: $end);
                            }),
                    ])->columns(3),
                
                \Filament\Infolists\Components\Section::make('Incoming')
                    ->schema([
                        \Filament\Infolists\Components\TextEntry::make('incoming.reference')
                            ->label('Reference'),
                        \Filament\Infolists\Components\TextEntry::make('incoming.amount')
                            ->label('Amount')
                            ->numeric()
                            ->money($currency?->code, true),
                        \Filament\Infolists\Components\TextEntry::make('incoming.date')
                            ->label('Date')
                            ->formatStateUsing(fn ($state) => $state?->format('d-m-Y')),
                        \Filament\Infolists\Components\TextEntry::make('incoming.description')
                            ->label('Description')
                            ->columnSpanFull(),
                    ])
                    ->columns(3)
                    ->visible(fn ($record) => $record->abacus_incoming_id !== null)
                

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('amount')
                    ->label('Amount')
                    ->money('USD', true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('entry_type')
                    ->label('Entry Type')
                    ->sortable(),
                Tables\Columns\TextColumn::make('account.name')
                    ->label('Account')
                    ->sortable(),
                Tables\Columns\TextColumn::make('year_range')
                    ->label('Year Range')
                    ->getStateUsing(function ($record) {
                        $start = optional($record->year)->start_date ? \Carbon\Carbon::parse($record->year->start_date)->format('M-y') : '';
                        $end = optional($record->year)->end_date ? \Carbon\Carbon::parse($record->year->end_date)->format('M-y') : '';
                        return $start && $end ? "{$start} - {$end}" : ($start ?: $end);
                    })
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('year_id')
                    ->label('Year')
                    ->relationship('year', 'id')
                    ->getOptionLabelFromRecordUsing(function ($record) {
                        $start = $record->start_date ? \Carbon\Carbon::parse($record->start_date)->format('M-y') : '';
                        $end = $record->end_date ? \Carbon\Carbon::parse($record->end_date)->format('M-y') : '';
                        return $start && $end ? "{$start} - {$end}" : ($start ?: $end);
                    }),

                Tables\Filters\SelectFilter::make('entry_type')
                    ->label('Entry Type')
                    ->options([
                        'credit' => 'Credit',
                        'debit' => 'Debit',
                    ])
                    ->searchable()
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->modal()
                    ->modalHeading('Entry Details')
                    ->label('')
                    ->iconPosition('after'),
            ])
            ->bulkActions([
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAbacusTransactions::route('/'),
        ];
    }
}
