@extends('layouts.admin')
@section('title', 'Inventory')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark"><i class="bi bi-box-seam me-2"></i>Inventory Management</h3>
        <button class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addItemModal">
            <i class="bi bi-plus-circle me-1"></i> Add Item
        </button>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="bi bi-box fs-2 text-primary mb-2"></i>
                <h6 class="text-muted mb-1">Total Items</h6>
                <h4 class="fw-bold">{{ $inventory->count() }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="bi bi-exclamation-triangle fs-2 text-danger mb-2"></i>
                <h6 class="text-muted mb-1">Low Stock</h6>
                <h4 class="fw-bold text-danger">{{ $inventory->where('quantity', '<=', 'low_stock_threshold')->count() }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="bi bi-tags fs-2 text-warning mb-2"></i>
                <h6 class="text-muted mb-1">Categories</h6>
                <h4 class="fw-bold">{{ $inventory->pluck('category')->unique()->count() }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="bi bi-calendar-x fs-2 text-secondary mb-2"></i>
                <h6 class="text-muted mb-1">Expired Items</h6>
                <h4 class="fw-bold text-secondary">{{ $inventory->where('expiry_date', '<', now())->count() }}</h4>
            </div>
        </div>
    </div>
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th></th>
                            <th>Item Name</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Expiry Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inventory as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->category }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->unit }}</td>
                                <td>{{ $item->expiry_date?->format('d M Y') ?? '-' }}</td>
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
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editItemModal{{ $item->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </td>
                            </tr>
                            @include('admin.pages.inventory.edit')
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="bi bi-exclamation-circle me-2"></i> No inventory items found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('admin.pages.inventory.create')
</div>
@endsection
