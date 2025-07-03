<?php

namespace Processton\Abacus\Filament\Resources;

use Processton\Abacus\Filament\Resources\AbacusChartOfAccountResource\Pages;
use Processton\Abacus\Models\AbacusChartOfAccount;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AbacusChartOfAccountResource extends Resource
{
    protected static ?string $model = AbacusChartOfAccount::class;

    protected static ?string $navigationIcon = 'mdi-book';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Chart of Accounts';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label('Code')
                    ->required()
                    ->maxLength(255)
                    ->unique(AbacusChartOfAccount::class, 'code', ignoreRecord: true),

                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('base_type')
                    ->label('Base Type')
                    ->options([
                        'asset' => 'Asset',
                        'liability' => 'Liability',
                        'equity' => 'Equity',
                        'revenue' => 'Revenue',
                        'expense' => 'Expense',
                    ])
                    ->required(),

                Forms\Components\Select::make('type')
                    ->label('Type')
                    ->options([
                        'current_asset' => 'Current Asset',
                        'fixed_asset' => 'Fixed Asset',
                        'current_liability' => 'Current Liability',
                        'long_term_liability' => 'Long Term Liability',
                        'income' => 'Income',
                        'cost_of_goods_sold' => 'Cost of Goods Sold',
                        'operating_expense' => 'Operating Expense',
                        // Add more types as needed
                    ]),

                Forms\Components\Select::make('parent_id')
                    ->label('Parent Account')
                    ->relationship('parent', 'name'),

                Forms\Components\Toggle::make('is_group')
                    ->label('Is Group?'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Code')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->description(fn (AbacusChartOfAccount $record) => $record?->parent?->name ? 'Parent: '.$record?->parent?->name : '')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('base_type')
                    ->label('Base Type')
                    ->description(fn (AbacusChartOfAccount $record) => $record->type ? 'Other type: '.$record->type : '')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BooleanColumn::make('is_group')
                    ->label('Is Group?'),
                Tables\Columns\TextColumn::make('credit')
                    ->label('Credit')
                    ->formatStateUsing(fn (AbacusChartOfAccount $record) => $record->credit ?: 0)
                    ->sortable(),
                Tables\Columns\TextColumn::make('debit')
                    ->label('Debit')
                    ->formatStateUsing(fn (AbacusChartOfAccount $record) => $record->debit ?: 0)
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->slideOver(),
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
            'index' => Pages\ListAbacusChartOfAccounts::route('/'),
            // 'create' => Pages\CreateAbacusChartOfAccount::route('/create'),
            // 'edit' => Pages\EditAbacusChartOfAccount::route('/{record}/edit'),
        ];
    }
}
