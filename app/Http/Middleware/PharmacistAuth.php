<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PharmacistAuth
{

    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('pharmacist')->check()) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
