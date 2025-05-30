<?php

namespace Processton\Org\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Processton\Org\Models\Org;

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
