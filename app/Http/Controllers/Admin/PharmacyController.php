<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use App\Models\PrescriptionItem;
use App\Models\Inventory;
use App\Models\Dispense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PharmacyController extends Controller
{
    public function index() {
        $prescriptions = Prescription::with(['patient', 'doctor', 'items.inventory'])->latest()->paginate(20);
        return view('admin.pages.pharmacy.index', compact('prescriptions'));
    }

    public function pending() {
        $prescriptions = Prescription::where('status', 'pending')
            ->with(['patient', 'doctor', 'items.inventory'])
            ->get();
        return view('admin.pages.pharmacy.pending', compact('prescriptions'));
    }

    public function show(Prescription $prescription) {
        $prescription->load('items.inventory');
        return view('admin.pages.pharmacy.show', compact('prescription'));
    }
}
