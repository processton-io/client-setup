<?php
namespace Processton\CustomerDatabase\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Processton\Customer\Models\Customer;
use Illuminate\Support\Str;
use Processton\Company\Models\Company;
use Processton\Locale\Models\Currency;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        $isPersonal = $this->faker->boolean;

        $return = [
            'identifier' => $this->faker->unique()->uuid,
            'is_personal' => $isPersonal, // Use $isPersonal here
            'enable_portal' => $this->faker->boolean,
            'currency_id' => Currency::inRandomOrder()->first()?->id,
        ];

        if (!$isPersonal) {
            $return['company_id'] = Company::factory();
        }

        return $return;
    }
}
