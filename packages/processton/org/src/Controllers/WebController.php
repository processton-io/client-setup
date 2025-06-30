<?php

namespace Processton\Org\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Processton\Org\Models\Org;
use Processton\Customer\Models\Customer;
use Processton\Company\Models\Company;
use Processton\Contact\Models\Contact;

class WebController extends Controller
{

    public function setOrgBasicProfile(Request $request)
    {

        $fieldSet = [
            'title',
            'description',
        ];

        $orgs = Org::whereIn('org_key' , $fieldSet)->get();

        foreach( $fieldSet as $field){
            $orgSettings[$field] = $orgs->where('org_key', $field)->first();
        }

        if ($request->isMethod('post')) {

            $validated = $request->validate([
                'title' => 'required|string|max:50',
                'description' => 'nullable|string|max:255',
                'ret_url' => 'nullable|string|max:255',
            ]);          
            //Save Org Settings
            foreach ($orgSettings as $setting) {
                if (isset($validated[$setting->org_key])) {
                    $setting->org_value = $validated[$setting->org_key];
                    $setting->save();
                }
            }

            $company = Company::create([
                'name' => $validated['title'],
            ]);

            $customer = Customer::create([
                'identifier' => 'org',
                'is_personal' => false,
                'enable_portal' => true,
                'company_id' => $company->id
            ]);

            $contact = Contact::updateOrCreate([
                'email' => $request->user()->email,
            ],[
                'first_name' => $request->user()->name,
                'last_name' => '',
                'phone' => '',
            ]);

            $customer->contacts()->attach($contact->id, [
                'job_title' => 'Admin',
                'department' => 'Administration',
            ]);


            session()->flash('success', 'Org Basic Profile updated successfully');

            if (isset($validated['ret_url'])) {
                return redirect($validated['ret_url']);
            }
            return redirect('/');
        }

        return view('org::set-org-profile', [
            'orgSettings' => $orgSettings,
        ]);
    }

    public function setOrgFinancialProfile(Request $request)
    {

        $fieldSet = [
            'tax_id',
            'primary_currency',
            'financial_calendar'
        ];

        $orgs = Org::whereIn('org_key', $fieldSet)->get();

        foreach ($fieldSet as $field) {
            $orgSettings[$field] = $orgs->where('org_key', $field)->first();
        }


        if ($request->isMethod('post')) {

            $validated = $request->validate([
                'tax_id' => 'required|string|max:50',
                'primary_currency' => 'required|string|max:255',
                'financial_calendar' => 'required|string|max:255',
                'ret_url' => 'string|max:255',
            ]);

            //Save Org Settings
            foreach ($orgSettings as $setting) {
                if (isset($validated[$setting->org_key])) {
                    $setting->org_value = $validated[$setting->org_key];
                    $setting->save();
                }
            }

            $customer = Customer::where('identifier', 'org')->first();
            if ($customer) {
                $customer->currency_id = $validated['primary_currency'];
                $customer->save();
            }

            session()->flash('success', 'Org Basic Profile updated successfully');

            if (isset($validated['ret_url'])) {
                return redirect($validated['ret_url']);
            }
            return redirect('/');
        }

        return view('org::set-org-profile', [
            'orgSettings' => $orgSettings
        ]);
    }

}
