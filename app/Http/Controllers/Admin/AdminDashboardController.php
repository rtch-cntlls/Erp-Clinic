<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Receptionist;
use App\Models\Pharmacist;
use App\Models\PatientVisit;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalPatients = Patient::count();
        $totalDoctors = Doctor::count();
        $totalReceptionists = Receptionist::count();
        $totalPharmacists = Pharmacist::count();

        $cards = [
            [
                'icon' => 'bi-person', 
                'title' => 'Total Patients', 
                'value' => $totalPatients, 
                'color' => 'text-primary',
                'route' => route('admin.patients.index')
            ],
            [
                'icon' => 'bi-person-badge', 
                'title' => 'Total Doctors', 
                'value' => $totalDoctors, 
                'color' => 'text-success',
                'route' => route('admin.doctors.index')
            ],
            [
                'icon' => 'bi-people', 
                'title' => 'Receptionists', 
                'value' => $totalReceptionists, 
                'color' => 'text-info',
                'route' => route('admin.receptionists.index')
            ],
            [
                'icon' => 'bi-capsule', 
                'title' => 'Pharmacists', 
                'value' => $totalPharmacists, 
                'color' => 'text-warning',
                'route' => route('admin.pharmacists.index')
            ],
        ];        

        $malePatients = Patient::where('gender', 'male')->count();
        $femalePatients = Patient::where('gender', 'female')->count();

        $now = Carbon::now();
        $startOfThisWeek = $now->startOfWeek();
        $startOfLastWeek = $startOfThisWeek->copy()->subWeek();
        $endOfLastWeek = $startOfThisWeek->copy()->subDay();

        $maleThisWeek = Patient::where('gender', 'male')->whereBetween('created_at', [$startOfThisWeek, $now])->count();
        $maleLastWeek = Patient::where('gender', 'male')->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();

        $femaleThisWeek = Patient::where('gender', 'female')->whereBetween('created_at', [$startOfThisWeek, $now])->count();
        $femaleLastWeek = Patient::where('gender', 'female')->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();

        $maleGrowth = $maleLastWeek > 0 ? round((($maleThisWeek - $maleLastWeek) / $maleLastWeek) * 100, 1) : 0;
        $femaleGrowth = $femaleLastWeek > 0 ? round((($femaleThisWeek - $femaleLastWeek) / $femaleLastWeek) * 100, 1) : 0;

        return view('admin.pages.dashboard.index', compact(
            'cards',
            'malePatients',
            'femalePatients',
            'maleGrowth',
            'femaleGrowth'
        ));
    }
}
