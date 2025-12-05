<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashierAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('cashier')->check()) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
