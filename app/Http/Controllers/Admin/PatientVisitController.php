<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientVisitController extends Controller
{
    public function store(Request $request, Patient $patient)
    {
        $request->validate([
            'visit_date' => 'required|date',
            'action'     => 'required|string|max:255',
            'findings'   => 'nullable|string',
        ]);

        $patient->visits()->create([
            'visit_date' => $request->visit_date,
            'action'     => $request->action,
            'findings'   => $request->findings,
        ]);

        return redirect()->back()->with('success', 'Visit logged successfully.');
    }
}
