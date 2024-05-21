<?php

namespace App\Http\Controllers;

use App\Models\type_religion;
use App\Http\Requests\Storetype_religionRequest;
use App\Http\Requests\Updatetype_religionRequest;
use App\DataTables\GlobalDataTable;

class ReligionController extends Controller
{
    public function index(GlobalDataTable $dataTable)
    {
        $listOfReligion = Type_religion::getAllReligion();

        return $dataTable->render('religion.index', compact(
            'listOfReligion'
        ));
    }
    
    public function create()
    {
        //
    }
    
    public function store(Storetype_religionRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        Type_religion::create($validated);

        return redirect()->route('admin.religion.index')
                        ->with('success', 'religion added successfully!');
    }
    
    public function show(type_religion $type_religion)
    {
        //
    }
    
    public function edit(type_religion $religion)
    {
        return view('religion.edit', compact(
            'religion',
        ));
    }
    
    public function update(Updatetype_religionRequest $request, type_religion $religion)
    {
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();

        $religion->update($validated);

        return redirect()->route('admin.religion.index')
                        ->with('success', 'religion updated successfully!');
    }
    
    public function destroy(type_religion $religion)
    {
        $deleted = $religion->delete();

        return redirect()->route('admin.religion.index')
                        ->with('success', 'religion deleted successfully!');
    }
}
