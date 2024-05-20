<?php

namespace App\Http\Controllers;

use App\Models\Type_civil_status;
use App\Http\Requests\StoreType_civil_statusRequest;
use App\Http\Requests\UpdateType_civil_statusRequest;
use App\DataTables\GlobalDataTable;

class CivilStatusController extends Controller
{
    public function index(GlobalDataTable $dataTable)
    {
        $listOfCivil = Type_civil_status::getAllCivil();

        return $dataTable->render('Civil.index', compact(
            'listOfCivil',
        ));
    }
    
    public function create()
    {
        //
    }
    
    public function store(StoreType_civil_statusRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        Type_civil_status::create($validated);

        return redirect()->route('admin.civil.index')
                        ->with('success', 'Civil added successfully!');
    }
    
    public function show(Type_civil_status $type_civil_status)
    {
        //
    }
    
    public function edit(Type_civil_status $civil)
    {
        return view('civil.edit', compact(
            'civil',
        ));
    }
    
    public function update(UpdateType_civil_statusRequest $request, Type_civil_status $civil)
    {
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();

        $civil->update($validated);

        return redirect()->route('admin.civil.index')
        ->with('success', 'Civil updated successfully!');
    }
    
    public function destroy(Type_civil_status $civil)
    {
        $deleted = $civil->delete();

        return redirect()->route('admin.civil.index')
                        ->with('success', 'Civil deleted successfully!');
    }
}
