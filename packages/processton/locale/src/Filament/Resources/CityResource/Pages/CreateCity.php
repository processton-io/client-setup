<?php

namespace Processton\Locale\Filament\Resources\CityResource\Pages;

use Processton\Locale\Filament\Resources\CityResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;

class CreateCity extends CreateRecord
{
    protected static string $resource = CityResource::class;

}
