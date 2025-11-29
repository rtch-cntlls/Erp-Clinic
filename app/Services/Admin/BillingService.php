<?php

namespace App\Services\Admin;

use App\Models\Billing;
use Illuminate\Support\Facades\DB;

class BillingService
{
    public function getDashboardCards()
    {
        $totalBills = Billing::count();
        $paidBills = Billing::where('status', 'paid')->count();
        $pendingBills = Billing::where('status', 'pending')->count();
        $totalRevenue = Billing::where('status', 'paid')->sum('amount');

        return [
            [
                'icon'  => 'bi-card-list',
                'title' => 'Total Bills',
                'value' => $totalBills,
                'color' => 'text-secondary'
            ],
            [
                'icon'  => 'bi-check-circle',
                'title' => 'Paid Bills',
                'value' => $paidBills,
                'color' => 'text-success'
            ],
            [
                'icon'  => 'bi-hourglass-split',
                'title' => 'Pending Bills',
                'value' => $pendingBills,
                'color' => 'text-warning'
            ],
            [
                'icon'  => 'bi-cash-stack',
                'title' => 'Total Revenue',
                'value' => "₱" . $this->formatCurrencyK($totalRevenue),
                'color' => 'text-success'
            ],
        ];
    }

    public function createBilling(array $data)
    {
        return DB::transaction(function () use ($data) {
            return Billing::create([
                'patient_id' => $data['patient_id'],
                'appointment_id' => $data['appointment_id'] ?? null,
                'amount' => $data['amount'],
                'status' => 'paid',
                'payment_method' => $data['payment_method'] ?? null,
                'notes' => $data['notes'] ?? null,
            ]);
        });
    }

    private function formatCurrencyK($number)
    {
        if ($number >= 1000000) {
            return number_format($number / 1000000, 1) . 'M';
        } elseif ($number >= 1000) {
            return number_format($number / 1000, 1) . 'K';
        } else {
            return number_format($number, 2);
        }
    }
}
