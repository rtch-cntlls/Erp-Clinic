<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Prescription;

class PatientPrescriptionsController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::where('patient_id', Auth::id())->latest()->get();

        return view('patient.pages.prescriptions.index', compact('prescriptions'));
    }
}
