<?php

namespace App\Http\Controllers;

use App\Models\type_owwa;
use App\Http\Requests\Storetype_owwaRequest;
use App\Http\Requests\Updatetype_owwaRequest;
use App\DataTables\GlobalDataTable;

class OwwaController extends Controller
{
    public function index(GlobalDataTable $dataTable)
    {
        $listOfOwwa = Type_Owwa::getAllOwwa();

        return $dataTable->render('Owwa.index', compact(
            'listOfOwwa'
        ));
    }
    
    public function create()
    {
        //
    }
    
    public function store(Storetype_owwaRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        Type_Owwa::create($validated);

        return redirect()->route('admin.owwa.index')
                        ->with('success', 'Owwa added successfully!');
    }
    
    public function show(type_owwa $type_owwa)
    {
        //
    }
    
    public function edit(type_owwa $owwa)
    {
        return view('Owwa.edit', compact(
            'owwa',
        ));
    }
    
    public function update(Updatetype_owwaRequest $request, type_owwa $owwa)
    {
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();

        $owwa->update($validated);

        return redirect()->route('admin.owwa.index')
                        ->with('success', 'Owwa updated successfully!');
    }
    
    public function destroy(type_owwa $owwa)
    {
        $deleted = $owwa->delete();

        return redirect()->route('admin.owwa.index')
                        ->with('success', 'Owwa deleted successfully!');
    }
}
