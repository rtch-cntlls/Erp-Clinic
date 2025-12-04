<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\Appointment;
use App\Models\Inventory;
use App\Models\Prescription;
use App\Models\PrescriptionItem;

class DoctorPatientController extends Controller
{
    public function index()
    {
        $doctor = auth()->guard('doctor')->user();
        $patients = Patient::orderBy('name')->get();

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
            'action'     => 'required|string|max:255',
            'findings'   => 'nullable|string',
            'appointment_id' => 'nullable|exists:appointments,id',
        ]);

        $doctorId = auth()->guard('doctor')->id();

        $visit = PatientVisit::create([
            'patient_id' => $patientId,
            'visit_date' => $request->visit_date,
            'action'     => $request->action,
            'findings'   => $request->findings,
            'doctor_id'  => $doctorId,
        ]);

        if ($request->appointment_id) {
            $appointment = Appointment::find($request->appointment_id);
            if ($appointment) {
                $appointment->status = 'Completed';
                $appointment->completed_at = now();
                $appointment->save();
            }
        }

        return redirect()->back()->with('success', 'Patient visit added successfully.');
    }

    public function storePrescription(Request $request, $patientId)
    {
        $request->validate([
            'medicine_id.*' => 'required|exists:inventories,id',
            'quantity.*'    => 'required|integer|min:1',
        ]);
    
        $doctor = auth()->guard('doctor')->user();
    
        $prescription = Prescription::create([
            'patient_id' => $patientId,
            'doctor_id'  => $doctor->id,
            'status'     => 'pending',
        ]);
    
        foreach ($request->medicine_id as $i => $medicineId) {
            $inventory = Inventory::find($medicineId);
    
            if (!$inventory) continue;
    
            PrescriptionItem::create([
                'prescription_id' => $prescription->id,
                'medicine_id'     => $inventory->id,
                'quantity'        => $request->quantity[$i],
                'unit_price'      => $inventory->unit_price, 
            ]);
        }
    
        return back()->with('success', 'Prescription created successfully.');
    }    
}
