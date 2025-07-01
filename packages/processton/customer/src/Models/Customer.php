<?php

namespace Processton\Customer\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Processton\Company\Models\Company;
use Processton\Contact\Models\Contact;
use Processton\CustomerDatabase\Factories\CustomerFactory;
use Processton\Locale\Models\Address;
use Processton\Locale\Models\Currency;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Processton\Locale\Traits\HasColor;

class Customer extends Model
{
    use HasFactory, HasUuids, HasColor;
    protected $table = 'customers';

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return CustomerFactory::new();
    }

    protected $fillable = [
        'identifier',
        'is_personal',
        'enable_portal',
        'currency_id',
        'company_id',
        'color'
    ];

    protected $casts = [
        'enable_portal' => 'boolean',
        'is_personal' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = [
        'name',
        'profile_picture',
    ];

    public function getNameAttribute()
    {
        return $this->is_personal ? $this->contacts->first()?->name : $this->company?->name;
    }

    public function customerContact()
    {
        return $this->hasOne(CustomerContact::class, 'customer_id');
    }

    public function customerContacts()
    {
        return $this->hasMany(CustomerContact::class, 'customer_id');
    }

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, CustomerContact::class, 'customer_id')->withPivot(['job_title', 'department']);
    }

    public function contact()
    {
        return $this->belongsToMany(Contact::class, CustomerContact::class, 'customer_id')->withPivot(['job_title', 'department']);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }


    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getProfilePictureAttribute()
    {
        $color = $this->color;
        if(!$color){
            $color = self::getRandomColor();
            $this->__set('color', $color);
            $this->save();
        }
        $textColor = self::getTextColor($color);
        //Remove starting hash
        $color = ltrim($color, '#');
        $textColor = ltrim($textColor, '#');
        // use image generator to get the image
        return 'https://ui-avatars.com/api/?name=' . $this->name . '&background=' . $color . '&color=' . $textColor . '&size=128';
    }

    public function addresses(){
        return $this->morphMany(Address::class, 'entity', 'entity_type');
    }


}
