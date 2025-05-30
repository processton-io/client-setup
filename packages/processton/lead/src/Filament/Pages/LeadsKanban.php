<?php

namespace Processton\Lead\Filament\Pages;

use Mokhosh\FilamentKanban\Pages\KanbanBoard;
use Processton\Lead\Enum\LeadStatus;
use Processton\Lead\Models\Lead;

class LeadsKanban extends KanbanBoard
{
    protected static string $model = Lead::class;
    protected static string $statusEnum = LeadStatus::class;

    protected static ?string $navigationLabel = 'Leads';
    protected static ?string $title = 'Leads';
}
