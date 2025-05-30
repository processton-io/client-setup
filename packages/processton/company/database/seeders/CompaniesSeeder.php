<?php

namespace Processton\CompanyDatabase\Seeders;

use Illuminate\Database\Seeder;
use Processton\Company\Models\Company;

class CompaniesSeeder extends Seeder
{
    public function run(): void
    {
        Company::factory()->count(10)->create();
    }
}
