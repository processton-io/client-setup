<?php

namespace Processton\Items\Filament\Resources;

use Processton\Items\Filament\Resources\ItemAssetStockResource\Pages;
use Processton\Items\Filament\Resources\ItemAssetStockResource\RelationManagers;
use Processton\Items\Models\ItemAssetStock;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemAssetStockResource extends Resource
{
    protected static ?string $model = ItemAssetStock::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Stocks';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Assets';
    protected static ?string $recordTitleAttribute = 'item.name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('item.name')
                    ->label('Asset Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('quantity')
                    ->label('Quantity')
                    ->numeric()
                    ->required(),
                Forms\Components\Select::make('item.category_id')
                    ->relationship('category', 'name')
                    ->label('Category')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Description'),
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
            'index' => Pages\ListItemAssetStocks::route('/'),
            'create' => Pages\CreateItemAssetStock::route('/create'),
            'edit' => Pages\EditItemAssetStock::route('/{record}/edit'),
        ];
    }
}
