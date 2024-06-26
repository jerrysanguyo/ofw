<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\GlobalDataTable;
use App\Models\User;
use App\Models\User_info;
use App\Models\User_address;
use App\Models\User_previous_job;
use App\Models\User_household_composition;
use App\Models\User_need;
use App\Models\Type_barangay;
use App\Models\Type_city;
use App\Models\Type_residence;
use App\Models\Type_gender;
use App\Models\Type_id;
use App\Models\Type_educational_attainment;
use App\Models\Type_religion;
use App\Models\type_civil_status;
use App\Models\Type_job;
use App\Models\Type_sub_job;
use App\Models\Type_continent;
use App\Models\Type_country;
use App\Models\Type_contract;
use App\Models\Type_owwa;
use App\Models\Type_relation;
use App\Http\Requests\UpdateUser_infoRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\Updateuser_previous_jobRequest;
use App\Http\Requests\UpdateUser_household_compositionRequest;
use App\Http\Requests\UpdateUser_needRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApplicantController extends Controller
{
    public function index(GlobalDataTable $dataTable)
    {
        $listOfApplicant = User::where('role', 'admin')
                                ->whereHas('userInfo')
                                ->whereHas('userAddress')
                                ->get();
                               
        return $dataTable->render('Applicant.index', compact('listOfApplicant'));
    }

    public function show(string $id)
    {
        $details = User::findOrFail($id);
        return view('Applicant.details', compact(
            'details'
        ));
    }

    public function edit(User $applicant)
    {
        $listOfBarangay = Type_barangay::getAllBarangay();
        $listOfCity = Type_city::getAllCities();
        $listOfResidence = Type_residence::getAllResidence();
        $listOfGender = Type_gender::getAllGender();
        $listOfId = Type_id::getAllId();
        $listOfEducation = Type_educational_attainment::getAllEducation();
        $listOfCivil = Type_civil_status::getAllCivil();
        $listOfReligion = Type_religion::getAllReligion();
        $listOfJob = Type_job::getAllJob();
        $listOfContinent = Type_continent::getAllContinent();
        $listOfContract = Type_contract::getAllContract();
        $listOfOwwa = Type_owwa::getAllOwwa();
        $listOfRelation = Type_relation::getAllRelation();
        $household = User_household_composition::where('user_id', $applicant->id)->get();
        $listOfNeeds = User_need::where('user_id', $applicant->id)->get();

        $details = $applicant->load(['userAddress', 'userInfo', 'userPrevious', 'userHousehold', 'userNeeds']);
        $userPrevious = $details->userPrevious;

        return view('Applicant.Edit', compact(
            'details',
            'listOfBarangay',
            'listOfCity',
            'listOfResidence',
            'listOfGender',
            'listOfId',
            'listOfEducation',
            'listOfCivil',
            'listOfReligion',
            'listOfJob',
            'listOfContinent',
            'listOfContract',
            'listOfOwwa',
            'userPrevious',
            'household',
            'listOfRelation',
            'listOfNeeds',
        ));
    }
    
    public function update(UpdateUserRequest $userRequest, UpdateUser_infoRequest $infoRequest, Updateuser_previous_jobRequest $previousRequest, User $applicant)
    {
        $userValidated = $userRequest->validated();
        $infoValidated = $infoRequest->validated();
        $previousValidated = $previousRequest->validated();
        $infoValidated['user_id'] = $applicant->id;
        $previousValidated['user_id'] = $applicant->id;

        DB::beginTransaction();
        try {
            // Find user address and user info records
            $userAddress = User_address::where('user_id', $applicant->id)->first();
            $userInfo = User_info::where('user_id', $applicant->id)->first();
            $userPrevious = User_previous_job::where('user_id', $applicant->id)->first();

            // Update records
            $applicant->update($userValidated);
            $userInfo->update($infoValidated);
            $userAddress->update($infoValidated);
            $userPrevious->update($previousValidated);

            DB::commit();
            return redirect()->route('admin.applicant.edit', $applicant->id)->with('success', 'Applicant details updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update user information', ['error' => $e->getMessage()]);
            return redirect()->route('admin.applicant.edit', $applicant->id)->with('error', 'Failed to update applicant details.');
        }
    }
    
    public function houseUpdate(UpdateUser_household_compositionRequest $request, User_household_composition $household)
    {
        $validated = $request->validated();
        DB::beginTransaction();
        try {
            $household->update($validated);
            DB::commit();
    
            return redirect()->route('admin.applicant.edit', $household->user_id)
                ->with('success', 'Household composition updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update household composition', [
                'error' => $e->getMessage(),
                'id' => $household->id,
                'data' => $validated,
            ]);
    
            return redirect()->route('admin.applicant.edit', $household->user_id)
                ->with('error', 'Failed to update household composition.');
        }
    }

    public function needUpdate(UpdateUser_needRequest $request, User_need $need)
    {  
        $validated = $request->validated();
        DB::beginTransaction();
        try{
            $need->update($validated);
            DB::commit();

            return redirect()->route('admin.applicant.edit', $need->user_id)
                ->with('success', 'Need updated successfully.');
        } catch (\Exemption $e) {
            DB::rollBack();
            Log::error('Failed to update needs.', [
                'error' => $e->getMessage(),
                'id' => $need->id,
                'data' => $validated,
            ]);

            return redirect()->route('admin.applicant.edit', $need->user_id)
                ->with('error', 'Failed to update needs.');
        }
    }

    public function destroy(string $id)
    {
        //
    }
}
