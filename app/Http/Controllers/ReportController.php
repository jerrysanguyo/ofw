<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User_household_composition;

class ReportController extends Controller
{
    public function index()
    {
        return view('Report.index');
    }

    public function getAgeCount(Request $request)
    {
        $startAge = $request->input('startAge');
        $endAge = $request->input('endAge');

        $query = User_household_composition::query();

        if ($startAge && $endAge) {
            $query->whereBetween('age', [$startAge, $endAge]);
        }

        $count = $query->count();

        return response()->json(['count' => $count]);
    }
}
