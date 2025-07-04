<?php

namespace Processton\Items\Filament\Resources;

use Processton\Items\Filament\Resources\ItemVendorResource\Pages;
use Processton\Items\Filament\Resources\ItemVendorResource\RelationManagers;
use Processton\Items\Models\ItemVendor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemVendorResource extends Resource
{
    protected static ?string $model = ItemVendor::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Precurement';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Vendors';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListItemVendors::route('/'),
            'create' => Pages\CreateItemVendor::route('/create'),
            'edit' => Pages\EditItemVendor::route('/{record}/edit'),
        ];
    }
}
