<?php

namespace App\Http\Controllers;

use App\Models\type_job;
use App\Http\Requests\Storetype_jobRequest;
use App\Http\Requests\Updatetype_jobRequest;
use App\DataTables\GlobalDataTable;

class JobController extends Controller
{
    public function index(GlobalDataTable $dataTable)
    {
        $listOfJob = Type_Job::getAllJob();

        return $dataTable->render('Job.index', compact(
            'listOfJob'
        ));
    }
    
    public function create()
    {
        //
    }
    
    public function store(Storetype_jobRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        Type_job::create($validated);

        return redirect()->route('admin.job.index')
                        ->with('success', 'Job added successfully!');
    }
    
    public function show(type_job $type_job)
    {
        //
    }
    
    public function edit(type_job $job)
    {
        return view('Job.edit', compact(
            'job',
        ));
    }
    
    public function update(Updatetype_jobRequest $request, type_job $job)
    {
        $validated = $request->validated();
        $validated['updated_by'] = auth()->id();

        $job->update($validated);

        return redirect()->route('admin.job.index')
                        ->with('success', 'Job updated successfully!');
    }
    
    public function destroy(type_job $job)
    {
        $deleted = $job->delete();

        return redirect()->route('admin.job.index')
                        ->with('success', 'Job deleted successfully!');
    }
}
