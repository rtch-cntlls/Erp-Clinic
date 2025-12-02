<?php

namespace App\Http\Controllers\Pharmacist;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use App\Models\Inventory;
use App\Models\Dispense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PharmacistDispenseController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::with(['patient', 'doctor', 'items.inventory'])
                                     ->latest()
                                     ->paginate(20);

        return view('pharmacist.pages.dispense.index', compact('prescriptions'));
    }

    public function dispense(Request $request, Prescription $prescription)
    {
        DB::transaction(function() use ($prescription) {
    
            foreach ($prescription->items as $item) {
                $inventory = $item->inventory;
    
                if (!$inventory) {
                    throw new \Exception("Inventory item not found for {$item->id}");
                }
    
                if ($inventory->quantity < $item->quantity) {
                    throw new \Exception("Insufficient stock for {$inventory->name}");
                }
    
                $inventory->decrement('quantity', $item->quantity);
            }
    
            $prescription->update(['status' => 'dispensed']);
            Dispense::create([
                'prescription_id' => $prescription->id,
                'dispensed_by'    => auth()->guard('pharmacist')->id(),
                'total_amount'    => $prescription->items->sum(fn($i) => $i->quantity * ($i->unit_price ?? 0)),
                'dispense_date'   => now(),
            ]);
        });
    
        return redirect()->back()->with('success', 'Prescription dispensed successfully.');
    }    
}
