<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_info;
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
        $listOfApplicant = User::getAllUser();
        $applicant = User::where('id', $id)
                            ->whereHas('userInfo')
                            ->whereHas('userAddress')
                            ->get();
        $details = User::findOrFail($id);

        return $dataTable->render('home', compact(
            'details',
            'applicant',
            'totalCountApplicant',
            'listOfApplicant',
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
}
