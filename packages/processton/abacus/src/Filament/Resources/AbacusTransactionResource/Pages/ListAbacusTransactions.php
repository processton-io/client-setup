<?php

namespace Processton\Abacus\Filament\Resources\AbacusTransactionResource\Pages;

use Processton\Abacus\Filament\Resources\AbacusTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAbacusTransactions extends ListRecords
{
    protected static string $resource = AbacusTransactionResource::class;

    protected static ?string $title = 'Enteries';

    protected static ?string $navigationIcon = 'heroicon-s-table-cells';

    protected static ?string $breadcrumb = 'Records';

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make()->modal()->label('Add Transaction')->icon('heroicon-o-plus-circle')->iconPosition('after'),
        ];
    }
}
