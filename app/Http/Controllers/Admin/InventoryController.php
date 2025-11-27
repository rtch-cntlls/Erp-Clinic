<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventory = Inventory::orderBy('name')->get();
        return view('admin.pages.inventory.index', compact('inventory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:20',
            'expiry_date' => 'nullable|date',
            'low_stock_threshold' => 'nullable|integer|min:0',
        ]);

        Inventory::create($request->all());
        return redirect()->route('admin.inventory.index')->with('success', 'Inventory item added successfully!');
    }

    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:20',
            'expiry_date' => 'nullable|date',
            'low_stock_threshold' => 'nullable|integer|min:0',
        ]);

        $inventory->update($request->all());
        return redirect()->route('admin.inventory.index')->with('success', 'Inventory item updated successfully!');
    }

}
