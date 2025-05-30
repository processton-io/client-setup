<?php

namespace Processton\Campaigns\Filament\Resources\Pages;

use Filament\Resources\Pages\ListRecords;
use Processton\Campaigns\Filament\Resources\CampaignResource;

class ListCampaigns extends ListRecords
{
    protected static string $resource = CampaignResource::class;

    public function getTitle(): string
    {
        return 'Campaigns';
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Pages\Actions\CreateAction::make(),
        ];
    }
}
