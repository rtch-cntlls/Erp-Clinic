<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pharmacist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PharmacistController extends Controller
{
    public function index()
    {
        $pharmacists = Pharmacist::orderBy('first_name')->paginate(10);
        $cards = [
            [
                'icon' => 'bi-people-fill',
                'title' => 'Total Pharmacists',
                'value' => Pharmacist::count(),
                'color' => 'text-primary'
            ],
            [
                'icon' => 'bi-person-check',
                'title' => 'Active Pharmacists',
                'value' => Pharmacist::where('status', true)->count(),
                'color' => 'text-success'
            ],
            [
                'icon' => 'bi-person-x',
                'title' => 'Inactive Pharmacists',
                'value' => Pharmacist::where('status', false)->count(),
                'color' => 'text-danger'
            ],
        ];

        return view('admin.pages.pharmacists.index', compact('pharmacists', 'cards'));
    }

    public function create()
    {
        return view('admin.pages.pharmacists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'email'      => 'required|email|unique:pharmacists,email',
            'password'   => 'required|min:6',
        ]);

        Pharmacist::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'password'   => Hash::make($request->password),
            'status'     => true,
        ]);

        return redirect()->route('admin.pharmacists.index')
            ->with('success', 'Pharmacist created successfully.');
    }
    
    public function update(Request $request, $id)
    {
        $pharmacist = Pharmacist::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'email'      => 'required|email|unique:pharmacists,email,' . $id,
            'phone'      => 'nullable',
        ]);

        $pharmacist->update($request->only(['first_name', 'last_name', 'email', 'phone']));

        return redirect()->route('admin.pharmacists.index')
            ->with('success', 'Pharmacist updated successfully.');
    }
}
