<?php

namespace App\Http\Controllers;

use App\Models\Type_country;
use App\Models\Type_continent;
use App\Http\Requests\StoreType_countryRequest;
use App\Http\Requests\UpdateType_countryRequest;
use App\DataTables\GlobalDataTable;

class CountryController extends Controller
{
    public function index(GlobalDataTable $dataTable)
    {
        $listOfCountry = Type_country::getAllCountry();
        $listOfContinent = Type_continent::getAllContinent();

        return $dataTable->render('country.index', compact(
            'listOfCountry',
            'listOfContinent',
        ));
    }
    
    public function create()
    {
        //
    }
    
    public function store(StoreType_countryRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        Type_country::create($validated);

        return redirect()->route('admin.country.index')
                        ->with('success', 'Country added successfully!');
    }
    
    public function show(Type_country $type_country)
    {
        //
    }
    
    public function edit(Type_country $country)
    {
        $listOfContinent = Type_continent::getAllContinent();
        $listOfCountry = Type_country::getAllCountry();
        return view('country.edit', compact(
            'country',
            'listOfCountry',
            'listOfContinent',
        ));
    }
    
    public function update(UpdateType_countryRequest $request, Type_country $country)
    {
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();

        $country->update($validated);

        return redirect()->route('admin.country.index')
        ->with('success', 'country updated successfully!');
    }
    
    public function destroy(Type_country $country)
    {
        $deleted = $country->delete();

        return redirect()->route('admin.country.index')
                        ->with('success', 'country deleted successfully!');
    }
}
