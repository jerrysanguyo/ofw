<?php

namespace App\Http\Controllers;

use App\Models\User_info;
use App\Models\User_address;
use App\Models\Type_barangay;
use App\Models\Type_city;
use App\Models\Type_residence;
use App\Models\Type_id;
use App\Models\Type_gender;
use App\Models\Type_educational_attainment;
use App\Models\Type_religion;
use App\Models\Type_civil_status;
use App\Http\Requests\StoreUser_infoRequest;
use App\Http\Requests\UpdateUser_infoRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PersonalController extends Controller
{
    public function create()
    {
        $userId = auth()->id();
        $userAddress = User_address::where('user_id', $userId)->first();
        $userInfo = User_info::where('user_id', $userId)->first();
        $listOfBarangay = Type_barangay::getAllBarangay();
        $listOfCity = Type_city::getAllCities();
        $listOfResidence = Type_residence::getAllResidence();
        $listOfId = Type_id::getAllId();
        $listOfGender = Type_gender::getAllGender();
        $listOfEducation = Type_educational_attainment::getAllEducation();
        $listOfReligion = Type_religion::getAllReligion();
        $listOfCivil = Type_civil_status::getAllCivil();
        return view('Form.personal', compact(
            'listOfBarangay',
            'listOfCity',
            'listOfResidence',
            'listOfId',
            'listOfGender',
            'listOfEducation',
            'listOfReligion',
            'listOfCivil',
            'userAddress', 
            'userInfo',
        ));
    }
    
    public function store(StoreUser_infoRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            User_address::create([
                'user_id' => auth()->id(),
                'house_number' => $validated['house_number'],
                'barangay_id' => $validated['barangay_id'],
                'street' => $validated['street'],
                'city_id' => $validated['city_id'],
                'residence_years' => $validated['residence_years'],
                'residence_id' => $validated['residence_id'],
            ]);

            User_info::create([
                'user_id' => auth()->id(),
                'birthdate' => $validated['birthdate'],
                'age' => $validated['age'],
                'gender_id' => $validated['gender_id'],
                'birthplace' => $validated['birthplace'],
                'religion_id' => $validated['religion_id'],
                'civil_id' => $validated['civil_id'],
                'present_job' => $validated['present_job'],
                'education_id' => $validated['education_id'],
                'voters' => $validated['voters'],
            ]);

            DB::commit();

            return redirect()->route('admin.personal.create')
                            ->with('success', 'User information has been stored successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Failed to store user information', ['error' => $e->getMessage()]);

            return redirect()->route('admin.personal.create')
                            ->with('error', 'Failed to store user information. Please try again.');
        }
    }

    public function update(UpdateUser_infoRequest $request, User_info $user_info)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            $userAddress = User_address::where('user_id', auth()->id())->firstOrFail();
            $userInfo = User_info::where('user_id', auth()->id())->firstOrFail();

            $userAddress->update([
                'house_number' => $validated['house_number'],
                'barangay_id' => $validated['barangay_id'],
                'street' => $validated['street'],
                'city_id' => $validated['city_id'],
                'residence_years' => $validated['residence_years'],
                'residence_id' => $validated['residence_id'],
            ]);

            $userInfo->update([
                'birthdate' => $validated['birthdate'],
                'age' => $validated['age'],
                'gender_id' => $validated['gender_id'],
                'birthplace' => $validated['birthplace'],
                'religion_id' => $validated['religion_id'],
                'civil_id' => $validated['civil_id'],
                'present_job' => $validated['present_job'],
                'education_id' => $validated['education_id'],
                'voters' => $validated['voters'],
            ]);

            DB::commit();

            return redirect()->route('admin.personal.create')->with('success', 'User information has been updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Failed to update user information', ['error' => $e->getMessage()]);

            return redirect()->route('admin.personal.create')->with('error', 'Failed to update user information. Please try again.');
        }
    }
}
