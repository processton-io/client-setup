<?php

namespace Processton\Campaigns\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Processton\Campaigns\Models\Campaign;

class CampaignFactory extends Factory
{
    protected $model = Campaign::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'start_date' => $this->faker->date(),
            'timeline' => [
                ['action' => 'publish_form', 'details' => 'Form X'],
                ['action' => 'send_email', 'details' => 'Email X'],
            ],
        ];
    }
}
