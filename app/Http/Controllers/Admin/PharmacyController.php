<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use App\Models\PrescriptionItem;
use App\Models\Medicine;
use App\Models\Dispense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PharmacyController extends Controller
{
    public function index() {
        $prescriptions = Prescription::with('patient', 'doctor')->latest()->paginate(20);
        return view('admin.pages.pharmacy.index', compact('prescriptions'));
    }

    public function pending() {
        $prescriptions = Prescription::where('status', 'pending')->with('patient', 'doctor')->get();
        return view('admin.pages.pharmacy.pending', compact('prescriptions'));
    }

    public function show(Prescription $prescription) {
        $prescription->load('items.medicine');
        return view('admin.pages.pharmacy.show', compact('prescription'));
    }

    public function dispense(Request $request, Prescription $prescription) {
        foreach ($prescription->items as $item) {
            $medicine = Medicine::find($item->medicine_id);
            if ($medicine->stock < $item->quantity) {
                return back()->with('error', "Insufficient stock for {$medicine->name}");
            }
            $medicine->decrement('stock', $item->quantity);
        }

        $prescription->update(['status' => 'dispensed']);

        Dispense::create([
            'prescription_id' => $prescription->id,
            'dispensed_by' => Auth::id(),
            'total_amount' => $prescription->items->sum(fn($i) => $i->quantity * $i->medicine->price),
            'dispense_date' => now(),
        ]);

        return redirect()->route('admin.pharmacy.index')->with('success', 'Prescription dispensed successfully.');
    }
}
