<?php

namespace Processton\Customer\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Processton\Locale\Models\Currency;

class SetCustomerCurrencyController extends Controller
{

    public function index(Request $request)
    {

        if(request()->method() == 'POST') {

            $request->validate([
                'currency_id' => 'required|exists:currencies,id',
            ]);

            $customer = request()->attributes->get('customer');
            $customer->currency_id = request('currency_id');
            $customer->save();


            return redirect()->route('profile.index', ['profile' => $customer->id])->with('success', 'Currency updated successfully.');
        }


        return view('processton-customer::set-currency',[
            'currencies' => Currency::all(),
        ]);
    }

}
