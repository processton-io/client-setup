<?php

namespace Processton\Lead\Enum;

use Mokhosh\FilamentKanban\Concerns\IsKanbanStatus;

enum LeadStatus: string
{
    use IsKanbanStatus;

    case OPEN = 'Open';
    case PENDING = 'Pending';
    case PROSPECTING = 'Prospecting';
    case QUALIFIED = 'Qualified';
}
