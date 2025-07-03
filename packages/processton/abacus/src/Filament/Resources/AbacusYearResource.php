<?php

namespace Processton\Abacus\Filament\Resources;

use Processton\Abacus\Filament\Resources\AbacusYearResource\Pages;
use Processton\Abacus\Models\AbacusYear;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AbacusYearResource extends Resource
{
    protected static ?string $model = AbacusYear::class;

    protected static ?string $navigationIcon = 'lucide-library';

    protected static ?string $navigationLabel = 'Books';

    protected static ?int $navigationSort = 5;



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('start_date')
                    ->required(),

                Forms\Components\DatePicker::make('end_date')
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        1 => 'Active',
                        2 => 'Archived',
                        0 => 'Inactive',
                    ])
                    ->default(1)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Start Date')
                    ->date()
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('End Date')
                    ->date()
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(function (AbacusYear $record) {
                        if ($record->status == 1) {
                            return 'Active';
                        } else if ($record->status == 2) {
                            return 'Archived';
                        } else {
                            return 'Inactive';
                        }
                    })
                    ->color(fn ($state): string => match ($state) {
                        1 => 'success',
                        0 => 'warning',
                        2 => 'info',
                        default => 'secondary',
                    })
                    ->icon(fn ($state): string => match ($state) {
                        1 => 'heroicon-o-check-circle',
                        2 => 'heroicon-s-archive-box',
                        0 => 'heroicon-o-x-circle',
                        default => 'heroicon-o-x-circle'
                    })->sortable(),
                Tables\Columns\TextColumn::make('debit')
                    ->label('Debit'),
                Tables\Columns\TextColumn::make('credit')
                    ->label('Credit'),
                Tables\Columns\TextColumn::make('balance')
                    ->label('Balance')
                    ->formatStateUsing(function (AbacusYear $record) {
                        return $record->credit - $record->debit;
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListAbacusYears::route('/'),
        ];
    }
}
