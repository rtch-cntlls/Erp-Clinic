@extends('layouts.admin')
@section('title', 'Patient Details')
@section('content')
<div class="container">
    <a href="{{ route('admin.patients.index') }}">
        <i class="bi bi-arrow-left-circle me-1"></i>
    </a>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Patient Details</h4>
    </div>
    <div class="card border border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="mb-3 text-primary fw-semibold"><i class="bi bi-person-circle me-2"></i> Personal Information</h5>
            <div class="row mb-3">
                <div class="col-md-6 mb-2"><strong>First Name:</strong> {{ $patient->first_name }}</div>
                <div class="col-md-6 mb-2"><strong>Last Name:</strong> {{ $patient->last_name }}</div>
                <div class="col-md-6 mb-2"><strong>Email:</strong> {{ $patient->email ?? '-' }}</div>
                <div class="col-md-6 mb-2"><strong>Phone:</strong> {{ $patient->phone ?? '-' }}</div>
            </div>
            <h5 class="mb-3 text-primary fw-semibold"><i class="bi bi-heart-pulse me-2"></i> Medical Information</h5>
            <div class="row mb-3">
                <div class="col-md-4 mb-2"><strong>Date of Birth:</strong> {{ $patient->dob ? $patient->dob->format('M. d, Y') : '-' }}</div>
                <div class="col-md-4 mb-2">
                    <strong>Gender:</strong> 
                    @if($patient->gender)
                        <span class="badge bg-info text-dark">{{ ucfirst($patient->gender) }}</span>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </div>
                <div class="col-md-4 mb-2"><strong>Blood Type:</strong> {{ $patient->blood_group ?? '-' }}</div>
            </div>
            <div class="mb-3">
                <h6 class="fw-semibold text-primary"><i class="bi bi-geo-alt me-2"></i> Address</h6>
                <p class="mb-0">{{ $patient->address ?? '-' }}</p>
            </div>
            <div class="mb-3">
                <h6 class="fw-semibold text-primary"><i class="bi bi-file-medical me-2"></i> Medical History</h6>
                <p class="mb-0">{{ $patient->medical_history ?? '-' }}</p>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-3 col-6">
            <div class="card shadow-sm text-center border-0 py-3">
                <h6 class="mb-1 fw-bold">Total Visits</h6>
                <h6>{{ $patient->visits->count() ?? 0 }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="card shadow-sm text-center border-0 py-3">
                <h6 class="mb-1 fw-bold">Last Visit</h6>
                <h6>{{ $patient->visits->last()?->created_at?->format('M d, Y') ?? '-' }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="card shadow-sm text-center border-0 py-3">
                <h6 class="mb-1 fw-bold">Upcoming Appointment</h6>
                <h6 class="fw-bold text-success">{{ $patient->upcoming_appointment?->format('M d, Y') ?? '-' }}</h6>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="card shadow-sm text-center border-0 py-3">
                <h6 class="mb-1 fw-bold">Critical Notes</h6>
                <h6 class="fw-bold text-danger">{{ $patient->critical_notes_count ?? 0 }}</h6>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="text-primary fw-semibold"><i class="bi bi-clock-history me-2"></i> Visit / Checkup History</h5>
        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#logVisitModal">
            <i class="bi bi-plus-circle me-1"></i> Log New Visit
        </button>
        @include('admin.pages.patients.new-log')
    </div>
    @include('admin.pages.patients.history')
</div>
@endsection
