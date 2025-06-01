<?php

namespace Processton\Contact\Trait;

use Processton\Contact\Models\Contact;

trait HasContact
{

    public function contact(){

        return $this->belongsTo(Contact::class);

    }

}