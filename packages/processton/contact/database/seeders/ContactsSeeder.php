<?php

namespace Processton\ContactDatabase\Seeders;

use Illuminate\Database\Seeder;
use Processton\Contact\Models\Contact;

class ContactsSeeder extends Seeder
{
    public function run(): void
    {
        Contact::factory()->count(10)->create();
    }
}
