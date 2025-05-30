<?php

namespace Processton\Locale\Controllers;

use App\Models\User;

class WebController extends Controller
{

    public function setCountry()
    {
        if (request()->isMethod('post')) {

            $validated = $this->validate(request(), [
                'country_id' => 'required|exists:countries,id',
                'ret_url' => 'nullable'
            ]);

            $user = auth()->user();
            $user->__set('country_id', $validated['country_id']);
            $user->save();
            session()->flash('success', 'Country set successfully');

            if (isset($validated['ret_url'])) {
                return redirect($validated['ret_url']);
            }
            return redirect()->route('/');

        }
        return view('locale::set-country',[
            'countries' => \Processton\Locale\Models\Country::all()
        ]);
    }

    public function setAddress()
    {
        if (request()->isMethod('post')) {

            $user = auth()->user();

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
                'entity_type' => User::class,
                'entity_id' => $user->id,
                'street' => $validated['address_line_1'],
                'address_line_2' => $validated['address_line_2'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'postal_code' => $validated['postal_code'],
                'country_id' => $validated['country_id'],
            ]);

            $user->__set('address_id', $address->id);
            $user->__set('country_id', $validated['country_id']);
            $user->save();

            session()->flash('success', 'Address set successfully');

            if (isset($validated['ret_url'])) {
                return redirect($validated['ret_url']);
            }
            return redirect()->route('/');

        }
        return view('locale::set-address',[
            'countries' => \Processton\Locale\Models\Country::all()
        ]);
    }

    public function setRegion()
    {
        return view('locale::set-region');
    }

}
