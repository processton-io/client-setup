<?php

namespace Processton\ItemsDatabase\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Processton\Items\Models\Asset;

class AssetFactory extends Factory
{
    protected $model = Asset::class;

    public function definition(): array
    {

        return [
            'name' => $this->faker->word(),
        ];
    }
}
