@extends('layouts.admin')
@section('title', 'Billing')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">
            <i class="bi bi-receipt-cutoff me-2"></i> Billing Management
        </h3>
        <a href="{{ route('admin.billing.create') }}" class="btn btn-primary d-flex align-items-center">
            <i class="bi bi-plus-circle me-1"></i> New Bill
        </a>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="bi bi-card-list fs-2 text-primary mb-2"></i>
                <h6 class="text-muted mb-1">Total Bills</h6>
                <h4 class="fw-bold">{{ $billings->total() }}</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="bi bi-check-circle fs-2 text-success mb-2"></i>
                <h6 class="text-muted mb-1">Paid Bills</h6>
                <h4 class="fw-bold text-success">
                    {{ $billings->where('status', 'paid')->count() }}
                </h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="bi bi-hourglass-split fs-2 text-warning mb-2"></i>
                <h6 class="text-muted mb-1">Pending Bills</h6>
                <h4 class="fw-bold text-warning">
                    {{ $billings->where('status', 'pending')->count() }}
                </h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="bi bi-cash-stack fs-2 text-success mb-2"></i>
                <h6 class="text-muted mb-1">Total Revenue</h6>
                <h4 class="fw-bold text-success">
                    ₱{{ number_format($billings->where('status','paid')->sum('amount'), 2) }}
                </h4>
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
                            <th>Patient</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Payment Method</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($billings as $billing)
                        <tr>
                            <td>{{ $billing->id }}</td>
                            <td>{{ $billing->patient->full_name }}</td>
                            <td class="fw-semibold">₱{{ number_format($billing->amount, 2) }}</td>
                            <td>
                                <span class="badge px-3 py-2 rounded-pill bg-{{ $billing->status == 'paid' ? 'success' : 'warning' }}">
                                    {{ ucfirst($billing->status) }}
                                </span>
                            </td>
                            <td>{{ $billing->payment_method ?? '—' }}</td>
                            <td>{{ $billing->created_at->format('M d, Y') }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-secondary rounded-pill" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#billingDetailsModal{{ $billing->id }}">
                                    <i class="bi bi-eye"></i>
                                </button>
                                @include('admin.pages.billing.show')
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="bi bi-exclamation-circle me-2"></i>No billing records found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="mt-3">
        {{ $billings->links() }}
    </div>
</div>
@endsection
