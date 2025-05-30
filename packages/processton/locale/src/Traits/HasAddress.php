<?php

namespace Processton\Locale\Traits;

use Processton\Locale\Models\Address;

Trait HasAddress
{

    public function address()
    {
        return $this->hasOne(Address::class, 'id', 'address_id');
    }

    public function getAddressAttribute()
    {
        return $this->address()->first();
    }

    public function setAddressAttribute($value)
    {
        $this->address()->updateOrCreate([], $value);
    }
}
