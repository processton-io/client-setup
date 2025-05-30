<?php

namespace Processton\Client\Controllers;

use App\Models\User;

class SelectProfileController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $contact = $user->contact;
        $customers = $contact->customers;

        return view('client::select-account',[
            'customers' => $customers,
        ]);
    }

}
