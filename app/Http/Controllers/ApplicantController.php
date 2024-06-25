<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\GlobalDataTable;
use App\Models\User;
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

        $details = $applicant->load(['userAddress', 'userAddress.barangay', 'userAddress.city', 'userAddress.residence', 'userInfo', 'userPrevious', 'userHousehold', 'userNeeds']);
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
    
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
