<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Billing;

class CashierDashboardController extends Controller
{
    public function index()
    {
        $cards = [
            [
                'title' => 'Today\'s Revenue',
                'count' => '₱' . number_format(Billing::whereDate('created_at', today())
                                        ->where('status', 'paid')
                                        ->sum('amount'), 2),
                'icon'  => 'bi-cash-stack',
                'color' => 'success',
            ],
            [
                'title' => 'Pending Payments',
                'count' => Billing::where('status', 'pending')->count(),
                'icon'  => 'bi-clock',
                'color' => 'warning',
            ],
            [
                'title' => 'Completed Payments',
                'count' => Billing::where('status', 'paid')->count(),
                'icon'  => 'bi-check-circle',
                'color' => 'primary',
            ],
            [
                'title' => 'Total Billings',
                'count' => Billing::count(),
                'icon'  => 'bi-receipt',
                'color' => 'info',
            ],
        ];

        return view('cashier.pages.dashboard.index', compact('cards'));
    }
}
