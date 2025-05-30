<?php
namespace Processton\Locale\Stats;

use Spatie\Stats\BaseStats;

class ZoneIncident extends BaseStats
{
    public function getName(): string
    {
        return 'zones-counter';
    }
}
