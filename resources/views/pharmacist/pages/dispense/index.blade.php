@extends('layouts.pharmacist')
@section('title', 'Pharmacy')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0"><i class="bi bi-capsule me-2"></i> Pharmacy Management</h4>
    </div>
    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif
    <div class="row mb-3 g-2">
        <div class="col-md-4">
            <input type="text" class="form-control rounded-pill" id="searchPrescription" placeholder="Search by patient or doctor...">
        </div>
        <div class="col-md-3">
            <select class="form-select rounded-pill" id="filterStatus">
                <option value="">All Status</option>
                <option value="pending">Pending</option>
                <option value="dispensed">Dispensed</option>
                <option value="cancelled">Cancelled</option>
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
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($prescriptions as $index => $prescription)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $prescription->patient->first_name }} {{ $prescription->patient->last_name }}</td>
                                <td>{{ $prescription->doctor->name }}</td>
                                <td>
                                    @if($prescription->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($prescription->status == 'dispensed')
                                        <span class="badge bg-success">Dispensed</span>
                                    @else
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td>{{ $prescription->created_at->format('d M Y') }}</td>
                                <td>
                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#viewPrescriptionModal{{ $prescription->id }}">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    @include('admin.pages.pharmacy.show')
                                    @if($prescription->status == 'pending')
                                        <form action="{{ route('pharmacist.dispense.dispense', $prescription->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="bi bi-check-circle me-1"></i> Dispense
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">
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
