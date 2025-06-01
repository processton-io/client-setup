<?php

namespace Processton\Order\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Processton\Order\Models\Order;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => \Processton\Customer\Models\Customer::factory(),
            'total_amount' => $this->faker->randomFloat(2, 50, 500),
            'currency' => 1,
            'order_date' => $this->faker->dateTimeThisYear(),
            'shipping_address' => $this->faker->address,
            'billing_address' => $this->faker->address,
        ];
    }


}