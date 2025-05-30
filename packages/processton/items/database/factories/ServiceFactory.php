<?php

namespace Processton\ItemsDatabase\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Processton\Items\Models\Service;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {

        return [
            'name' => $this->faker->word(),
        ];
    }
}
