<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\Inventory;
use App\Models\Prescription;
use App\Models\PrescriptionItem;

class DoctorPatientController extends Controller
{
    public function index()
    {
        $doctor = auth()->guard('doctor')->user();
        $patients = Patient::orderBy('first_name')->get();

        return view('doctor.pages.patients.index', compact('patients', 'doctor'));
    }

    public function show($id)
    {
        $doctor = auth()->guard('doctor')->user();
        $patient = Patient::findOrFail($id);
        $medicines = Inventory::orderBy('name')->get();
    
        return view('doctor.pages.patients.show', compact('patient', 'doctor', 'medicines'));
    }    

    public function storeVisit(Request $request, $patientId)
    {
        $request->validate([
            'visit_date' => 'required|date',
            'action' => 'required|string|max:255',
            'findings' => 'nullable|string',
        ]);

        PatientVisit::create([
            'patient_id' => $patientId,
            'visit_date' => $request->visit_date,
            'action' => $request->action,
            'findings' => $request->findings,
        ]);

        return redirect()->back()->with('success', 'Patient visit added successfully.');
    }

    public function storePrescription(Request $request, $patientId)
    {
        $request->validate([
            'medicine_id.*' => 'required|exists:inventories,id',
            'quantity.*'    => 'required|integer|min:1',
            'unit_price.*'  => 'nullable|numeric|min:0',
        ]);

        $doctor = auth()->guard('doctor')->user();

        $prescription = Prescription::create([
            'patient_id' => $patientId,
            'doctor_id'  => $doctor->id,
            'status'     => 'pending',
        ]);

        foreach ($request->medicine_id as $i => $medicineId) {
            PrescriptionItem::create([
                'prescription_id' => $prescription->id,
                'medicine_id'     => $medicineId,
                'quantity'        => $request->quantity[$i],
                'unit_price'      => $request->unit_price[$i] ?? null,
            ]);
        }

        return back()->with('success', 'Prescription created successfully.');
    }
}
