<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_info;
use App\Models\User_previous_job;
use App\Models\type_continent;
use App\Models\type_country;
use App\DataTables\GlobalDataTable;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(GlobalDataTable $dataTable)
    {
        $id = Auth()->id();
        $totalCountApplicant = User_info::count();
        $totalCountCountry = User_previous_job::count();
        $listOfApplicant = User::getAllUser();
        $listOfContinent = type_continent::getAllContinent();
        $listOfCountry = type_country::getAllCountry();
        $applicant = User::where('id', $id)
                            ->whereHas('userInfo')
                            ->whereHas('userAddress')
                            ->get();
        $details = User::findOrFail($id);

        return $dataTable->render('home', compact(
            'details',
            'applicant',
            'totalCountApplicant',
            'totalCountCountry',
            'listOfApplicant',
            'listOfContinent',
            'listOfCountry',
        ));
    }

    public function getApplicantCount (Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $query = User_info::query();

        if ($startDate && $endDate) 
        {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $count = $query->count();

        return response()->json([
            'count' => $count
        ]);
    }

    public function getOFWCount(Request $request)
    {
        $countryId = $request->input('country');

        if (!$countryId) {
            return response()->json(['error' => 'Country ID is required'], 400);
        }

        try {
            $count = User_previous_job::where('country_id', $countryId)->count();

            return response()->json(['count' => $count]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching the count'], 500);
        }
    }
}
