<?php

namespace Processton\Items\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Processton\ItemsDatabase\Factories\ItemsFactory;
use Processton\Locale\Models\Currency;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'items';

    protected $fillable = [
        'entity_type',
        'entity_id',
        'sku',
        'currency_id',
        'price'
    ];

    protected $appends = [
        'price_string'
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return ItemsFactory::new();
    }

    public function getPriceStringAttribute()
    {
        return $this->price.' ' . $this->currency->symbol;
    }

    public function entity()
    {
        return $this->morphTo();
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'entity_id');
    }

    public function prices()
    {
        return $this->hasMany(ItemPrice::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function getPriceInCurrency($currencyId)
    {
        if ($this->currency_id == $currencyId) {
            return $this->price;
        }

        // Here you would typically convert the price to the desired currency
        // For simplicity, we will just return the original price
        // In a real application, you would use a currency conversion service or logic
        return $this->price; // Placeholder for actual conversion logic
    }

    /**
     * 
     * On products, services, subscription plans, and assets is created it should be registered in the Item model
     * 
     */
    protected static function registerEntity($model)
    {
        // Check if the model is an instance of Item
        if ($model instanceof Item) {
            return;
        }

        
        // ensure that the model is one of the supported types such as Product, Service, SubscriptionPlan, Asset or any model that extends Product, Service, SubscriptionPlan, Asset models
        if (!in_array(get_class($model), [
            Product::class,
            Service::class,
            SubscriptionPlan::class,
            Asset::class
        ])) {
            throw new \InvalidArgumentException("Invalid entity type: " . get_class($model));
        }
        
        //Check if the entity is already registered if not register it
        if (self::where('entity_type', get_class($model))
            ->where('entity_id', $model->id)
            ->exists()) 
            {
                return; // Already registered
            }else{
                // Create a new item instance
                $item = new self();
                $item->entity_type = get_class($model);
                $item->entity_id = $model->id;
                $item->sku = uniqid($model->getTable() . '_');
                $item->price = 0.0; // Default price, can be updated later
                $item->currency_id = config('processton.locale.default_currency_id', 1);
                $item->save();
            }
    }


    /**
     * Generate a new item of the specified type.
     *
     * @param string $type The type of item to create (e.g., 'product', 'service', etc.)
     * @param string $name The name of the item
     * @param string $sku The SKU of the item
     * @param float $price The price of the item
     * @param array $attributes Additional attributes for the item
     * @return Item The created item instance
     * @throws \InvalidArgumentException If the type is invalid or the class does not exist
     */

    public static function generateItem(
        $type,
        $name = '',
        $sku = '',
        $price = 0.0,
        $attributes = []
    ){

        // validate the type it must exist in the ItemTypes enum
        if (!in_array($type, \Processton\Items\Enums\ItemTypes::toArray())) {
            throw new \InvalidArgumentException("Invalid item type: $type");
        }

        $class = \Processton\Items\Enums\ItemTypes::from($type)->value;

        if (!class_exists($class)) {
            throw new \InvalidArgumentException("Item class does not exist: $class");
        }

        $item = new $class();
        if (!$item instanceof Item) {
            throw new \InvalidArgumentException("Item class must extend Item: $class");
        }

        $item->entity_type = $type;
        $item->entity_id = $class::createEntity($name, $attributes)->id;
        $item->sku = $sku ?: uniqid($type . '_');
        $item->price = $price;
        $item->currency_id = config('processton.locale.default_currency_id', 1);


        $item->save();
        return $item;


    }


}
