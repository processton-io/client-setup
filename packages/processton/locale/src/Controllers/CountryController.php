<?php

namespace Processton\Locale\Controllers;

use Illuminate\Http\Request;
use Processton\Locale\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        return response()->json(Country::all());
    }

    public function store(Request $request)
    {
        $country = Country::create($request->validate([
            'name' => 'required|string|max:255|unique:countries,name',
            'iso_2_code' => 'required|string|size:2|unique:countries,iso_2_code',
            'iso_3_code' => 'required|string|size:3|unique:countries,iso_3_code',
            'dial_code' => 'required|string|unique:countries,dial_code',
        ]));

        return response()->json($country, 201);
    }

    public function show(Country $country)
    {
        return response()->json($country);
    }

    public function update(Request $request, Country $country)
    {
        $country->update($request->validate([
            'name' => 'sometimes|string|max:255|unique:countries,name,' . $country->id,
            'iso_2_code' => 'sometimes|string|size:2|unique:countries,iso_2_code,' . $country->id,
            'iso_3_code' => 'sometimes|string|size:3|unique:countries,iso_3_code,' . $country->id,
            'dial_code' => 'sometimes|string|unique:countries,dial_code,' . $country->id,
        ]));

        return response()->json($country);
    }

    public function destroy(Country $country)
    {
        $country->delete();
        return response()->json(['message' => 'Country deleted']);
    }
}
