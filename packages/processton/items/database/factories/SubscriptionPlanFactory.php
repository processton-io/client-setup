<?php

namespace Processton\ItemsDatabase\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Processton\Items\Models\SubscriptionPlan;

class SubscriptionPlanFactory extends Factory
{
    protected $model = SubscriptionPlan::class;

    public function definition(): array
    {

        return [
            'name' => $this->faker->word(),
        ];
    }
}
