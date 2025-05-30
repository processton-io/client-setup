<?php

namespace Processton\Customer\Filament\Resources\CustomerResource\Pages;

use Processton\Customer\Filament\Resources\CustomerResource;
use Filament\Resources\Pages\ViewRecord;

class ViewCustomerPage extends ViewRecord
{
    protected static string $resource = CustomerResource::class;
    protected static string $view = 'processton-customer::view-customer-profile';
}
