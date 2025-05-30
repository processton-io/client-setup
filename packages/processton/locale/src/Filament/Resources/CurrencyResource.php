<?php

namespace Processton\Locale\Filament\Resources;

use Processton\Locale\Filament\Resources\CurrencyResource\Pages;
use Processton\Locale\Filament\Resources\CurrencyResource\RelationManagers;
use Processton\Locale\Models\Currency;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Pelmered\FilamentMoneyField\Tables\Columns\MoneyColumn;

class CurrencyResource extends Resource
{
    protected static ?string $model = Currency::class;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'create',
            'update',
            'delete',
        ];
    }



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(4),
                Forms\Components\TextInput::make('symbol')
                    ->required()
                    ->maxLength(4),
                Forms\Components\TextInput::make('precision')
                    ->required()
                    ->default(2)
                    ->maxLength(255),
                Forms\Components\TextInput::make('thousand_separator')
                    ->required()
                    ->default(',')
                    ->maxLength(255),
                Forms\Components\TextInput::make('decimal_separator')
                    ->required()
                    ->default('.')
                    ->maxLength(255),
            Forms\Components\ColorPicker::make('color'),
                Forms\Components\Toggle::make('swap_currency_symbol')
                    ->required()
                    ->inline(false)
                    ->label('Swap Currency Symbol')
                    ->helperText('If enabled, the currency symbol will be displayed after the amount.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ColorColumn::make('color'),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('symbol')->searchable(),
                Tables\Columns\TextColumn::make('precision')

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
            'index' => Pages\ListCurrencies::route('/'),
            'create' => Pages\CreateCurrency::route('/create'),
            'edit' => Pages\EditCurrency::route('/{record}/edit'),
        ];
    }

    public static function getCluster(): ?string
    {
        return config('panels.locale.config.currency.cluster', static::$cluster);
    }

    public static function getModelLabel(): string
    {
        return config('panels.locale.config.currency.label', 'Currency');
    }

    public static function getPluralModelLabel(): string
    {
        return config('panels.locale.config.currency.plural_label', 'Currencies');
    }

    public static function getNavigationGroup(): ?string
    {
        return config('panels.locale.config.currency.group_label', '');
    }

    public static function getNavigationLabel(): string
    {
        return config('panels.locale.config.currency.navigation_label','');
    }

    public static function getNavigationIcon(): string
    {
        return config('panels.locale.config.currency.navigation_icon','ri-coin-line');
    }

    public static function getSlug(): string
    {
        return config('panels.locale.config.currency.slug', 'currencies');
    }

    public static function getNavigationBadge(): ?string
    {
        return config('panels.locale.config.currency.badge', null);
    }

    public static function getNavigationSort(): ?int
    {
        return config('panels.locale.config.currency.sort', null);
    }

}
