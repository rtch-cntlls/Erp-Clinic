<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class PatientLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('patient.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials, $request->has('remember'))) {
            return redirect()->intended('/');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('patient.login.form')
                        ->with('success', 'Registration successful! Please login.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('patient.landing');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::firstOrCreate(
            ['provider_id' => $googleUser->id],
            [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'provider_name' => 'google',
                'password' => null,
            ]
        );

        Auth::login($user);

        return redirect('/');
    }
}
