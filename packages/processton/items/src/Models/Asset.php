<?php

namespace Processton\Items\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Processton\ItemsDatabase\Factories\AssetFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Processton\Items\Traits\isAnItem;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Asset extends Model
{
    use HasFactory, isAnItem, HasUuids;

    protected $table = 'assets';

    protected $fillable = [
        'name'
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return AssetFactory::new();
    }

    public function item()
    {
        return $this->hasOne(Item::class, 'entity_id')->where('entity_type', Asset::class);
    }

}
