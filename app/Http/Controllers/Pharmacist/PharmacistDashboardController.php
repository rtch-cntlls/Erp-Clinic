<?php

namespace App\Http\Controllers\Pharmacist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Dispense;
use App\Models\Prescription;

class PharmacistDashboardController extends Controller
{
    public function index()
    {
        $cards = [
            [
                'icon'  => 'bi-box-seam',
                'title' => 'Total Inventory Items',
                'value' => Inventory::count(),
                'color' => 'text-primary',
            ],
            [
                'icon'  => 'bi-exclamation-triangle',
                'title' => 'Low Stock Items',
                'value' => Inventory::whereColumn('quantity', '<=', 'low_stock_threshold')->count(),
                'color' => 'text-warning',
            ],
            [
                'icon'  => 'bi-clock-history',
                'title' => 'Pending Dispenses',
                'value' => Prescription::where('status', 'pending')->count(),
                'color' => 'text-warning',
            ],
            [
                'icon'  => 'bi-check2-circle',
                'title' => 'Total Dispenses',
                'value' => Dispense::count(),
                'color' => 'text-success',
            ],
        ];

        $recentInventory = Inventory::orderBy('created_at', 'desc')->take(5)->get();

        $recentDispenses = Dispense::with('prescription')
                                   ->orderBy('dispense_date', 'desc')
                                   ->take(5)
                                   ->get();

        return view('pharmacist.pages.dashboard.index', compact('cards', 'recentInventory', 'recentDispenses'));
    }
}
