<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\GlobalDataTable;
use App\Models\User;

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
        //
    }
    
    public function destroy(string $id)
    {
        //
    }
}
