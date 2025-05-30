<?php

namespace Processton\ItemsDatabase\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Processton\Items\Models\Item;
use Processton\Items\Models\ItemPrice;
use Processton\Locale\Models\Currency;

class ItemPricesFactory extends Factory
{
    protected $model = ItemPrice::class;

    public function definition(): array
    {

        return [
            'currency_id' => Currency::query()->inRandomOrder()->value('id'),
            'item_id' => Item::query()->inRandomOrder()->value('id'),
            'price' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
