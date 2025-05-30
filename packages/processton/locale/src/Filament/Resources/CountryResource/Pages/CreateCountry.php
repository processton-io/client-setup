<?php

namespace Processton\Locale\Filament\Resources\CountryResource\Pages;

use Processton\Locale\Filament\Resources\CountryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;

class CreateCountry extends CreateRecord
{
    protected static string $resource = CountryResource::class;

}
