<?php

namespace Processton\Company\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Processton\CompanyDatabase\Factories\CompanyFactory;

class Company extends Model
{
    use HasFactory;

    protected $appends = [
        'profile_url'
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return CompanyFactory::new();
    }

    public function getProfileUrlAttribute()
    {
        return 'https://ui-avatars.com/api/?background=0D8ABC&w=150&h=150&color=fff&name=' . urlencode(
            $this->name
        );
    }

    protected $fillable = [
        'name',
        'domain',
        'phone',
        'website',
        'industry',
        'annual_revenue',
        'number_of_employees',
        'lead_source',
        'description'
    ];
}
