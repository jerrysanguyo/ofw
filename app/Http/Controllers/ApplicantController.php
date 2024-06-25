<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\GlobalDataTable;
use App\Models\User;
use App\Models\Type_barangay;
use App\Models\Type_city;
use App\Models\Type_residence;
use App\Models\Type_gender;
use App\Models\Type_id;
use App\Models\Type_educational_attainment;
use App\Models\Type_religion;
use App\Models\type_civil_status;

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
        $listOfCivil = type_civil_status::getAllCivil();
        $listOfReligion = Type_religion::getAllReligion();
        $details = $applicant->load(['userAddress', 'userAddress.barangay', 'userAddress.city', 'userAddress.residence', 'userInfo', 'userPrevious', 'userHousehold', 'userNeeds']);
    
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
