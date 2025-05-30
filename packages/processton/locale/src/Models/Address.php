<?php

namespace Processton\Locale\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $guarded = [];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function entity()
    {
        return $this->morphTo('entity_id', 'entity_type');
    }
    public function getFullAddressAttribute()
    {

        return implode(', ',array_filter([
            $this->street,
            $this->address_line_2,
            $this->city,
            $this->state,
            $this->postal_code,
            $this->country->name
        ]));
    }

    public function getEntityNameAttribute()
    {
        return in_array($this->entity_type, config('panels.locale.data.models_mapping', [])) ? array_search($this->entity_type, config('panels.locale.data.models_mapping')) : $this->entity_type;
    }

    public function getRelatedEntityAttribute()
    {
        return $this->entity_type::find($this->entity_id);
    }

    public function getRelatedEntityNameAttribute()
    {
        return $this->related_entity->locale_title ?? null;
    }

}
