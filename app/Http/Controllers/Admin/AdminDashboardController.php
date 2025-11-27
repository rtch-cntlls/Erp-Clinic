<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Billing;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalPatients = Patient::count();
        $totalDoctors = Doctor::count();
        $appointmentsToday = Appointment::whereDate('appointment_date', now()->toDateString())->count();
        $revenueThisMonth = Billing::whereMonth('created_at', now()->month)
                                   ->whereYear('created_at', now()->year)
                                   ->sum('amount');

        $monthlyVisitsRaw = Appointment::selectRaw('MONTH(appointment_date) as month, COUNT(*) as count')
                                       ->whereYear('appointment_date', now()->year)
                                       ->groupBy('month')
                                       ->pluck('count', 'month')
                                       ->toArray();

        $monthlyVisits = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyVisits[$m] = $monthlyVisitsRaw[$m] ?? 0;
        }

        $monthlyRevenueRaw = Billing::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
                                    ->whereYear('created_at', now()->year)
                                    ->groupBy('month')
                                    ->pluck('total', 'month')
                                    ->toArray();

        $monthlyRevenue = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyRevenue[$m] = $monthlyRevenueRaw[$m] ?? 0;
        }

        $upcomingAppointments = Appointment::with('patient')
                                    ->whereDate('appointment_date', '>=', now()->toDateString())
                                    ->orderBy('appointment_date')
                                    ->take(5)
                                    ->get();

        $newPatients = Patient::whereMonth('created_at', now()->month)
                              ->orderBy('created_at', 'desc')
                              ->take(5)
                              ->get();

        return view('admin.pages.dashboard.index', compact(
            'totalPatients', 'totalDoctors', 'appointmentsToday', 'revenueThisMonth',
            'monthlyVisits', 'monthlyRevenue', 'upcomingAppointments', 'newPatients'
        ));
    }
}
