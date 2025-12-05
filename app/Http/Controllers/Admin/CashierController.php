<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cashier;

class CashierController extends Controller
{
    public function index()
    {
        $cashiers = Cashier::orderBy('created_at', 'desc')->paginate(10);

        $cards = [
            [
                'title' => 'Total Cashiers',
                'value' => Cashier::count(),
                'icon'  => 'bi-people-fill',
                'color' => 'text-primary',
            ],
            [
                'title' => 'Active',
                'value' => Cashier::where('status', 'active')->count(),
                'icon'  => 'bi-person-check-fill',
                'color' => 'text-success',
            ],
            [
                'title' => 'Inactive',
                'value' => Cashier::where('status', 'inactive')->count(),
                'icon'  => 'bi-person-x-fill',
                'color' => 'text-warning',
            ],
            [
                'title' => 'Terminated',
                'value' => Cashier::where('status', 'terminated')->count(),
                'icon'  => 'bi-person-dash-fill',
                'color' => 'text-danger',
            ],
        ];

        return view('admin.pages.cashier.index', compact('cashiers', 'cards'));
    }

    public function create()
    {
        return view('admin.pages.cashier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:cashiers,email',
            'address' => 'nullable|string|max:255',
            'date_hired' => 'nullable|date',
            'shift' => 'nullable|in:morning,afternoon,night',
            'status' => 'required|in:active,inactive,terminated',
            'notes' => 'nullable|string',
        ]);

        Cashier::create($request->all());
        return redirect()->route('admin.cashiers.index')->with('success', 'Cashier created successfully.');
    }

    public function edit(Cashier $cashier)
    {
        return view('admin.pages.cashier.edit', compact('cashier'));
    }

    public function update(Request $request, Cashier $cashier)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:cashiers,email,' . $cashier->id,
            'address' => 'nullable|string|max:255',
            'date_hired' => 'nullable|date',
            'shift' => 'nullable|in:morning,afternoon,night',
            'status' => 'required|in:active,inactive,terminated',
            'notes' => 'nullable|string',
        ]);

        $cashier->update($request->all());
        return redirect()->route('admin.cashiers.index')->with('success', 'Cashier updated successfully.');
    }

    public function toggleStatus(Cashier $cashier)
    {
        if($cashier->status == 'active'){
            $cashier->status = 'inactive';
        } elseif($cashier->status == 'inactive'){
            $cashier->status = 'active';
        }
        $cashier->save();

        return redirect()->route('admin.cashiers.index')->with('success', 'Cashier status updated successfully.');
    }
}
