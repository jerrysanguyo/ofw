<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Super_admin_role
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === "superadmin") {
            return $next($request);
        }

        return redirect()->route('unauthorized');
    }
}
