<?php

namespace Processton\AccessControll\Filament\Resources\RoleResource\Pages;

use Processton\AccessControll\Filament\Resources\RoleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Processton\AccessControll\AccessControll;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {

        return $data;
    }

    protected function afterSave(): void
    {
        $users = $this->record->users;

        foreach ($users as $user) {
            AccessControll::syncUserAbilities($user);
        }

    }
}
