<?php

namespace Processton\Cart\Controllers\Web;

use Processton\Cart\Controllers\Controller;
use Processton\Customer\Models\Customer;

class WebController extends Controller
{

    public function checkout($profile)
    {
        $user = auth()->user();

        $customer = Customer::find($profile);

        return view('processton-cart::checkout', [
            'user' => $user,
        ]);
    }

}
