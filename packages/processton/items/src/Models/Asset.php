<?php

namespace Processton\Items\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Processton\ItemsDatabase\Factories\AssetFactory;

class Asset extends Model
{
    use HasFactory;

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
        return $this->morphTo(Item::class, 'entity');
    }

}
