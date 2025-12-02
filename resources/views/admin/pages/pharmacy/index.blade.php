@extends('layouts.admin')
@section('title', 'Pharmacy')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold"><i class="bi bi-capsule me-2"></i> Pharmacy Management</h3>
        {{-- <button type="button" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#pendingPrescriptionsModal">
            <i class="bi bi-clock-history me-1"></i> Pending Prescriptions
        </button>
        @include('admin.pages.pharmacy.prescriptions') --}}
    </div>
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="bi bi-card-list fs-2 text-primary mb-2"></i>
                <h6 class="text-muted mb-1">Total Prescriptions</h6>
                <h4 class="fw-bold">{{ $prescriptions->total() }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="bi bi-hourglass-split fs-2 text-warning mb-2"></i>
                <h6 class="text-muted mb-1">Pending</h6>
                <h4 class="fw-bold text-warning">{{ $prescriptions->where('status','pending')->count() }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="bi bi-check-circle fs-2 text-success mb-2"></i>
                <h6 class="text-muted mb-1">Dispensed</h6>
                <h4 class="fw-bold text-success">{{ $prescriptions->where('status','dispensed')->count() }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="bi bi-exclamation-triangle fs-2 text-danger mb-2"></i>
                <h6 class="text-muted mb-1">Overdue</h6>
                <h4 class="fw-bold text-danger">{{ $prescriptions->where('status','overdue')->count() }}</h4>
            </div>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($prescriptions as $prescription)
                        <tr>
                            <td>{{ $prescription->patient->first_name }} {{ $prescription->patient->last_name }}</td>
                            <td>{{ $prescription->doctor->name }}</td>
                            <td>
                                <span class="badge 
                                    {{ $prescription->status == 'pending' ? 'bg-warning text-dark' : 
                                       ($prescription->status == 'dispensed' ? 'bg-success' : 'bg-danger') }}">
                                    {{ ucfirst($prescription->status) }}
                                </span>
                            </td>
                            <td>{{ $prescription->created_at->format('M. d, Y') }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewPrescriptionModal{{ $prescription->id }}">
                                    <i class="bi bi-eye me-1"></i> View
                                </button>
                                @include('admin.pages.pharmacy.show')
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-exclamation-circle me-2"></i> No prescriptions found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $prescriptions->links() }}
</div>
@endsection
