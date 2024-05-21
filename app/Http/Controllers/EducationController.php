<?php

namespace App\Http\Controllers;

use App\Models\Type_educational_attainment;
use App\Http\Requests\StoreType_educational_attainmentRequest;
use App\Http\Requests\UpdateType_educational_attainmentRequest;
use App\DataTables\GlobalDataTable;

class EducationController extends Controller
{
    public function index(GlobalDataTable $dataTable)
    {
        $listOfEducation = Type_educational_attainment::getAllEducation();

        return $dataTable->render('education.index', compact(
            'listOfEducation'
        ));
    }
    
    public function create()
    {
        //
    }
    
    public function store(StoreType_educational_attainmentRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        Type_educational_attainment::create($validated);

        return redirect()->route('admin.education.index')
                        ->with('success', 'education added successfully!');
    }
    
    public function show(Type_educational_attainment $type_educational_attainment)
    {
        //
    }
    
    public function edit(Type_educational_attainment $education)
    {
        return view('education.edit', compact(
            'education',
        ));
    }
    
    public function update(UpdateType_educational_attainmentRequest $request, Type_educational_attainment $education)
    {
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();

        $education->update($validated);

        return redirect()->route('admin.education.index')
                        ->with('success', 'education updated successfully!');
    }
    
    public function destroy(Type_educational_attainment $education)
    {
        $deleted = $education->delete();

        return redirect()->route('admin.education.index')
                        ->with('success', 'education deleted successfully!');
    }
}
