<?php

namespace Processton\Locale\Filament\Resources;

use Processton\Locale\Filament\Resources\CityResource\Pages;
use Processton\Locale\Filament\Resources\CityResource\RelationManagers;
use Processton\Locale\Models\City;
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
use Processton\Locale\Models\Country;

class CityResource extends Resource
{
    protected static ?string $model = City::class;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->required(),
                Forms\Components\Select::make('country_id')
                    ->options(Country::all()->pluck('name', 'id'))
                    ->searchable()
                    ->label('Country')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->label('Name'),
                Tables\Columns\TextColumn::make('country.name')->label('Country')
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('country_id')
                    ->options(Country::all()->pluck('name', 'id'))
                    ->label('Country')
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListCities::route('/'),
            'create' => Pages\CreateCity::route('/create'),
            'view' => Pages\ViewCity::route('/{record}'),
            'edit' => Pages\EditCity::route('/{record}/edit'),
        ];
    }

    public static function getCluster(): ?string
    {
        return config('panels.locale.config.cities.cluster', static::$cluster);
    }

    public static function getModelLabel(): string
    {
        return config('panels.locale.config.cities.label', 'City');
    }

    public static function getPluralModelLabel(): string
    {
        return config('panels.locale.config.cities.plural_label', 'Cities');
    }

    public static function getNavigationGroup(): ?string
    {
        return config('panels.locale.config.cities.group_label', '');
    }

    public static function getNavigationLabel(): string
    {
        return config('panels.locale.config.cities.navigation_label', '');
    }

    public static function getNavigationIcon(): string
    {
        return config('panels.locale.config.cities.navigation_icon', 'solar-city-line-duotone');
    }

    public static function getSlug(): string
    {
        return config('panels.locale.config.cities.slug', 'cities');
    }

    public static function getNavigationBadge(): ?string
    {
        return config('panels.locale.config.cities.badge', null);
    }

    public static function getNavigationSort(): ?int
    {
        return config('panels.locale.config.cities.sort', null);
    }
}
