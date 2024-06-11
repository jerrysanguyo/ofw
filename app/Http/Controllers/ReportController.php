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
    
        $result = [];
    
        if ($startAge && $endAge) {
            for ($age = $startAge; $age <= $endAge; $age++) {
                $count = User_household_composition::where('age', $age)->count();
                if ($count > 0) {
                    $result[$age] = $count;
                }
            }
        }
    
        return response()->json(['counts' => $result]);
    }    
}
