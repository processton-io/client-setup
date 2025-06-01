<?php

namespace Processton\Items\Traits;

use Processton\Items\Models\Item;

trait IsAnItem
{

    /**
     * 
     * Boot method to register the entity in the Item model
     * 
     * After creating a new element make sure to register it in the Item model
     * so it can be used as an item.
     */

    protected static function booted()
    {
        static::created(function ($model) {
            Item::registerEntity($model);
        });
    }

    public function item()
    {
        return $this->morphTo(Item::class, 'entity');
    }

    protected static function validateAttributes(array $attributes)
    {
        if (empty($attributes['name'])) {
            throw new \InvalidArgumentException('The name attribute is required.');
        }
    }

    protected static function createEntity(array $attributes = [])
    {
        return static::create([
            'name' => $attributes['name'] ?? '',
        ]);
    }

    protected function setPrice($price = 0.00){

        $this->item()->update([
            'price' => $this->price
        ]);
    }
}