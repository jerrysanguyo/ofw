<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    
    protected function redirectTo()
    {
        if (auth()->user()->role == 'admin') {
            return '/admin/home';
        } else if (auth()->user()->role == 'user') {
            return '/user/home';
        } else if (auth()->user()->role == 'judge') {
            return '/superadmin/home';
        }
    }
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
