<?php

namespace Processton\Contact\Filament\Resources\ContactResource\Mutators;

class BeforeCreate {

    public static function mutate(array $data): array
    {
        $data['creator_id'] = auth()->id();

        return $data;
    }
}
