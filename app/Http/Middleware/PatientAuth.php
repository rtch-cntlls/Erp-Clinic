<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientAuth
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->route('patient.login.form')->with('error', 'Please login to continue');
        }

        return $next($request);
    }
}
