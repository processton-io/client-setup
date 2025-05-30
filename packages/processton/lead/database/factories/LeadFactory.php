<?php

namespace Processton\LeadDatabase\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Processton\Lead\Enum\LeadStatus;
use Processton\Lead\Models\Lead;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    protected $model = Lead::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement([
                LeadStatus::OPEN->value,
                LeadStatus::PENDING->value,
                LeadStatus::PROSPECTING->value,
                LeadStatus::QUALIFIED->value,
            ]),
            'source' => $this->faker->randomElement(['web', 'email', 'phone']),
            'priority' => $this->faker->randomElement(['low', 'normal', 'high']),
            'submission' => json_encode([
                'name' => $this->faker->name(),
                'email' => $this->faker->unique()->safeEmail(),
                'phone' => $this->faker->phoneNumber(),
                'company_name' => $this->faker->company(),
                'message' => $this->faker->paragraph(),
            ]),
        ];
    }
}
