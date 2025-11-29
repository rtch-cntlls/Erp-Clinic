<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Carbon\Carbon;

class DoctorDashboardController extends Controller
{
    public function index()
    {
        $doctor = auth()->guard('doctor')->user();
        $today = Carbon::today();

        $todaysAppointments = Appointment::where('doctor_id', $doctor->id)
            ->whereDate('appointment_date', $today)
            ->count();

        $todaysPatients = Appointment::where('doctor_id', $doctor->id)
            ->whereDate('appointment_date', $today)
            ->distinct('patient_id')
            ->count('patient_id');

        $cards = [
            [
                'title' => "Today's Appointments",
                'count' => $todaysAppointments,
                'icon' => 'bi-calendar-event-fill',
                'color' => 'danger'
            ],
            [
                'title' => "Today's Patients",
                'count' => $todaysPatients,
                'icon' => 'bi-people-fill',
                'color' => 'primary'
            ]
        ];

        $appointments = Appointment::with('patient')
            ->where('doctor_id', $doctor->id)
            ->whereDate('appointment_date', $today)
            ->orderBy('appointment_date', 'asc')
            ->paginate(10);

        return view('doctor.pages.dashboard.index', compact(
            'doctor',
            'cards',
            'appointments'
        ));
    }
}
