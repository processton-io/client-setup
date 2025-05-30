<?php

namespace Processton\CustomerDatabase\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Processton\Customer\Models\Customer;

class CustomersSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Customer::factory()->count(50)->create()->each(function ($customer) {
            $customer->contacts()->saveMany(
                \Processton\Contact\Models\Contact::factory()->count(
                    $customer->is_personal ? 1 : rand(1, 5)
                )->create()
            );
        });
    }
}
