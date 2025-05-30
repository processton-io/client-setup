<?php

namespace Processton\Locale\Traits;

use Processton\Locale\Models\Country;

Trait HasCountry
{
    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function getCountryAttribute()
    {
        return $this->country()->first();
    }

    public function setCountryAttribute($value)
    {
        $this->country()->updateOrCreate([], $value);
    }

}
