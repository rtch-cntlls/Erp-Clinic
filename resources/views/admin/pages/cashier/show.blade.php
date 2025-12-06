@extends('layouts.admin')
@section('title', 'Cashier Details')
@section('content')
<div>
    <div class="d-flex gap-2 align-items-center mb-4">
        <a href="{{ route('admin.cashiers.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left-circle me-1"></i> Back
        </a>
        <h4 class="fw-bold mb-0">Cashier Details</h4>
    </div>
    <div class="row g-4">
        <div class="col-md-3 text-center">
            @if($cashier->profile_image)
                <img src="{{ asset($cashier->profile_image) }}" alt="Cashier Image" 
                     class="img-fluid rounded-circle border mb-3" style="width:150px;height:150px;object-fit:cover;">
            @else
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3" style="width:150px;height:150px;">
                    <i class="bi bi-person text-muted fs-1"></i>
                </div>
            @endif
            <h5 class="fw-bold">{{ $cashier->full_name }}</h5>
            <span class="badge rounded-pill {{ $cashier->status=='active' ? 'bg-success' : 'bg-secondary' }}">
                {{ ucfirst($cashier->status) }}
            </span>
        </div>
        <div class="col-md-9">
            <div class="row g-3">
                <div class="col-md-6">
                    <p class="text-muted mb-1">Employee ID</p>
                    <h6>{{ $cashier->employee_id }}</h6>
                </div>
                <div class="col-md-6">
                    <p class="text-muted mb-1">Cashier Code</p>
                    <h6>{{ $cashier->cashier_code }}</h6>
                </div>
                <div class="col-md-6">
                    <p class="text-muted mb-1">Email</p>
                    <h6>{{ $cashier->email ?? 'N/A' }}</h6>
                </div>
                <div class="col-md-6">
                    <p class="text-muted mb-1">Phone</p>
                    <h6>{{ $cashier->phone ?? 'N/A' }}</h6>
                </div>
                <div class="col-md-6">
                    <p class="text-muted mb-1">Address</p>
                    <h6>{{ $cashier->address ?? 'N/A' }}</h6>
                </div>
                <div class="col-md-6">
                    <p class="text-muted mb-1">Date Hired</p>
                    <h6>{{ $cashier->date_hired ? $cashier->date_hired->format('M d, Y') : 'N/A' }}</h6>
                </div>
                <div class="col-md-6">
                    <p class="text-muted mb-1">Shift</p>
                    <h6>{{ ucfirst($cashier->shift ?? 'N/A') }}</h6>
                </div>
                <div class="col-md-6">
                    <p class="text-muted mb-1">Float Amount</p>
                    <h6>₱{{ number_format($cashier->float_amount ?? 0, 2) }}</h6>
                </div>
                <div class="col-md-12">
                    <p class="text-muted mb-1">Notes</p>
                    <h6>{{ $cashier->notes ?? 'N/A' }}</h6>
                </div>
            </div>
        </div>
    </div>
    @if($cashier->billings->count() > 0)
    <div class="mt-5">
        <h5 class="fw-bold mb-3">Billing History</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Invoice #</th>
                        <th>Patient</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cashier->billings as $billing)
                    <tr>
                        <td>{{ $billing->invoice_no }}</td>
                        <td>{{ $billing->patient->full_name ?? 'N/A' }}</td>
                        <td>₱{{ number_format($billing->total_amount, 2) }}</td>
                        <td>{{ $billing->created_at->format('M d, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
