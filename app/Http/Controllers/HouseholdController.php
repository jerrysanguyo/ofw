<?php

namespace App\Http\Controllers;

use App\Models\User_household_composition;
use App\Models\Type_relation;
use App\Http\Requests\StoreUser_household_compositionRequest;
use App\Http\Requests\UpdateUser_household_compositionRequest;

class HouseholdController extends Controller
{
    
    public function index()
    {
        //
    }
    
    public function create()
    {
        $listOfRelation = Type_relation::getAllRelation();
        return view('Form.household', compact(
            'listOfRelation',
        ));
    }
    
    public function store(StoreUser_household_compositionRequest $request)
    {
        $validated = $request->validated();
    
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
    
        return redirect()->route('admin.household.index')
                        ->with('success', 'Household composition added successfully.');
    }
    
    public function show(User_household_composition $user_household_composition)
    {
        //
    }
    
    public function edit(User_household_composition $user_household_composition)
    {
        //
    }
    
    public function update(UpdateUser_household_compositionRequest $request, User_household_composition $user_household_composition)
    {
        //
    }
    
    public function destroy(User_household_composition $user_household_composition)
    {
        //
    }
}
