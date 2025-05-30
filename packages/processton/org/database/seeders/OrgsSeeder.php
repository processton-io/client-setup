<?php

namespace Processton\OrgDatabase\Seeders;

use Illuminate\Database\Seeder;
use Processton\Locale\Models\Currency;
use Processton\Org\Models\Org;

class OrgsSeeder extends Seeder
{
    public function run(): void
    {

        Org::create([
            'type' => 'image',
            'group' => 'Basic',
            'title' => 'Logo',
            'description' => 'your org logo',
            'org_key' => 'logo',
            'org_value' => null, // 'Your Company Logo'
        ]);

        Org::create([
            'type' => 'string',
            'group' => 'Basic',
            'title' => 'Org Title',
            'description' => 'your org name',
            'org_key' => 'title',
            'org_value' => null, // 'Your Company Name'
        ]);

        Org::create([
            'type' => 'text',
            'group' => 'Basic',
            'title' => 'Org Description',
            'description' => 'your org description',
            'org_key' => 'description',
            'org_value' => null, // 'Your Company Description'
        ]);

        Org::create([
            'type' => 'string',
            'group' => 'Financial',
            'title' => 'Tax ID',
            'description' => 'your org tax id',
            'org_key' => 'tax_id',
            'org_value' => null, // 'Your Company Tax ID'
        ]);

        $Currencies = Currency::all()->pluck('name', 'id')->toArray();

        Org::create([
            'type' => 'select',
            'group' => 'Financial',
            'title' => 'Primary Currency',
            'description' => 'primary currency of your business',
            'org_key' => 'primary_currency',
            'org_value' => null, // 'Your Company Tax Number'
            'org_options' => $Currencies
        ]);


        Org::create([
            'type' => 'multiselect',
            'group' => 'Financial',
            'title' => 'Other Currencies',
            'description' => 'other currencies your business accepts',
            'org_key' => 'other_currencies',
            'org_value' => null,
            'org_options' => $Currencies
        ]);

        Org::create([
            'type' => 'select',
            'group' => 'Financial',
            'title' => 'Financial Calendar',
            'description' => 'your org financial calendar',
            'org_key' => 'financial_calendar',
            'org_value' => null,
            'org_options' => [
                'january_december' => 'January-December',
                'february_january' => 'February-January',
                'march_february' => 'March-February',
                'april_march' => 'April-March',
                'may_april' => 'May-April',
                'june_may' => 'June-May',
                'july_june' => 'July-June',
                'august_july' => 'August-July',
                'september_august' => 'September-August',
                'october_september' => 'October-September',
                'november_october' => 'November-October',
                'december_november' => 'December-November',
            ]

        ]);
    }
}
