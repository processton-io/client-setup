<?php

namespace Processton\AccessControll\Filament\Resources\UserResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Processton\AccessControll\Filament\Resources\UserResource;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
