<?php

namespace Processton\Locale\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    /** @use HasFactory<\Database\Factories\CountryFactory> */
    use HasFactory;

    protected $guarded = [];

    // protected $fillable = ['name', 'code', 'country_id'];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
