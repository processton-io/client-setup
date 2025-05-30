<?php

namespace Processton\Locale\Filament\Resources;

use Processton\Locale\Filament\Resources\CurrencyConversionResource\Pages;
use Processton\Locale\Filament\Resources\CurrencyConversionResource\RelationManagers;
use Processton\Locale\Models\Zone;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Processton\Locale\Models\City;
use Processton\Locale\Models\Country;
use Processton\Locale\Models\CurrencyConversion;

class CurrencyConversionResource extends Resource
{
    protected static ?string $model = CurrencyConversion::class;

    protected static ?string $recordTitleAttribute = 'from_currency_id';

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'update',
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fromCurrency.name')->label('From Currency'),
                Tables\Columns\TextColumn::make('toCurrency.name')->label('To Currency'),
                Tables\Columns\TextColumn::make('conversion_rate')->label('Conversion Rate'),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->label('Last Updated'),
            ])
            ->filters([
                
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
            'index' => Pages\ListCurrencyConversions::route('/'),
        ];
    }


    public static function getCluster(): ?string
    {
        return config('panels.locale.config.currency_conversion.cluster', static::$cluster);
    }

    public static function getModelLabel(): string
    {
        return config('panels.locale.config.currency_conversion.label', 'Currency Conversion');
    }

    public static function getPluralModelLabel(): string
    {
        return config('panels.locale.config.currency_conversion.plural_label', 'Currency Conversion');
    }

    public static function getNavigationGroup(): ?string
    {
        return config('panels.locale.config.currency_conversion.group_label', '');
    }

    public static function getNavigationLabel(): string
    {
        return config('panels.locale.config.currency_conversion.navigation_label', '');
    }

    public static function getNavigationIcon(): string
    {
        return config('panels.locale.config.currency_conversion.navigation_icon', 'polaris-currency-convert-icon');
    }

    public static function getSlug(): string
    {
        return config('panels.locale.config.currency_conversion.slug', 'currency-conversion');
    }

    public static function getNavigationBadge(): ?string
    {
        return config('panels.locale.config.currency_conversion.badge', null);
    }

    public static function getNavigationSort(): ?int
    {
        return config('panels.locale.config.currency_conversion.sort', null);
    }
}
