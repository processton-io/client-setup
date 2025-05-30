<?php

namespace Processton\Locale\Filament\Resources;

use Processton\Locale\Filament\Resources\ZoneResource\Pages;
use Processton\Locale\Filament\Resources\ZoneResource\RelationManagers;
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

class ZoneResource extends Resource
{
    protected static ?string $model = Zone::class;

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
                    ->required()
                    ->required(),
                Forms\Components\TextInput::make('code')
                    ->label('Code')
                    ->required(),
                Forms\Components\Select::make('city_id')
                    ->options(City::all()->pluck('name', 'id'))
                    ->searchable()
                    ->label('City')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\ColorColumn::make('color'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('city.name')->label('City')
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('city_id')
                    ->options(City::all()->pluck('name', 'id'))
                    ->label('City'),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
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
            'index' => Pages\ListZones::route('/'),
            'create' => Pages\CreateZone::route('/create'),
            'view' => Pages\ViewZone::route('/{record}'),
            'edit' => Pages\EditZone::route('/{record}/edit'),
        ];
    }


    public static function getCluster(): ?string
    {
        return config('panels.locale.config.zones.cluster', static::$cluster);
    }

    public static function getModelLabel(): string
    {
        return config('panels.locale.config.zones.label', 'Zones');
    }

    public static function getPluralModelLabel(): string
    {
        return config('panels.locale.config.zones.plural_label', 'Zones');
    }

    public static function getNavigationGroup(): ?string
    {
        return config('panels.locale.config.zones.group_label', '');
    }

    public static function getNavigationLabel(): string
    {
        return config('panels.locale.config.zones.navigation_label', '');
    }

    public static function getNavigationIcon(): string
    {
        return config('panels.locale.config.zones.navigation_icon', 'majestic-map-marker-path-line');
    }

    public static function getSlug(): string
    {
        return config('panels.locale.config.zones.slug', 'currencies');
    }

    public static function getNavigationBadge(): ?string
    {
        return config('panels.locale.config.zones.badge', null);
    }

    public static function getNavigationSort(): ?int
    {
        return config('panels.locale.config.zones.sort', null);
    }
}
