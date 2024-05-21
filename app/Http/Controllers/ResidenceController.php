<?php

namespace App\Http\Controllers;

use App\Models\type_residence;
use App\Http\Requests\Storetype_residenceRequest;
use App\Http\Requests\Updatetype_residenceRequest;
use App\DataTables\GlobalDataTable;

class ResidenceController extends Controller
{
    public function index(GlobalDataTable $dataTable)
    {
        $listOfResidence = Type_residence::getAllResidence();

        return $dataTable->render('residence.index', compact(
            'listOfResidence'
        ));
    }

    public function create()
    {
        //
    }
    
    public function store(Storetype_residenceRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        Type_residence::create($validated);

        return redirect()->route('admin.residence.index')
                        ->with('success', 'residence added successfully!');
    }
    
    public function show(type_residence $type_residence)
    {
        //
    }

    public function edit(type_residence $residence)
    {
        return view('residence.edit', compact(
            'residence',
        ));
    }
    
    public function update(Updatetype_residenceRequest $request, type_residence $residence)
    {
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();

        $residence->update($validated);

        return redirect()->route('admin.residence.index')
                        ->with('success', 'residence updated successfully!');
    }
    
    public function destroy(type_residence $residence)
    {
        $deleted = $residence->delete();

        return redirect()->route('admin.residence.index')
                        ->with('success', 'residence deleted successfully!');
    }
}
