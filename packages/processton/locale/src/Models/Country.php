<?php

namespace Processton\Locale\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /** @use HasFactory<\Database\Factories\CountryFactory> */
    use HasFactory;

    protected $guarded = [];

    // protected $fillable = ['name', 'region_id', 'iso_2_code', 'iso_3_code', 'dial_code'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
