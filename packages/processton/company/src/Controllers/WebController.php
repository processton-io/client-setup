<?php

namespace Processton\Company\Controllers;

use App\Models\User;
use Processton\Customer\Models\CustomerContact;

class WebController extends Controller
{

    public function setCompany()
    {
        $user = auth()->user();
        $contact = $user->contact;

        $personal_allowed = $user->contact->customers->filter(function ($customer) {
            return $customer->is_personal;
        })->count() < 1 ? true : false;

        if (request()->isMethod('post')) {

            $validated = $this->validate(request(), [
                'company_name' => 'string|max:255|required_without:personal_profile',
                'personal_profile' => 'string|max:3|required_without:company_name',
                'ret_url' => 'nullable',
            ]);


            $customer = \Processton\Customer\Models\Customer::create([
                'enable_portal' => 1,
            ]);

            if(!isset($validated['personal_profile']) || $validated['personal_profile'] != 'on') {

                $company = \Processton\Company\Models\Company::create([
                    'name' => $validated['company_name'],
                ]);

                $customer->__set('company_id', $company->id);
                $customer->__set('is_personal', 0);
                $company->__set('creator_id', $user->id);

            }else{
                $customer->__Set('is_personal', 1);
            }


            $customer->save();

            CustomerContact::create([
                'customer_id' => $customer->id,
                'contact_id' => $contact->id,
            ]);

            session()->flash('success', 'Company created successfully');

            if (isset($validated['ret_url'])) {
                return redirect($validated['ret_url']);
            }
            return redirect()->route('/');

        }

        return view('processton-company::set-company',[
            'can_create_personal_profile' => $personal_allowed
        ]);
    }

}
