<?php

namespace Processton\Campaigns\Filament\Resources\Pages;

use Filament\Resources\Pages\CreateRecord;
use Processton\Campaigns\Filament\Resources\CampaignResource;

class CreateCampaign extends CreateRecord
{
    protected static string $resource = CampaignResource::class;
}
