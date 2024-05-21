<?php

namespace App\Http\Controllers;

use App\Models\Type_id;
use App\Http\Requests\StoreType_idRequest;
use App\Http\Requests\UpdateType_idRequest;
use App\DataTables\GlobalDataTable;

class IdController extends Controller
{
    public function index(GlobalDataTable $dataTable)
    {
        $listOfId = Type_Id::getAllId();

        return $dataTable->render('Id.index', compact(
            'listOfId'
        ));
    }
    
    public function create()
    {
        //
    }
    
    public function store(StoreType_idRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        Type_Id::create($validated);

        return redirect()->route('admin.identification.index')
                        ->with('success', 'Id added successfully!');
    }
    
    public function show(Type_id $type_id)
    {
        //
    }
    
    public function edit(Type_id $identification)
    {
        return view('Id.edit', compact(
            'identification',
        ));
    }
    
    public function update(UpdateType_idRequest $request, Type_id $identification)
    {
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();

        $identification->update($validated);

        return redirect()->route('admin.identification.index')
                        ->with('success', 'Id updated successfully!');
    }
    
    public function destroy(Type_id $identification)
    {
        $deleted = $identification->delete();

        return redirect()->route('admin.identification.index')
                        ->with('success', 'Id deleted successfully!');
    }
}
