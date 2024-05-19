<?php

namespace App\Http\Controllers;

use App\Models\Type_barangay;
use App\Http\Requests\StoreType_barangayRequest;
use App\Http\Requests\UpdateType_barangayRequest;
use App\DataTables\GlobalDataTable;

class BarangayController extends Controller
{
    
    public function index(GlobalDataTable $dataTable)
    {
        $listOfBarangay = Type_barangay::getAllBarangay();

        return $dataTable->render('Barangay.index', compact(
            'listOfBarangay',
        ));
    }
    
    public function create()
    {
        //
    }
    
    public function store(StoreType_barangayRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        Type_Barangay::create($validated);

        return redirect()->route('admin.barangay.index')
                        ->with('success', 'Barangay created successfullly!');
    }
    
    public function show(Type_barangay $type_barangay)
    {
        //
    }
    
    public function edit(Type_barangay $barangay)
    {
        return view('Barangay.edit', compact(
            'barangay'
        ));
    }
    
    public function update(UpdateType_barangayRequest $request, Type_barangay $barangay)
    {
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();
    
        $barangay->update($validated);
    
        return redirect()->route('admin.barangay.index')
                        ->with('success', 'Barangay updated successfully!');
    }
    
    public function destroy(Type_barangay $barangay)
    {
        $deleted = $barangay->delete();

        return redirect()->route('admin.barangay.index')
                        ->with('success', 'Barangay deleted successfully!');
    }
}
