<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $id = Auth()->id();
        $applicant = User::where('id', $id)
                            ->whereHas('userInfo')
                            ->whereHas('userAddress')
                            ->get();
        $details = User::findOrFail($id);
        return view('home', compact(
            'details',
            'applicant',
        ));
    }
}
