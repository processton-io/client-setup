<?php

namespace Processton\Items\Filament\Resources;

use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Infolists\Infolist;
use Processton\Items\Models\Item;
use Processton\Items\Filament\Resources\ItemsResource\Pages;
use Processton\Items\Filament\Resources\ItemsResource\Forms\ItemsForm;
use Processton\Items\Filament\Resources\ItemsResource\InfoList\ItemsInfoList;
use Processton\Items\Filament\Resources\ItemsResource\Mutators\BeforeCreate;
use Processton\Items\Filament\Resources\ItemsResource\Mutators\BeforeEdit;
use Processton\Items\Filament\Resources\ItemsResource\Actions\CreateItems;
use Processton\Items\Filament\Resources\ItemsResource\Actions\EditItems;
use Processton\Items\Filament\Resources\ItemsResource\Actions\ViewItems;
use Processton\Items\Models\Asset;
use Processton\Items\Models\Product;
use Processton\Items\Models\Service;
use Processton\Items\Models\SubscriptionPlan;

class ItemsResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'polaris-inventory-icon';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(ItemsForm::makeEditFrom());
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema(ItemsInfoList::make());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('entity_type')->label('Type')->getStateUsing(fn($record) => match ($record->entity_type) {
                    Product::class =>'Product',
                    Service::class => 'Service',
                    Asset::class => 'Asset',
                    SubscriptionPlan::class => 'Subscription Plan',
                    default => null,
                }),
                Tables\Columns\TextColumn::make('entity.name')->label('Name'),
                Tables\Columns\TextColumn::make('price')->label('Price')->html()->getStateUsing(function ($record) {
                    return '<a class="p-1 rounded-sm text-xs" style="background-color: ' . $record->currency->color . '50;">' . $record->price_string . '</a>';
                }),
                Tables\Columns\TextColumn::make('')->label('Prices')->html()->getStateUsing(function ($record) {
                    return implode('', $record->prices->map(function ($price) {
                        return '<a title="' . $price->price_string . '" class="p-1 rounded-sm text-xs" style="background-color: '. $price->currency->color . '50;">'.$price->price_string. '</a>';
                    })->toArray());
                }),
            ])
            ->actions([
                EditItems::make(),
                ViewItems::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItems::route('/create'),
            'edit' => Pages\EditItems::route('/{record}/edit'),
        ];
    }
}
