<?php

namespace Processton\Locale\Filament\Resources\ZoneResource\Pages;

use Processton\Locale\Filament\Resources\ZoneResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewZone extends ViewRecord
{
    protected static string $resource = ZoneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
