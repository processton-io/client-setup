<?php

namespace Processton\Items\Filament\Resources\ItemsResource\Mutators;

use Processton\Items\Models\Product;
use Processton\Items\Models\Service;
use Processton\Items\Models\SubscriptionPlan;
use Processton\Items\Models\Asset;

class BeforeCreate {

    public static function mutate(array $data): array
    {
        $data['creator_id'] = auth()->id();
        $entityType = $data['entity_type'] ?? null;
        if ($entityType === Product::class){
            $entity = Product::create([
                'name' => $data['entity']['name']
            ]);
        }else if($entityType === Service::class){
            $entity = Service::create([
                'name' => $data['entity']['name']
            ]);
        }else if($entityType === SubscriptionPlan::class){
            $entity = SubscriptionPlan::create([
                'name' => $data['entity']['name']
            ]);
        }else if($entityType === Asset::class){
            $entity = Asset::create([
                'name' => $data['entity']['name']
            ]);
        } else {
            throw new \InvalidArgumentException("Unsupported entity type: $entityType");
        }
        
        $data['enity_id'] = $entity->id;


        return [
            'entity_type' => $entityType,
            'entity_id' => $entity->id,
            'sku' => $data['sku'],
            'price' => $data['price'] ?? null,
            'creator_id' => $data['creator_id'] ?? null,
            'prices' => $data['prices'] ?? [],
            'currency_id' => config('org.primary_currency')
        ];
    }
}
