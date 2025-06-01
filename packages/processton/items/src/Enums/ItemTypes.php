<?php
namespace Processton\Items\Enums;

use Illuminate\Support\Str;
use Spatie\Enum\Laravel\Enum;

use Processton\Items\Models\Product;
use Processton\Items\Models\Service;
use Processton\Items\Models\SubscriptionPlan;
use Processton\Items\Models\Asset;
/**
 * @method static self product()
 * @method static self service()
 * @method static self subscription()
 */
class ItemTypes extends Enum
{
    protected static function values(): array
    {
        return [
            Product::class => 'product',
            Service::class => 'service',
            SubscriptionPlan::class => 'subscription_plan',
            Asset::class => 'asset',
        ];
    }

    protected static function labels(): array
    {
        return [
            'product' => __('Product'),
            'service' => __('Service'),
            'subscription_plan' => __('Subscription Plan'),
            'asset' => __('Asset'),
        ];
    }

    public function getLabelAttribute()
    {
        return Str::title($this->value);
    }
}