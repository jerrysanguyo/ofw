<?php

namespace App\Http\Controllers;

use App\Models\type_relation;
use App\Http\Requests\Storetype_relationRequest;
use App\Http\Requests\Updatetype_relationRequest;
use App\DataTables\GlobalDataTable;

class RelationController extends Controller
{
    public function index(GlobalDataTable $dataTable)
    {
        $listOfRelation = Type_relation::getAllRelation();

        return $dataTable->render('relation.index', compact(
            'listOfRelation'
        ));
    }
    
    public function create()
    {
        //
    }
    
    public function store(Storetype_relationRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        Type_relation::create($validated);

        return redirect()->route('admin.relation.index')
                        ->with('success', 'relation added successfully!');
    }
    
    public function show(type_relation $type_relation)
    {
        //
    }
    
    public function edit(type_relation $relation)
    {
        return view('relation.edit', compact(
            'relation',
        ));
    }
    
    public function update(Updatetype_relationRequest $request, type_relation $relation)
    {
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();

        $relation->update($validated);

        return redirect()->route('admin.relation.index')
                        ->with('success', 'relation updated successfully!');
    }
    
    public function destroy(type_relation $relation)
    {
        $deleted = $relation->delete();

        return redirect()->route('admin.relation.index')
                        ->with('success', 'relation deleted successfully!');
    }
}
