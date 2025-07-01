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

class Customer extends Model
{
    use HasFactory, HasUuids;
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
        if($color){
            $color = self::getRandomColor();
            $this->color = $color;
            $this->save();
        }
        // use image generator to get the image
        return 'https://ui-avatars.com/api/?name=' . $this->name . '&background=475569&color=' . $color . '&size=128';
    }

    public function addresses(){
        return $this->morphMany(Address::class, 'entity', 'entity_type');
    }

    public static function getRandomColor(){
        $colors = [
            'color' => '#6B8E23',
            'color' => '#00247D',
            'color' => '#FFD700',
            'color' => '#008000',
            'color' => '#FF4500',
            'color' => '#4682B4',
            'color' => '#B22222',
            'color' => '#FFD700',
            'color' => '#8B0000',
            'color' => '#1E90FF',
            'color' => '#FF6347',
            'color' => '#FF4500',
            'color' => '#FF9933',
            'color' => '#00008B',
            'color' => '#00BFFF',
            'color' => '#8A2BE2',
            'color' => '#32CD32',
            'color' => '#FF4500',
            'color' => '#FFD700',
            'color' => '#228B22',
            'color' => '#FF8C00',
            'color' => '#8B0000',
            'color' => '#FF6347',
            'color' => '#008000',
            'color' => '#000000',
            'color' => '#00A859',
            'color' => '#007FFF',
            'color' => '#FF0000',
            'color' => '#FF4500',
            'color' => '#008000',
            'color' => '#FFD700',
            'color' => '#FF6347',
            'color' => '#008080',
            'color' => '#FFA500',
            'color' => '#FF4500',
            'color' => '#FFD700',
            'color' => '#008000',
            'color' => '#FF4500',
            'color' => '#FF6347',
            'color' => '#4682B4',
            'color' => '#FFD700',
            'color' => '#8B0000',
            'color' => '#FF4500',
            'color' => '#FFD700',
            'color' => '#FFD700',
            'color' => '#FF4500',
            'color' => '#008000',
            'color' => '#FF6347',
            'color' => '#4682B4',
            'color' => '#FFA500',
            'color' => '#FF9933',
            'color' => '#FFD700',
            'color' => '#FF4500',
            'color' => '#4682B4',
            'color' => '#FF6347',
            'color' => '#1E90FF',
            'color' => '#FF4500',
            'color' => '#FF6347',
            'color' => '#4682B4',
            'color' => '#FFD700',
            'color' => '#FF4500',
            'color' => '#4682B4',
            'color' => '#FF6347',
            'color' => '#FFD700',
            'color' => '#FF4500',
            'color' => '#4682B4',
            'color' => '#FF6347',
            'color' => '#FFD700',
            'color' => '#FF4500',
            'color' => '#FFD700',
            'color' => '#FF4500',
            'color' => '#FFD700',
        ];

        return $colors[array_rand($colors)];
    }


}
