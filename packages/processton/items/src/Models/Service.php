<?php

namespace Processton\Items\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Processton\ItemsDatabase\Factories\ServiceFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Processton\Items\Traits\isAnItem;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Service extends Model
{
    use HasFactory, isAnItem, HasUuids;

    protected $table = 'services';

    protected $fillable = [
        'name'
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return ServiceFactory::new();
    }

    public function item()
    {
        return $this->hasOne(Item::class, 'entity_id')->where('entity_type', Service::class);
    }

}
