<?php

namespace Processton\Customer\Filament\Resources\CustomerResource\Mutators;

class BeforeCreate {

    public static function mutate(array $data): array
    {
        $data['creator_id'] = auth()->id();
        // $data['prefix'] = substr(str_replace(' ', '_', strtolower($data['name'])), 0, 10);

        return $data;
    }
}
