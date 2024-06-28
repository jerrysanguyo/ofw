<?php

namespace App\Http\Controllers;

use App\Models\Type_need;
use App\Http\Requests\StoreType_needRequest;
use App\Http\Requests\UpdateType_needRequest;
use Illuminate\Http\Request;
use App\DataTables\GlobalDataTable;

class TypeNeedController extends Controller
{
    public function index(GlobalDataTable $dataTable)
    {
        $listOfNeed = Type_need::getAllNeed();
        return $dataTable->render('Need.index', compact(
            'listOfNeed',
        ));
        return view('Need.index');
    }
    
    public function store(StoreType_needRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        Type_need::create($validated);

        return redirect()->route('admin.need.index')
                ->with('success', 'Need created successfully.');
    }
    
    public function edit(Type_need $need)
    {
        return view('Need.edit', compact('need'));
    }
    
    public function update(UpdateType_needRequest $request, Type_need $need)
    {
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();

        $need->update($validated);

        return redirect()->route('admin.need.index')
                ->with('success', 'Need updated successfully.');
    }
    
    public function destroy(Type_need $need)
    {
        $deleted = $need->delete();

        return redirect()->route('admin.need.index')
                ->with('success', 'Need deleted successfully.');
    }
}
