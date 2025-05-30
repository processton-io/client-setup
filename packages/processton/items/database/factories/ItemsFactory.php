<?php

namespace Processton\ItemsDatabase\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Processton\Items\Models\Asset;
use Processton\Items\Models\Item;
use Processton\Items\Models\ItemPrice;
use Processton\Items\Models\Product;
use Processton\Items\Models\Service;
use Processton\Items\Models\SubscriptionPlan;
use Processton\Locale\Models\Currency;
use Processton\Org\Models\Org;

class ItemsFactory extends Factory
{
    protected $model = Item::class;

    public function definition(): array
    {
        $entityTypes = [
            Product::class,
            Service::class,
            SubscriptionPlan::class,
            Asset::class,
        ];

        $entityType = $this->faker->randomElement($entityTypes);
        $currencyQuery = Currency::query();

        if ($entityType === Product::class) {
            $entity = Product::factory()->create();
        } elseif ($entityType === Service::class) {
            $entity = Service::factory()->create();
        } elseif ($entityType === SubscriptionPlan::class) {
            $entity = SubscriptionPlan::factory()->create();
        } elseif ($entityType === Asset::class) {
            $entity = Asset::factory()->create();
        }

        return [
            'entity_type' => $entityType,
            'entity_id' => $entity->id,
            'sku' => $this->faker->unique()->ean13,
            'currency_id' => $currencyQuery->inRandomOrder()->value('id'),
            'price' => $this->faker->randomFloat(2, 10, 100),
        ];
    }

    public function configure(): self
    {
        return $this->afterCreating(function (Item $item) {
            // Create related prices
            
            ItemPrice::factory()->count(3)->create([
                'item_id' => $item->id,
                // 'price' => 
            ]);
        });
    }
}
