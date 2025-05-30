<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Processton\AccessControll\Seeders\AccessControllSeeder;
use Processton\Campaigns\Seeders\CampaignSeeder;
use Processton\CustomerDatabase\Seeders\CustomersSeeder;
use Processton\Form\Seeders\FormSeeder;
use Processton\ItemsDatabase\Seeders\ItemsSeeder;
use Processton\LeadDatabase\Seeders\LeadSeeder;
use Processton\LocaleDatabase\Seeders\LocaleSeeder;
use Processton\OrgDatabase\Seeders\OrgsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(LocaleSeeder::class);

        $this->call(OrgsSeeder::class);
        $this->call(AccessControllSeeder::class);
        $this->call(CustomersSeeder::class);
        $this->call(LeadSeeder::class);
        $this->call(ItemsSeeder::class);

        $this->call(CampaignSeeder::class);
        $this->call(FormSeeder::class);
    }
}
