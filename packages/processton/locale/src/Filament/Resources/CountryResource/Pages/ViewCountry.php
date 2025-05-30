<?php

namespace Processton\Locale\Filament\Resources\CountryResource\Pages;

use Processton\Locale\Filament\Resources\CountryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCountry extends ViewRecord
{
    protected static string $resource = CountryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
