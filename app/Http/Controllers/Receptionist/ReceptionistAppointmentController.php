<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;

class ReceptionistAppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['patient', 'user', 'doctor'])
            ->whereDate('appointment_date', now()->toDateString())
            ->orderBy('appointment_date')
            ->get();

        $queue = $appointments->values()->map(function($appt, $index) {
            $appt->queue_number = $index + 1;
            return $appt;
        });

        return view('receptionist.pages.appointment.index', [
            'appointments' => $appointments,
            'queue' => $queue
        ]);
    }

    public function approve(Request $request, Appointment $appointment)
    {
        if ($appointment->status !== 'Pending') {
            return back()->with('error', 'Only pending appointments can be approved.');
        }

        if (!$appointment->patient_id && $appointment->user_id) {
            $user = $appointment->user;
            $patient = Patient::create([
                'user_id' => $user->id,
                'name'    => $user->name,
                'email'   => $user->email,
            ]);

            $appointment->patient_id = $patient->id;
        }

        $appointment->status = 'Scheduled';

        if ($request->check_in_time) {
            $appointment->check_in_time = $request->check_in_time;
        }

        $appointment->save();

        return back()->with('success', 'Appointment approved successfully.');
    }
}
