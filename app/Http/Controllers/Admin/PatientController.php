<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::query();

        if ($request->search) {
            $query->where('first_name', 'like', "%{$request->search}%")
                  ->orWhere('last_name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%")
                  ->orWhere('phone', 'like', "%{$request->search}%");
        }

        $patients = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.pages.patients.index', compact('patients'));
    }

    public function create()
    {
        return view('admin.pages.patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'nullable|email|unique:patients,email',
            'phone'      => 'nullable|string|max:20',
            'dob'        => 'nullable|date',
            'gender'     => 'nullable|in:male,female,other',
            'blood_group'=> 'nullable|string|max:10',
            'address'    => 'nullable|string',
            'medical_history' => 'nullable|string',
        ]);

        Patient::create($request->all());

        return redirect()->route('admin.patients.index')
                         ->with('success', 'Patient created successfully.');
    }

    public function show(Patient $patient)
    {
        return view('admin.pages.patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('admin.pages.patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'nullable|email|unique:patients,email,' . $patient->id,
            'phone'      => 'nullable|string|max:20',
            'dob'        => 'nullable|date',
            'gender'     => 'nullable|in:male,female,other',
            'blood_group'=> 'nullable|string|max:10',
            'address'    => 'nullable|string',
            'medical_history' => 'nullable|string',
        ]);

        $patient->update($request->all());

        return redirect()->route('admin.patients.index')
                         ->with('success', 'Patient updated successfully.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('admin.patients.index')
                         ->with('success', 'Patient deleted successfully.');
    }
}
