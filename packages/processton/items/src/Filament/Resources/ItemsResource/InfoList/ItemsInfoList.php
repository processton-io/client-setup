<?php

namespace Processton\Items\Filament\Resources\ItemsResource\InfoList;

use Filament\Infolists\Components;

class ItemsInfoList
{
    public static function make(): array
    {
        return [
            Components\Section::make('General Info')
                ->schema([
                    Components\Section::make('Entity Type')
                        ->schema([
                            Components\TextEntry::make('entity_type')
                                ->label('Type')
                                ->getStateUsing(fn($record) => match ($record->entity_type) {
                                    \Processton\Items\Models\Product::class => 'Product',
                                    \Processton\Items\Models\Service::class => 'Service',
                                    \Processton\Items\Models\Asset::class => 'Asset',
                                    \Processton\Items\Models\SubscriptionPlan::class => 'Subscription Plan',
                                    default => null,
                                }),
                        ]),
                    Components\TextEntry::make('entity_id')->label('entity_id'),
                ]),
        ];
    }
}
