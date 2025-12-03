@extends('layouts.pharmacist')
@section('title', 'Stock Inventory')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">
            <i class="bi bi-box-seam me-2"></i>Stock Inventory
        </h4>
        <button class="btn btn-sm btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addItemModal">
            <i class="bi bi-plus-circle me-1"></i> Add Item
        </button>
        @include('admin.pages.inventory.create')
    </div>
    <div class="row mb-3 g-2">
        <div class="col-md-4">
            <input type="text" class="form-control" id="searchInventory" placeholder="Search by name or category...">
        </div>
        <div class="col-md-3">
            <select class="form-select" id="filterCategory">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-light text-muted">
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inventoryItems as $index => $item)
                            @php
                                $isLowStock = $item->quantity <= $item->low_stock_threshold;
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->category }}</td>
                                <td>
                                    {{ $item->quantity }}
                                    @if($isLowStock)
                                        <span class="badge bg-warning text-dark ms-1">Low</span>
                                    @endif
                                </td>
                                <td>{{ $item->unit }}</td>
                                <td>₱{{ $item->unit_price }}</td>
                                <td>
                                    @if($item->quantity <= $item->low_stock_threshold)
                                        <span class="badge bg-danger">Low Stock</span>
                                    @elseif($item->expiry_date && $item->expiry_date < now())
                                        <span class="badge bg-secondary">Expired</span>
                                    @else
                                        <span class="badge bg-success">Available</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#showItemModal{{ $item->id }}">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editItemModal{{ $item->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </td>
                                @include('admin.pages.inventory.edit')
                                @include('admin.pages.inventory.show')
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-3">No inventory items found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
