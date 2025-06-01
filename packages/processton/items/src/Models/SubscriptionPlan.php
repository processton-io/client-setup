<?php

namespace Processton\Items\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Processton\ItemsDatabase\Factories\SubscriptionPlanFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Processton\Items\Traits\isAnItem;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SubscriptionPlan extends Model
{
    use HasFactory, isAnItem, HasUuids;

    protected $table = 'subscription_plans';

    protected $fillable = [
        'name'
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return SubscriptionPlanFactory::new();
    }

    public function item()
    {
        return $this->hasOne(Item::class, 'entity_id')->where('entity_type', SubscriptionPlan::class);
    }

}
