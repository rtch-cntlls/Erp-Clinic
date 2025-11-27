@extends('layouts.admin')
@section('title', 'Patient Details')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Patient Details</h4>
        <div>
            <a href="{{ route('admin.patients.index') }}" class="btn btn-secondary d-flex align-items-center">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
            </a>
        </div>
    </div>
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h5 class="mb-3 text-primary fw-semibold"><i class="bi bi-person-circle me-2"></i> Personal Information</h5>
            <div class="row mb-3">
                <div class="col-md-6 mb-2">
                    <strong>First Name:</strong> {{ $patient->first_name }}
                </div>
                <div class="col-md-6 mb-2">
                    <strong>Last Name:</strong> {{ $patient->last_name }}
                </div>
                <div class="col-md-6 mb-2">
                    <strong>Email:</strong> {{ $patient->email ?? '-' }}
                </div>
                <div class="col-md-6 mb-2">
                    <strong>Phone:</strong> {{ $patient->phone ?? '-' }}
                </div>
            </div>
            <h5 class="mb-3 text-primary fw-semibold"><i class="bi bi-heart-pulse me-2"></i> Medical Information</h5>
            <div class="row mb-3">
                <div class="col-md-4 mb-2">
                    <strong>Date of Birth:</strong> {{ $patient->dob ? $patient->dob->format('d M, Y') : '-' }}
                </div>
                <div class="col-md-4 mb-2">
                    <strong>Gender:</strong> 
                    @if($patient->gender)
                        <span class="badge bg-info text-dark">{{ ucfirst($patient->gender) }}</span>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </div>
                <div class="col-md-4 mb-2">
                    <strong>Blood Group:</strong> {{ $patient->blood_group ?? '-' }}
                </div>
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
</div>
@endsection
