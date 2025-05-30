<?php

namespace Processton\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Processton\Contact\Models\Contact;

class CustomerContact extends Model
{
    protected $fillable = [
        'customer_id',
        'contact_id',
        'job_title',
        'department',
    ];

    protected $appends = [
        'contact_name',
        'contact_email'
    ];

    public function getContactNameAttribute()
    {
        return $this->contact->name ?? null;
    }

    public function getContactEmailAttribute()
    {
        return $this->contact->email ?? null;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
