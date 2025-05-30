<?php

namespace Processton\Locale\Filament\Resources;

use Processton\Locale\Filament\Resources\CountryResource\Pages;
use Processton\Locale\Filament\Resources\CountryResource\RelationManagers;
use Processton\Locale\Models\Country;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Processton\Locale\Models\Region;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

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
                Forms\Components\ColorPicker::make('color'),
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required(),
                Forms\Components\Select::make('region_id')
                    ->options(Region::all()->pluck('name', 'id'))
                    ->searchable()
                    ->label('Region')
                    ->required(),
                Forms\Components\TextInput::make('iso_2_code')
                    ->label('ISO 2 Code')
                    ->required(),
                Forms\Components\TextInput::make('iso_3_code')
                    ->label('ISO 3 Code')
                    ->required(),
                Forms\Components\TextInput::make('dial_code')
                    ->label('Dial Code')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ColorColumn::make('color'),
                Tables\Columns\TextColumn::make('name')->searchable()->label('Name'),
                Tables\Columns\TextColumn::make('iso_2_code')->label('ISO 2 Code'),
                Tables\Columns\TextColumn::make('iso_3_code')->label('ISO 3 Code'),
                Tables\Columns\TextColumn::make('dial_code')->label('Dial Code'),
                Tables\Columns\TextColumn::make('region.name')->label('Region'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('region_id')
                    ->options(Region::all()->pluck('name', 'id'))
                    ->label('Region')
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
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'view' => Pages\ViewCountry::route('/{record}'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }

    public static function getCluster(): ?string
    {
        return config('panels.locale.config.countries.cluster', static::$cluster);
    }

    public static function getModelLabel(): string
    {
        return config('panels.locale.config.countries.label', 'City');
    }

    public static function getPluralModelLabel(): string
    {
        return config('panels.locale.config.countries.plural_label', 'Cities');
    }

    public static function getNavigationGroup(): ?string
    {
        return config('panels.locale.config.countries.group_label', '');
    }

    public static function getNavigationLabel(): string
    {
        return config('panels.locale.config.countries.navigation_label', '');
    }

    public static function getNavigationIcon(): string
    {
        return config('panels.locale.config.countries.navigation_icon', 'heroicon-s-flag');
    }

    public static function getSlug(): string
    {
        return config('panels.locale.config.countries.slug', 'countries');
    }

    public static function getNavigationBadge(): ?string
    {
        return config('panels.locale.config.countries.badge', null);
    }

    public static function getNavigationSort(): ?int
    {
        return config('panels.locale.config.countries.sort', null);
    }
}
