<?php

namespace App\Services\Admin;

use App\Models\Inventory;
use Illuminate\Support\Facades\DB;

class InventoryService
{
    public function getAllItems()
    {
        return Inventory::orderBy('name')->get();
    }

    public function getDashboardCards()
    {
        $inventory = $this->getAllItems();

        $totalItems = $inventory->count();
        $lowStock = $inventory->where('quantity', '<=', fn($item) => $item->low_stock_threshold)->count();
        $categories = $inventory->pluck('category')->unique()->count();
        $expired = $inventory->where('expiry_date', '<', now())->count();

        return [
            [
                'icon'  => 'bi-box',
                'title' => 'Total Items',
                'value' => $totalItems,
                'color' => 'text-primary',
            ],
            [
                'icon'  => 'bi-exclamation-triangle',
                'title' => 'Low Stock',
                'value' => $lowStock,
                'color' => 'text-danger',
            ],
            [
                'icon'  => 'bi-tags',
                'title' => 'Categories',
                'value' => $categories,
                'color' => 'text-warning',
            ],
            [
                'icon'  => 'bi-calendar-x',
                'title' => 'Expired Items',
                'value' => $expired,
                'color' => 'text-secondary',
            ],
        ];
    }

    public function createItem(array $data)
    {
        return DB::transaction(function () use ($data) {
            return Inventory::create($data);
        });
    }

    public function updateItem(Inventory $inventory, array $data)
    {
        return DB::transaction(function () use ($inventory, $data) {
            $inventory->update($data);
            return $inventory;
        });
    }
}
