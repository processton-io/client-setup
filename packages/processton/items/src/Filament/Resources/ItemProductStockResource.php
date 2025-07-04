<?php

namespace Processton\Items\Filament\Resources;

use Processton\Items\Filament\Resources\ItemProductStockResource\Pages;
use Processton\Items\Filament\Resources\ItemProductStockResource\RelationManagers;
use Processton\Items\Models\ItemProductStock;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemProductStockResource extends Resource
{
    protected static ?string $model = ItemProductStock::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Stocks';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Products';
    protected static ?string $recordTitleAttribute = 'item.name';



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
            'index' => Pages\ListItemProductStocks::route('/'),
            'create' => Pages\CreateItemProductStock::route('/create'),
            'edit' => Pages\EditItemProductStock::route('/{record}/edit'),
        ];
    }
}
