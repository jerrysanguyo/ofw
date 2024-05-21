<?php

namespace App\Http\Controllers;

use App\Models\Type_gender;
use App\Http\Requests\StoreType_genderRequest;
use App\Http\Requests\UpdateType_genderRequest;
use App\DataTables\GlobalDataTable;

class GenderController extends Controller
{
    public function index(GlobalDataTable $dataTable)
    {
        $listOfGender = Type_gender::getAllGender();

        return $dataTable->render('Gender.index', compact(
            'listOfGender'
        ));
    }
    
    public function create()
    {
        //
    }
    
    public function store(StoreType_genderRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        Type_gender::create($validated);

        return redirect()->route('admin.gender.index')
                        ->with('success', 'gender added successfully!');
    }
    
    public function show(Type_gender $type_gender)
    {
        //
    }
    
    public function edit(Type_gender $gender)
    {
        return view('gender.edit', compact(
            'gender',
        ));
    }
    
    public function update(UpdateType_genderRequest $request, Type_gender $gender)
    {
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();

        $gender->update($validated);

        return redirect()->route('admin.gender.index')
                        ->with('success', 'gender updated successfully!');
    }
    
    public function destroy(Type_gender $gender)
    {
        $deleted = $gender->delete();

        return redirect()->route('admin.gender.index')
                        ->with('success', 'gender deleted successfully!');
    }
}
