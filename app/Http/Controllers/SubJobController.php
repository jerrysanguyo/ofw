<?php

namespace App\Http\Controllers;

use App\Models\Type_sub_job;
use App\Models\Type_job;
use App\Http\Requests\StoreType_sub_jobRequest;
use App\Http\Requests\UpdateType_sub_jobRequest;
use App\DataTables\GlobalDataTable;

class SubJobController extends Controller
{
    public function index(GlobalDataTable $dataTable)
    {
        $listOfSubJob = Type_sub_job::getAllSubJob();
        $listOfJob = Type_job::getAllJob();
        return $dataTable->render('Sub_job.index', compact(
            'listOfSubJob',
            'listOfJob',
        ));
    }
    
    public function create()
    {
        //
    }
    
    public function store(StoreType_sub_jobRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        Type_sub_job::create($validated);

        return redirect()->route('admin.subjob.index')
                        ->with('success', 'Sub job added successfully!');
    }
    
    public function show(Type_sub_job $type_sub_job)
    {
        //
    }
    
    public function edit(Type_sub_job $subjob)
    {
        $listOfSubjob = Type_sub_job::getAllSubJob();
        $listOfJob = Type_job::getAllJob();
        return view('Sub_job.edit', compact(
            'subjob',
            'listOfSubjob',
            'listOfJob',
        ));
    }
    
    public function update(UpdateType_sub_jobRequest $request, Type_sub_job $subjob)
    {
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();

        $subjob->update($validated);

        return redirect()->route('admin.subjob.index')
                        ->with('success', 'Sub job updated successfully!');
    }
    
    public function destroy(Type_sub_job $subjob)
    {
        $deleted = $subjob->delete();

        return redirect()->route('admin.subjob.index')
                        ->with('success', 'Sub job deleted successfully!');
    }
}
