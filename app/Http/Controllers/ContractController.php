<?php

namespace App\Http\Controllers;

use App\Models\Type_contract;
use App\Http\Requests\StoreType_contractRequest;
use App\Http\Requests\UpdateType_contractRequest;
use App\DataTables\GlobalDataTable;

class ContractController extends Controller
{
    public function index(GlobalDataTable $dataTable)
    {
        $listOfContract = Type_contract::getAllContract();

        return $dataTable->render('contract.index', compact(
            'listOfContract'
        ));
    }
    
    public function create()
    {
        //
    }
    
    public function store(StoreType_contractRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        Type_contract::create($validated);

        return redirect()->route('admin.contract.index')
                        ->with('success', 'contract added successfully!');
    }
    
    public function show(Type_contract $type_contract)
    {
        //
    }
    
    public function edit(Type_contract $contract)
    {
        return view('contract.edit', compact(
            'contract',
        ));
    }
    
    public function update(UpdateType_contractRequest $request, Type_contract $contract)
    {
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();

        $contract->update($validated);

        return redirect()->route('admin.contract.index')
                        ->with('success', 'contract updated successfully!');
    }
    
    public function destroy(Type_contract $contract)
    {
        $deleted = $contract->delete();

        return redirect()->route('admin.contract.index')
                        ->with('success', 'contract deleted successfully!');
    }
}
