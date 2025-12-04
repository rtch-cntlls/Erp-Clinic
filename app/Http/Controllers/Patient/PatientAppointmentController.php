<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;

class PatientAppointmentController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $appointments = Appointment::where(function($query) use ($userId) {
            $query->where('patient_id', Auth::user()->patient?->id ?? 0)
                  ->orWhere('user_id', $userId);
        })->latest()->get();

        return view('patient.pages.appointment.index', compact('appointments'));
    }

    public function cancel(Appointment $appointment)
    {
        $patientId = Auth::user()->patient?->id;

        if ($appointment->patient_id !== $patientId && $appointment->user_id !== Auth::id()) {
            abort(403);
        }

        $appointment->update(['status' => 'cancelled']);

        return back()->with('success', 'Appointment cancelled successfully.');
    }
}
