<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Billing;
use App\Models\Patient;
use App\Models\Appointment;

class BillingController extends Controller
{
    public function index()
    {
        $billings = Billing::with('patient')->orderBy('id', 'desc')->paginate(10);

        return view('admin.pages.billing.index', compact('billings'));
    }

    public function create()
    {
        $patients = Patient::orderBy('first_name')->get();
        $appointments = Appointment::where('status', 'completed')->get();

        return view('admin.pages.billing.create', compact('patients', 'appointments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'nullable|string',
        ]);

        Billing::create([
            'patient_id' => $request->patient_id,
            'appointment_id' => $request->appointment_id,
            'amount' => $request->amount,
            'status' => 'paid',
            'payment_method' => $request->payment_method,
            'notes' => $request->notes
        ]);

        return redirect()->route('admin.billing.index')
            ->with('success', 'Billing record created successfully.');
    }

    public function show($id)
    {
        $billing = Billing::with('patient', 'appointment')->findOrFail($id);

        return view('admin.pages.billing.show', compact('billing'));
    }
}
