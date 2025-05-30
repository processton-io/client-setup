<?php

namespace Processton\AccessControll\Filament\Resources\RoleResource\Pages;

use Processton\AccessControll\Filament\Resources\RoleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        dd($data);
    }
}
