<?php

namespace Processton\Company\Filament\Resources\CompanyResource\Pages;

use Processton\Company\Filament\Resources\CompanyResource;
use Filament\Resources\Pages\ViewRecord;

class ViewCompanyPage extends ViewRecord
{
    protected static string $resource = CompanyResource::class;

    protected static string $view = 'processton-company::view-company-profile-detail';

}
