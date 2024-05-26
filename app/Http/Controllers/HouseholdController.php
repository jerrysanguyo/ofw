<?php

namespace App\Http\Controllers;

use App\Models\User_household_composition;
use App\Models\Type_relation;
use App\Http\Requests\StoreUser_household_compositionRequest;
use App\Http\Requests\UpdateUser_household_compositionRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HouseholdController extends Controller
{
    public function create()
    {
        $listOfRelation = Type_relation::getAllRelation();
        $household = User_household_composition::where('user_id', auth()->id())->get();

        return view('Form.household', compact('listOfRelation', 'household'));
    }

    public function store(StoreUser_household_compositionRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            foreach ($validated['full_name'] as $index => $fullName) {
                User_household_composition::create([
                    'user_id' => auth()->id(),
                    'full_name' => $fullName,
                    'relation_id' => $validated['relation_id'][$index],
                    'birthdate' => $validated['birthdate'][$index],
                    'age' => $validated['age'][$index],
                    'work' => $validated['work'][$index],
                    'monthly_income' => $validated['monthly_income'][$index],
                    'voters' => $validated['voters'][$index],
                    'created_by' => auth()->id(),
                    'updated_by' => auth()->id(),
                ]);
            }

            DB::commit();

            return redirect()->route('admin.household.create')->with('success', 'Household composition added successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Failed to store household composition', ['error' => $e->getMessage()]);

            return redirect()->route('admin.household.create')->with('error', 'Failed to add household composition. Please try again.');
        }
    }

    public function update(UpdateUser_household_compositionRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            foreach ($validated['id'] as $index => $id) {
                $household = User_household_composition::findOrFail($id);
                $household->update([
                    'full_name' => $validated['full_name'][$index],
                    'relation_id' => $validated['relation_id'][$index],
                    'birthdate' => $validated['birthdate'][$index],
                    'age' => $validated['age'][$index],
                    'work' => $validated['work'][$index],
                    'monthly_income' => $validated['monthly_income'][$index],
                    'voters' => $validated['voters'][$index],
                    'updated_by' => auth()->id(),
                ]);
            }

            DB::commit();

            return redirect()->route('admin.household.create')->with('success', 'Household composition updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Failed to update household composition', ['error' => $e->getMessage()]);

            return redirect()->route('admin.household.create')->with('error', 'Failed to update household composition. Please try again.');
        }
    }
}