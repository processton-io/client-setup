<?php

namespace Processton\Client\Controllers;

use App\Models\User;
use Processton\Customer\Models\Customer;
use Processton\Locale\Models\Currency;

class SetCustomerAddressController extends Controller
{

    public function index()
    {

        $customer = request()->attributes->get('customer');

        if (request()->isMethod('post')) {

            $validated = $this->validate(request(), [
                'address_line_1' => 'required|string|max:255',
                'address_line_2' => 'nullable|string|max:255',
                'city' => 'required|string|max:64',
                'state' => 'nullable|string|max:64',
                'postal_code' => 'required|string|max:16',
                'country_id' => 'required|exists:countries,id',
                'ret_url' => 'nullable',
            ]);

            $address = \Processton\Locale\Models\Address::create([
                'entity_type' => Customer::class,
                'entity_id' => $customer->id,
                'street' => $validated['address_line_1'],
                'address_line_2' => $validated['address_line_2'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'postal_code' => $validated['postal_code'],
                'country_id' => $validated['country_id'],
            ]);


            session()->flash('success', 'Address set successfully');

            if (isset($validated['ret_url'])) {
                return redirect($validated['ret_url']);
            }
            return redirect()->route('/');
        }


        return view('client::set-address',[
            'countries' => \Processton\Locale\Models\Country::all()
        ]);
    }

}
