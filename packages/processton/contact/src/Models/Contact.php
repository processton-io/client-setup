<?php

namespace Processton\Contact\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Processton\ContactDatabase\Factories\ContactFactory;
use Processton\Customer\Models\Customer;
use Processton\Customer\Models\CustomerContact;

class Contact extends Model
{

    use HasFactory;


    public static function registerUser($user)
    {
        $contact = new self();
        $contact->last_name = $user->name;
        $contact->email = $user->email;
        $contact->save();

        // Optionally, you can link the contact to the user
        $user->contact_id = $contact->id;
        $user->save();
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return ContactFactory::new();
    }

    protected $fillable = [
        'prefix',
        'first_name',
        'last_name',
        'email',
        'phone',
        'linkedin_profile',
        'twitter_handle',
        'notes'
    ];


    protected $appends = [
        'name'
    ];

    public function getNameAttribute()
    {
        if (!$this->prefix) {
            return $this->first_name . ' ' . $this->last_name;
        }
        return $this->prefix . ' ' . $this->first_name . ' ' . $this->last_name;
    }

    public function customerContacts()
    {
        return $this->hasMany(CustomerContact::class, 'contact_id');
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class, CustomerContact::class, 'contact_id')->withPivot(['job_title', 'department']);
    }
}
