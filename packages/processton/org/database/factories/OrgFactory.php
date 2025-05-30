<?php

namespace Processton\OrgDatabase\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Processton\Org\Models\Org;

class OrgFactory extends Factory
{
    protected $model = Org::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->word(),
            'org_key' => $this->faker->word(),
            'org_value' => $this->faker->word()
        ];
    }
}
