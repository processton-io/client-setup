<?php

namespace Processton\ItemsDatabase\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Processton\Items\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {

        return [
            'name' => $this->faker->word(),
        ];
    }
}
