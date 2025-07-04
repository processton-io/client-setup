<?php

namespace Processton\AbacusDatabase\Seeders;

use Processton\Abacus\Models\AbacusYear;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Processton\Abacus\Models\AbacusIncoming;
use Processton\Abacus\Models\AbacusTransaction;

class AbacusYearSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $year = AbacusYear::create([
                'start_date' => Carbon::create(2025, 1, 1),
                'end_date' => Carbon::create(2025, 12, 31),
            ]);

            

            $events = [
                // Capital investment
                ['desc' => 'Initial capital investment', 'amount' => 2_000_000, 'debit' => 'Cash in Hand', 'credit' => 'Owner’s Capital'],

                // Sales
                ['desc' => 'Product sale - cash', 'amount' => 450_000, 'debit' => 'Cash in Hand', 'credit' => 'Sales Revenue'],
                ['desc' => 'Service rendered - bank', 'amount' => 300_000, 'debit' => 'Bank Accounts', 'credit' => 'Service Revenue'],

                // Expenses
                ['desc' => 'Monthly rent payment', 'amount' => 50_000, 'debit' => 'Rent Expense', 'credit' => 'Cash in Hand'],
                ['desc' => 'Electricity bill payment', 'amount' => 15_000, 'debit' => 'Utilities', 'credit' => 'Bank Accounts'],
                ['desc' => 'Employee salaries', 'amount' => 400_000, 'debit' => 'Salaries & Wages', 'credit' => 'Bank Accounts'],
                ['desc' => 'Marketing campaign', 'amount' => 100_000, 'debit' => 'Marketing & Advertising', 'credit' => 'Cash in Hand'],

                // Asset purchases
                ['desc' => 'Company vehicle purchased', 'amount' => 1_200_000, 'debit' => 'Vehicles', 'credit' => 'Bank Accounts'],
                ['desc' => 'Office furniture purchased', 'amount' => 300_000, 'debit' => 'Furniture & Fixtures', 'credit' => 'Cash in Hand'],

                // Prepaid expense
                ['desc' => 'Prepaid rent for 6 months', 'amount' => 300_000, 'debit' => 'Prepaid Expenses', 'credit' => 'Bank Accounts'],

                // Inventory
                ['desc' => 'Inventory purchased for resale', 'amount' => 500_000, 'debit' => 'Inventory', 'credit' => 'Bank Accounts'],

                // Loan activity
                ['desc' => 'Business loan received', 'amount' => 1_000_000, 'debit' => 'Bank Accounts', 'credit' => 'Loans Payable'],
                ['desc' => 'Partial loan repayment', 'amount' => 400_000, 'debit' => 'Loans Payable', 'credit' => 'Bank Accounts'],

                // Depreciation
                ['desc' => 'Depreciation of assets', 'amount' => 120_000, 'debit' => 'Depreciation Expense', 'credit' => 'Accumulated Depreciation'],

                // Drawings
                ['desc' => 'Owner withdrew cash for personal use', 'amount' => 150_000, 'debit' => 'Owner Drawings', 'credit' => 'Cash in Hand'],
            ];

            foreach ($events as $index => $event) {
                $date = Carbon::create(2025, 1, 1)->addDays(rand(0, 364));

                $incoming = AbacusIncoming::create([
                    'reference' => 'EVT-' . Str::padLeft($index + 1, 4, '0'),
                    'description' => $event['desc'],
                    'amount' => $event['amount'],
                    'date' => $date,
                ]);

                AbacusTransaction::insert([
                    [
                        'abacus_incoming_id' => $incoming->id,
                        'abacus_chart_of_account_id' => $this->getAccount($event['debit']),
                        'abacus_year_id' => $year->id,
                        'amount' => $event['amount'],
                        'entry_type' => 'debit',
                        'date' => $date,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'abacus_incoming_id' => $incoming->id,
                        'abacus_chart_of_account_id' => $this->getAccount($event['credit']),
                        'abacus_year_id' => $year->id,
                        'amount' => $event['amount'],
                        'entry_type' => 'credit',
                        'date' => $date,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ]);
            }
        });
    }

    public function getAccount($name) {
        return \Processton\Abacus\Models\AbacusChartOfAccount::where('name', $name)->firstOrFail()->id;
    }
}
