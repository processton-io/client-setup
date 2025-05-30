<?php

namespace Processton\Customer\Filament\Resources\CustomerResource\Pages;

use Processton\Customer\Filament\Resources\CustomerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Processton\Customer\Filament\Resources\CustomerResource\Actions\CreateCustomer;

class ListCustomers extends ListRecords
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateCustomer::make(),
        ];
    }
}
