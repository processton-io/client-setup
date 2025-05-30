<?php

namespace Processton\Items\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Processton\ItemsDatabase\Factories\ServiceFactory;

class Service extends Model
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
        return ServiceFactory::new();
    }

    public function item()
    {
        return $this->morphTo(Item::class, 'entity');
    }

}
