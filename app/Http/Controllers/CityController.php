<?php

namespace App\Http\Controllers;

use App\Models\Type_city;
use App\Http\Requests\StoreType_cityRequest;
use App\Http\Requests\UpdateType_cityRequest;
use App\DataTables\GlobalDataTable;

class CityController extends Controller
{
    public function index(GlobalDataTable $dataTable)
    {
        $listOfCity = Type_city::getAllCities();

        return $dataTable->render('City.index', compact(
            'listOfCity',
        ));
    }
    
    public function create()
    {
        //
    }
    
    public function store(StoreType_cityRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        Type_city::create($validated);

        return redirect()->route('admin.city.index')
                        ->with('success', 'City added successfully!');
    }
    
    public function show(Type_city $type_city)
    {
        //
    }
    
    public function edit(Type_city $city)
    {
        return view('city.edit', compact(
            'city',
        ));
    }
    
    public function update(UpdateType_cityRequest $request, Type_city $city)
    {
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();

        $city->update($validated);

        return redirect()->route('admin.city.index')
        ->with('success', 'City updated successfully!');
    }
    
    public function destroy(Type_city $city)
    {
        $deleted = $city->delete();

        return redirect()->route('admin.city.index')
                        ->with('success', 'City deleted successfully!');
    }
}
