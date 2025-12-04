<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;

class ReceptionistPatientController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $patients = Patient::query()
            ->when($search, function($query, $search) {
                $query->where(function($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                      ->orWhere('last_name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);

        return view('receptionist.pages.patients.index', compact('patients'));
    }

    public function create()
    {
        return view('receptionist.pages.patients.create');
    }

    public function show($id)
    {
        $patient = Patient::findOrFail($id);
    
        return view('receptionist.pages.patients.show', compact('patient'));
    }   

    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $patient->update($request->only([
            'name', 'email', 'phone', 'gender', 'dob', 
            'blood_group', 'emergency_contact', 'address', 'insurance', 
            'allergies', 'medications', 'medical_history'
        ]));

        return back()->with('success', 'Patient details updated successfully.');
    }
}
