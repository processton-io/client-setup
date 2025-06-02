<?php

namespace Processton\Cart\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Cart extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'carts';

    protected $fillable = [
        'user_id',
    ];

    /**
     * Create a new factory instance for the model.
     */
    // protected static function newFactory()
    // {
    //     return \Processton\Cart\Database\Factories\CartFactory::new();
    // }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}