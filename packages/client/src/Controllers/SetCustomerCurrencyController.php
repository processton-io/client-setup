<?php

namespace Processton\Client\Controllers;

use App\Models\User;
use Processton\Locale\Models\Currency;

class SetCustomerCurrencyController extends Controller
{

    public function index()
    {

        if(request()->method() == 'POST') {

            $this->validate(request(), [
                'currency_id' => 'required|exists:currencies,id',
            ]);

            $customer = request()->attributes->get('customer');
            $customer->currency_id = request('currency_id');
            $customer->save();


            return redirect()->route('profile.index', ['profile' => $customer->id])->with('success', 'Currency updated successfully.');
        }


        return view('client::set-currency',[
            'currencies' => Currency::all(),
        ]);
    }

}
