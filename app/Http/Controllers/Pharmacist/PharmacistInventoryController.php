<?php

namespace App\Http\Controllers\Pharmacist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;

class PharmacistInventoryController extends Controller
{
    public function index()
    {
        $inventoryItems = Inventory::orderBy('created_at', 'desc')->get();

        $categories = Inventory::select('category')
                               ->distinct()
                               ->pluck('category');

        return view('pharmacist.pages.inventory.index', compact('inventoryItems', 'categories'));
    }
}
