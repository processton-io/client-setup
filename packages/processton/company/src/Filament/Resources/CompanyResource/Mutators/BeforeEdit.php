<?php

namespace Processton\Company\Filament\Resources\CompanyResource\Mutators;

class BeforeEdit {

    public static function mutate(array $data): array
    {
        $data['creator_id'] = auth()->id();

        return $data;
    }
}
