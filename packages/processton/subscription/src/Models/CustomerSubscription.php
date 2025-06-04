<?php

namespace Processton\Subscription\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class CustomerSubscription extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'customer_subscriptions';

    protected $fillable = [
        'user_id',
        'item_id',
        'customer_id',
        'status',
        'end_date',
        'cancelled_at',
        'last_payment_date',
        'next_payment_date',
        'trial_ends_at',
        'amount',
        'currency_id',
        'payment_method',
        'frequency',
        'frequency_interval',
    ];

    /**
     * Create a new factory instance for the model.
     */
    // protected static function newFactory()
    // {
    //     return \Processton\Cart\Database\Factories\CartFactory::new();
    // }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function customer()
    {
        return $this->belongsTo(\Processton\Customer\Models\Customer::class);
    }

    public function item()
    {
        return $this->belongsTo(\Processton\Items\Models\Item::class, 'item_id');
    }
    public function currency()
    {
        return $this->belongsTo(\Processton\Currency\Models\Currency::class, 'currency_id');
    }
    

}