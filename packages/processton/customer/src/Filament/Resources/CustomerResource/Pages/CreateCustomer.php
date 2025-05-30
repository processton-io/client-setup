<?php

namespace Processton\Customer\Filament\Resources\CustomerResource\Pages;

use Processton\Customer\Filament\Resources\CustomerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;
}
