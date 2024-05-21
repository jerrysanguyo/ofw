<?php

namespace App\Http\Controllers;

use App\Models\Type_continent;
use App\Http\Requests\StoreType_continentRequest;
use App\Http\Requests\UpdateType_continentRequest;
use App\DataTables\GlobalDataTable;

class ContinentController extends Controller
{
    public function index(GlobalDataTable $dataTable)
    {
        $listOfContinent = Type_continent::getAllContinent();

        return $dataTable->render('Continent.index', compact(
            'listOfContinent'
        ));
    }
    
    public function create()
    {
        //
    }
    
    public function store(StoreType_continentRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        Type_continent::create($validated);

        return redirect()->route('admin.continent.index')
                        ->with('success', 'Continent added successfully!');
    }
    
    public function show(Type_continent $continent)
    {
        //
    }
    
    public function edit(Type_continent $continent)
    {
        return view('continent.edit', compact(
            'continent',
        ));
    }
    
    public function update(UpdateType_continentRequest $request, Type_continent $continent)
    {
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();

        $continent->update($validated);

        return redirect()->route('admin.continent.index')
        ->with('success', 'Continent updated successfully!');
    }
    
    public function destroy(Type_continent $continent)
    {
        $deleted = $continent->delete();

        return redirect()->route('admin.continent.index')
                        ->with('success', 'Continent deleted successfully!');
    }
}
