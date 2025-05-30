<?php

namespace Processton\CompanyDatabase\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Processton\Company\Models\Company;
use Illuminate\Support\Str;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'domain' => $this->faker->domainName,
            'phone' => $this->faker->phoneNumber,
            'website' => $this->faker->url,
            'industry' => $this->faker->randomElement(['Technology', 'Healthcare', 'Retail', 'Finance']),
            'annual_revenue'        => $this->faker->randomFloat(2, 100000, 10000000),
            'number_of_employees'   => $this->faker->numberBetween(10, 1000),
            'lead_source'           => $this->faker->randomElement(['Referral', 'Advertisement', 'Organic']),
            'description' => $this->faker->paragraph,
        ];
    }
}
