<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Billing;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class CashierInvoiceController extends Controller
{
    public function index()
    {
        $invoices = Billing::with(['patient', 'appointment'])
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);

        return view('cashier.pages.invoice.index', compact('invoices'));
    }

    public function markPaid(Request $request, Billing $invoice)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'amount' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'payment_method' => 'required|in:cash,card,GCash,insurance',
            'notes' => 'nullable|string|max:500',
        ]);
    
        $totalAmount = $request->amount - ($request->discount ?? 0);
    
        $invoice->update([
            'patient_id' => $request->patient_id,
            'appointment_id' => $request->appointment_id,
            'cashier_id' => auth()->guard('cashier')->id(),
            'amount' => $request->amount,
            'status' => 'paid',
            'payment_method' => $request->payment_method,
            'notes' => $request->notes,
            'paid_at' => now(),
        ]);

        $invoice->load('cashier', 'patient', 'appointment');
    
        $receiptPath = public_path('receipts');
        if (!file_exists($receiptPath)) {
            mkdir($receiptPath, 0755, true);
        }
    
        $fileName = $invoice->invoice_no . '.pdf';
        $pdf = Pdf::loadView('cashier.pages.invoice.receipt', compact('invoice'));
        $pdf->save($receiptPath . '/' . $fileName);
    
        return redirect()->back()->with('success', 'Invoice marked as paid successfully. Receipt saved in public/receipts.');
    }     
}
