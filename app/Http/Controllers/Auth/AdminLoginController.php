<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Doctor;
use App\Models\Pharmacist;
use App\Models\Receptionist;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login'); // shared login form
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return redirect()->route('admin.pages.dashboard.index');
        }

        $doctor = Doctor::where('email', $request->email)
                        ->where('phone', $request->password)
                        ->first();

        if ($doctor) {
            Auth::guard('doctor')->login($doctor);
            return redirect()->route('doctor.dashboard.index');
        }

        $pharmacist = Pharmacist::where('email', $request->email)->first();

        if ($pharmacist && Hash::check($request->password, $pharmacist->password)) {
            Auth::guard('pharmacist')->login($pharmacist);
            return redirect()->route('pharmacist.dashboard.index');
        }        

        $receptionist = Receptionist::where('email', $request->email)->first();

        if ($receptionist && Hash::check($request->password, $receptionist->password)) {
            Auth::guard('receptionist')->login($receptionist);
            return redirect()->route('receptionist.dashboard.index');
        }
        
        return back()->withErrors([
            'email' => 'Invalid credentials.'
        ]);
    }

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } else {
            Auth::logout();
        }

        return redirect()->route('admin.login');
    }
}
