<?php

namespace Processton\Abacus\Filament\Resources\AbacusIncomingResource\Pages;

use Processton\Abacus\Filament\Resources\AbacusIncomingResource;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Resources\Pages\ListRecords;

class ListAbacusIncomings extends ListRecords
{
    protected static string $resource = AbacusIncomingResource::class;

    protected static ?string $title = 'Transactions';

    protected static ?string $navigationIcon = 'heroicon-s-inbox-arrow-down';

    protected static ?string $breadcrumb = 'Transactions';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->modal(),
        ];
    }
}
