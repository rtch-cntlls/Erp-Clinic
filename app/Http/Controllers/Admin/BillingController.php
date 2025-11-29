<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Appointment;
use App\Services\Admin\BillingService;
use App\Models\Billing;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    protected $billingService;

    public function __construct(BillingService $billingService)
    {
        $this->billingService = $billingService;
    }

    public function index()
    {
        $billings = Billing::with('patient')->orderBy('id', 'desc')->paginate(10);
        $cards = $this->billingService->getDashboardCards();

        return view('admin.pages.billing.index', compact('billings', 'cards'));
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

        $this->billingService->createBilling($request->all());

        return redirect()->route('admin.billing.index')
                         ->with('success', 'Billing record created successfully.');
    }

    public function show($id)
    {
        $billing = Billing::with('patient', 'appointment')->findOrFail($id);

        return view('admin.pages.billing.show', compact('billing'));
    }
}
