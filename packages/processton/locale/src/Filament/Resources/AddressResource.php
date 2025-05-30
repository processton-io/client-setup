<?php

namespace Processton\Locale\Filament\Resources;

use Processton\Locale\Filament\Resources\AddressResource\Pages;
use Processton\Locale\Filament\Resources\AddressResource\RelationManagers;
use Processton\Locale\Models\Address;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AddressResource extends Resource
{
    protected static ?string $model = Address::class;

    protected static ?string $recordTitleAttribute = 'street';

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'create',
            'update',
            'delete',
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('entity_name')
                    ->label('Entity')
                    ->sortable(),
                Tables\Columns\TextColumn::make('related_entity_name')
                    ->label('Related Entity')
                    ->sortable(),
                Tables\Columns\TextColumn::make('full_address')
                    ->label('Full Address')
                    ->wrap()
                    ->sortable()
            ])
            ->filters([
            Tables\Filters\SelectFilter::make('country')
                ->relationship('country', 'name')
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
            'index' => Pages\ListAddresses::route('/'),
        ];
    }



    public static function getCluster(): ?string
    {
        return config('panels.locale.config.addresses.cluster', static::$cluster);
    }

    public static function getModelLabel(): string
    {
        return config('panels.locale.config.addresses.label', 'Address');
    }

    public static function getPluralModelLabel(): string
    {
        return config('panels.locale.config.addresses.plural_label', 'Addresses');
    }

    public static function getNavigationGroup(): ?string
    {
        return config('panels.locale.config.addresses.group_label', '');
    }

    public static function getNavigationLabel(): string
    {
        return config('panels.locale.config.addresses.navigation_label', '');
    }

    public static function getNavigationIcon(): string
    {
        return config('panels.locale.config.addresses.navigation_icon', 'heroicon-o-rectangle-stack');
    }

    public static function getSlug(): string
    {
        return config('panels.locale.config.addresses.slug', 'addresses');
    }

    public static function getNavigationBadge(): ?string
    {
        return config('panels.locale.config.addresses.badge', null);
    }

    public static function getNavigationSort(): ?int
    {
        return config('panels.locale.config.addresses.sort', null);
    }
}
