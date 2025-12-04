<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('patient.pages.landing.index', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id'        => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'reason'           => 'nullable|string|max:255',
        ]);

        Appointment::create([
            'user_id'          => Auth::id(),
            'patient_id'       => null,
            'doctor_id'        => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'type'             => 'online',
            'status'           => 'Pending',
            'reason'           => $request->reason,
        ]);

        return back()->with('success', 'Your appointment request has been submitted! Please wait for receptionist approval.');
    }
}
