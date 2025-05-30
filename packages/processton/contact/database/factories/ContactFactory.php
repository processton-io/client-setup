<?php

namespace Processton\ContactDatabase\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Processton\Contact\Models\Contact;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'prefix'            => $this->faker->randomElement(['Mr.', 'Ms.', 'Dr.', '']),
            'first_name'       => $this->faker->firstName,
            'last_name'        => $this->faker->lastName,
            'email'            => $this->faker->unique()->safeEmail,
            'phone'            => $this->faker->phoneNumber,
            'linkedin_profile' => $this->faker->url,
            'twitter_handle'   => '@' . $this->faker->userName,
            'notes'            => $this->faker->sentence,
        ];
    }
}
