<?php

namespace Processton\Locale\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Processton\Locale\Observers\RegionObserver;

class Region extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::observe(RegionObserver::class);
    }

    protected $guarded = [];

    public function countries()
    {
        return $this->hasMany(Country::class);
    }

    public function parent()
    {
        return $this->belongsTo(Region::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Region::class, 'parent_id');
    }

}
