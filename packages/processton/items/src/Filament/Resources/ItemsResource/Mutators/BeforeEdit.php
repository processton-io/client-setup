<?php

namespace Processton\Items\Filament\Resources\ItemsResource\Mutators;

use Processton\Items\Models\Asset;
use Processton\Items\Models\Product;
use Processton\Items\Models\Service;
use Processton\Items\Models\SubscriptionPlan;

class BeforeEdit {

    public static function mutate(array $data): array
    {
        $data['creator_id'] = auth()->id();
        $entityType = $data['entity_type'] ?? null;
        if ($entityType === Product::class){
            $entity = Product::find($data['entity_id']);
        }else if($entityType === Service::class){
            $entity = Service::find($data['entity_id']);
        }else if($entityType === SubscriptionPlan::class){
            $entity = SubscriptionPlan::find($data['entity_id']);
        }else if($entityType === Asset::class){
            $entity = Asset::find($data['entity_id']);
        } else {
            throw new \InvalidArgumentException("Unsupported entity type: $entityType");
        }
        
        $entity->update([
            'name' => $data['entity']['name']
        ]);

        return [
            'sku' => $data['sku'],
            'price' => $data['price'] ?? null,
            'creator_id' => $data['creator_id'] ?? null,
            'prices' => $data['prices'] ?? [],
            'currency_id' => config('org.primary_currency')
        ];
    }
}
