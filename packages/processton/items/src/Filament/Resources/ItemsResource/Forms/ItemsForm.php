<?php

namespace Processton\Items\Filament\Resources\ItemsResource\Forms;

use Filament\Forms;

class ItemsForm
{

    public static function makeCreateFrom($attributes = [
            [
                'label' => 'Name',
                'type' => 'text',
                'required' => true,
                'maxLength' => 255,
                'unique' => true,
                'helperText' => 'The name of the item.',
                'columnSpan' => '1',
                'map' => 'name'
            ]
        ]): array
    {
        return self::make($attributes, false);
    }

    public static function makeEditFrom($attributes = [
            [
                'label' => 'Name',
                'type' => 'text',
                'required' => true,
                'maxLength' => 255,
                'unique' => true,
                'helperText' => 'The name of the item.',
                'columnSpan' => '1',
                'map' => 'name'
            ]
        ]): array
    {
        return self::make($attributes, true);
    }


    public static function make($attributes = [], $isEditForm): array {

        $entityMapFields = [];

        if(!$isEditForm) {
            $entityMapFields = [
                Forms\Components\Select::make('entity_type')
                    ->label('Item Type')
                    ->options([
                        \Processton\Items\Models\Product::class => 'Product',
                        \Processton\Items\Models\Service::class => 'Service',
                        \Processton\Items\Models\Asset::class => 'Asset',
                        \Processton\Items\Models\SubscriptionPlan::class => 'Subscription Plan',
                    ])
                    ->required()
            ];
        } else {
            $entityMapFields = [
                Forms\Components\Hidden::make('entity_type'),
                Forms\Components\Hidden::make('entity_id')

            ];
        }
        
        return [

            Forms\Components\Split::make([
                Forms\Components\Section::make([
                    ... $entityMapFields,
                    Forms\Components\TextInput::make('sku')
                        ->label('SKU')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true)
                        ->helperText('Stock Keeping Unit, a unique identifier for the item.'),

                    Forms\Components\TextInput::make('price')
                        ->label('Price')
                        ->required()
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(999999999)
                        ->default(0)
                        ->helperText('The price of the item in the default currency.'),

                    Forms\Components\Select::make('currency_id')
                        ->label('Currency')
                        ->relationship('currency', 'name')
                        ->required()
                        ->searchable()
                        ->disabled()
                        ->default(config('org.primary_currency'))
                        ->helperText('Default currency of your org, you cannot change it')
                        ->preload(),
                ])->grow(false),
                Forms\Components\Section::make([
                    Forms\Components\Fieldset::make('Basic Details')
                        ->relationship('entity')
                        ->dehydrated()
                        ->schema([
                            ... collect($attributes)->map(function ($attribute) {
                                if ($attribute['type'] === 'select') {
                                    return Forms\Components\Select::make($attribute['map'])
                                        ->label($attribute['label'])
                                        ->options($attribute['options'])
                                        ->required($attribute['required'] ?? false)
                                        ->searchable()
                                        ->preload()
                                        ->columnSpan($attribute['columnSpan'] ?? 'full');
                                }elseif ($attribute['type'] === 'textarea') {
                                    return Forms\Components\Textarea::make($attribute['map'])
                                        ->label($attribute['label'])
                                        ->required($attribute['required'] ?? false)
                                        ->maxLength($attribute['maxLength'] ?? 255)
                                        ->helperText($attribute['helperText'] ?? '')
                                        ->columnSpan($attribute['columnSpan'] ?? 'full');
                                }elseif ($attribute['type'] === 'number') {
                                    return Forms\Components\TextInput::make($attribute['map'])
                                        ->label($attribute['label'])
                                        ->required($attribute['required'] ?? false)
                                        ->numeric()
                                        ->minValue($attribute['minValue'] ?? 0)
                                        ->maxValue($attribute['maxValue'] ?? 999999999)
                                        ->default($attribute['default'] ?? 0)
                                        ->helperText($attribute['helperText'] ?? '')
                                        ->columnSpan($attribute['columnSpan'] ?? 'full');
                                }elseif ($attribute['type'] === 'image'){
                                    return Forms\Components\FileUpload::make($attribute['map'])
                                        ->label($attribute['label'])
                                        ->image()
                                        ->required($attribute['required'] ?? false)
                                        ->maxSize(1024) // 1MB
                                        ->columnSpan($attribute['columnSpan'] ?? 'full');
                                }else{
                                    return Forms\Components\TextInput::make($attribute['map'])
                                        ->label($attribute['label'])
                                        ->required($attribute['required'] ?? false)
                                        ->maxLength($attribute['maxLength'] ?? 255)
                                        ->unique(ignoreRecord: true)
                                        ->helperText($attribute['helperText'] ?? '')
                                        ->columnSpan($attribute['columnSpan'] ?? 'full');
                                }

                            })->toArray(),
                        ]),
                    Forms\Components\Section::make('Prices')
                        ->hiddenOn('create')
                        ->schema([
                            Forms\Components\Repeater::make('prices')
                                ->label('Item Prices')
                                ->relationship()
                                ->schema([
                                    Forms\Components\Select::make('currency_id')
                                        ->label('Currency')
                                        ->relationship('currency', 'name')
                                        ->required()
                                        ->searchable()
                                        ->preload(),
                                    Forms\Components\TextInput::make('price')
                                        ->label('Price')
                                        ->required()
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(999999999)
                                        ->default(0),
                                ])
                                ->columns(2)
                                ->createItemButtonLabel('Add Price'),
                            ]),
                ])->grow(true),
            ])->from('md')->columnSpan('full'),




            

            
            

            
            

        ];
    }
}
