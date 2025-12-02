<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Doctor;

class ReceptionistDashboardController extends Controller
{
    public function index()
    {
        $cards = [
            [
                'title' => 'Total Patients',
                'value' => Patient::count(),
                'icon'  => 'bi-people-fill',
                'color' => 'text-primary',
            ],
            [
                'title' => 'Today\'s Appointments',
                'value' => Appointment::whereDate('appointment_date', today())->count(),
                'icon'  => 'bi-calendar-check',
                'color' => 'text-success',
            ],
            [
                'title' => 'Pending Appointments',
                'value' => Appointment::where('status', 'pending')->count(),
                'icon'  => 'bi-hourglass-split',
                'color' => 'text-warning',
            ],
            [
                'title' => 'Total Doctors',
                'value' => Doctor::count(),
                'icon'  => 'bi-person-badge',
                'color' => 'text-danger',
            ],
        ];

        return view('receptionist.pages.dashboard.index', compact('cards'));
    }
}
