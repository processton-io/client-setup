<?php

namespace Processton\Campaigns\Seeders;

use Illuminate\Database\Seeder;
use Processton\Campaigns\Models\Campaign;

class CampaignSeeder extends Seeder
{
    public function run(): void
    {
        Campaign::create([
            'title' => 'Sample Campaign',
            'description' => 'This is a sample campaign.',
            'start_date' => now(),
            'timeline' => [
                ['action' => 'publish_form', 'details' => 'Form A'],
                ['action' => 'send_email', 'details' => 'Welcome Email'],
            ],
        ]);
    }
}
