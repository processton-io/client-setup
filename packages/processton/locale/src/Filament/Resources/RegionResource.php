<?php

namespace Processton\Locale\Filament\Resources;

use Processton\Locale\Filament\Resources\RegionResource\Pages;
use Processton\Locale\Filament\Resources\RegionResource\RelationManagers;
use Processton\Locale\Models\Region;
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

class RegionResource extends Resource
{
    protected static ?string $model = Region::class;

    protected static ?string $navigationIcon = 'majestic-map-marker-path-line';

    // protected static ?string $navigationGroup = 'Locale';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\ColorPicker::make('color'),
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required(),
                Forms\Components\TextInput::make('code')
                    ->label('Code')
                    ->required(),
                Forms\Components\Select::make('parent_id')
                    ->options(Region::all()->pluck('name', 'id'))
                    ->searchable()
                    ->label('Parent'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ColorColumn::make('color'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('parent.name')->label('Parent'),
                Tables\Columns\TextColumn::make('children_count')->counts('children')->label('Sub Regions'),
                Tables\Columns\TextColumn::make('countries_count')->counts('countries')->label('Countries'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('parent_id')
                    ->options(Region::all()->pluck('name', 'id'))
                    ->label('Parent'),
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
            'index' => Pages\ListRegions::route('/'),
            'create' => Pages\CreateRegion::route('/create'),
            'view' => Pages\ViewRegion::route('/{record}'),
            'edit' => Pages\EditRegion::route('/{record}/edit'),
        ];
    }

    public static function getCluster(): ?string
    {
        return config('panels.locale.config.regions.cluster', static::$cluster);
    }

    public static function getModelLabel(): string
    {
        return config('panels.locale.config.regions.label', 'Region');
    }

    public static function getPluralModelLabel(): string
    {
        return config('panels.locale.config.regions.plural_label', 'Regions');
    }

    public static function getNavigationGroup(): ?string
    {
        return config('panels.locale.config.regions.group_label', '');
    }

    public static function getNavigationLabel(): string
    {
        return config('panels.locale.config.regions.navigation_label', '');
    }

    public static function getNavigationIcon(): string
    {
        return config('panels.locale.config.regions.navigation_icon', 'mdi-spider-web');
    }

    public static function getSlug(): string
    {
        return config('panels.locale.config.regions.slug', 'regions');
    }

    public static function getNavigationBadge(): ?string
    {
        return config('panels.locale.config.regions.badge', null);
    }

    public static function getNavigationSort(): ?int
    {
        return config('panels.locale.config.regions.sort', null);
    }
}
