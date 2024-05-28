<?php

namespace App\Http\Controllers;

use App\Models\user_previous_job;
use App\Models\Type_job;
use App\Models\Type_sub_job;
use App\Models\Type_continent;
use App\Models\Type_country;
use App\Models\Type_contract;
use App\Models\Type_owwa;
use App\Http\Requests\Storeuser_previous_jobRequest;
use App\Http\Requests\Updateuser_previous_jobRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PreviousController extends Controller
{
    public function create()
    {
        $userId = auth()->id();
        $previousJob = User_previous_job::where('user_id', $userId)->first();
    
        $listOfJob = Type_job::getAllJob();
        $listOfContinent = Type_continent::getAllContinent();
        $listOfContract = Type_contract::getAllContract();
        $listOfOwwa = Type_owwa::getAllOwwa();
    
        return view('Form.previous', compact(
            'previousJob',
            'listOfJob',
            'listOfContinent',
            'listOfContract',
            'listOfOwwa',
        ));
    }

    public function getSubJobs($jobId)
    {
        $subJobs = Type_sub_job::getSubJobsByJobId($jobId);
        return response()->json($subJobs);
    }

    public function getCountries($continentId)
    {
        $countries = Type_country::getCountriesByContinentId($continentId);
        return response()->json($countries);
    }
    
    public function store(Storeuser_previous_jobRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        DB::beginTransaction();
        try {
            User_previous_job::create($validated);
    
            DB::commit();
    
            return redirect()->route('admin.previous.create')->with('success', 'Previous job created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
    
            Log::error('Failed to create Previous job', ['error' => $e->getMessage()]);
    
            return redirect()->route('admin.previous.create')->with('error', 'Failed to create Previous job. Please try again.');
        }
    }
    
    public function update(Updateuser_previous_jobRequest $request, $id)
    {
        $previousJob = User_previous_job::findOrFail($id);
        $validated = $request->validated();
    
        DB::beginTransaction();
        try {
            $previousJob->update($validated);
            
            DB::commit();
            return redirect()->route('admin.previous.create')->with('success', 'Previous job updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update Previous job', ['error' => $e->getMessage()]);
            return redirect()->route('admin.previous.create')->with('error', 'Failed to update Previous job. Please try again.');
        }
    }
}
