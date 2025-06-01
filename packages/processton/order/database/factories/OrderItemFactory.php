<?php

namespace Processton\OrderDatabase\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Processton\Order\Models\OrderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => \Processton\Order\Models\Order::factory(),
            'item_id' => null, // This should be set to a valid item ID later
            'item_type' => 'product', // or 'service', depending on your use case
            'quantity' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'total_price' => function (array $attributes) {
                return $attributes['quantity'] * $attributes['price'];
            },
        ];
    }
}