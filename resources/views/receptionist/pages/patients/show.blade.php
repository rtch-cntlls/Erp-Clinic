@extends('layouts.receptionist')
@section('title', 'Patient Details')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <a href="{{ route('receptionist.patients.index') }}" class="btn btn-outline-secondary btn-sm me-3">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
            </a>
            <h3 class="fw-bold text-dark mb-0">
                <i class="bi bi-person-lines-fill me-2"></i>Patient Details
            </h3>
        </div>
        <div class="">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editPatientModal">
                <i class="bi bi-pencil-square me-1"></i> Edit Patient
            </button>
            @include('receptionist.pages.patients.edit')
        </div>
    </div>
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6"><strong>Full Name:</strong> {{ $patient->name }}</div>
                <div class="col-md-6"><strong>Email:</strong> {{ $patient->email ?? '-' }}</div>
                <div class="col-md-6"><strong>Phone:</strong> {{ $patient->phone ?? '-' }}</div>
                <div class="col-md-6"><strong>Gender:</strong> {{ $patient->gender ? ucfirst($patient->gender) : '-' }}</div>
                <div class="col-md-6"><strong>Date of Birth:</strong> {{ $patient->dob ? $patient->dob->format('M d, Y') : '-' }}</div>
                <div class="col-md-6"><strong>Blood Group:</strong> <span class="badge bg-info text-dark">{{ $patient->blood_group ?? '-' }}</span></div>
                <div class="col-md-12"><strong>Address:</strong> {{ $patient->address ?? '-' }}</div>
                <div class="col-md-6"><strong>Emergency Contact:</strong> {{ $patient->emergency_contact ?? '-' }}</div>
                <div class="col-md-6"><strong>Insurance:</strong> {{ $patient->insurance ?? '-' }}</div>
                <div class="col-md-12"><strong>Allergies:</strong> 
                    @if($patient->allergies)
                        <span class="badge bg-danger">{{ $patient->allergies }}</span>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </div>
                <div class="col-md-12"><strong>Medications:</strong> 
                    @if($patient->medications)
                        <span class="badge bg-warning text-dark">{{ $patient->medications }}</span>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </div>
                <div class="col-md-12"><strong>Medical History:</strong> {{ $patient->medical_history ?? '-' }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
