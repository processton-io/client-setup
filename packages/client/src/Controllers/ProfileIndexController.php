<?php

namespace Processton\Client\Controllers;

use App\Models\User;

class ProfileIndexController extends Controller
{

    public function index()
    {

        $customer = request()->attributes->get('customer');


        if (!$customer) {
            abort(404);
        }

        return view('client::profile-index',[
            'profile' => $customer->id,
            'customer' => $customer,
        ]);
    }

}
