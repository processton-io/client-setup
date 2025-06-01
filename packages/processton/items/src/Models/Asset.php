<?php

namespace Processton\Items\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Processton\ItemsDatabase\Factories\AssetFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use HasFactory;

    protected $table = 'assets';

    protected $fillable = [
        'name'
    ];

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

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return AssetFactory::new();
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

}
