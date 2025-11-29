@extends('layouts.admin')
@section('title', 'Patient Details')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h4 class="fw-bold">Patient Details</h4>
        <div>
            <a href="{{ route('admin.patients.index') }}" class="btn btn-outline-secondary btn-sm me-2">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
            </a>
        </div>
    </div>
    <div class="row">
        @foreach ($cards as $card)
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card shadow-sm border-0 text-center py-3">
                    <h6 class="mb-1 fw-bold">{{ $card['title'] }}</h6>
                    <h5 class="{{ $card['color'] ?? '' }}">{{ $card['value'] }}</h5>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row g-3 mb-4">
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="text-primary fw-semibold mb-3"><i class="bi bi-person-circle me-2"></i> Personal Information</h5>
                    <div class="row mb-2">
                        <div class="col-6"><strong>Name:</strong> {{ $patient->first_name }} {{ $patient->last_name }}</div>
                        <div class="col-6"><strong>Gender:</strong>
                            @if($patient->gender)
                                <span class="badge bg-primary">{{ ucfirst($patient->gender) }}</span>
                            @else <span class="text-muted">-</span> @endif
                        </div>
                        <div class="col-6"><strong>DOB:</strong> {{ $patient->dob?->format('M. d, Y') ?? '-' }}</div>
                        <div class="col-6"><strong>Blood Type:</strong> {{ $patient->blood_group ?? '-' }}</div>
                        <div class="col-6"><strong>Email:</strong> {{ $patient->email ?? '-' }}</div>
                        <div class="col-6"><strong>Phone:</strong> {{ $patient->phone ?? '-' }}</div>
                        <div class="col-12"><strong>Address:</strong> {{ $patient->address ?? '-' }}</div>
                        <div class="col-6"><strong>Emergency Contact:</strong> {{ $patient->emergency_contact ?? '-' }}</div>
                        <div class="col-6"><strong>Insurance:</strong> {{ $patient->insurance ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="text-primary fw-semibold mb-3"><i class="bi bi-heart-pulse me-2"></i> Medical Information</h5>
                    <div class="row mb-2">
                        <div class="col-6"><strong>Allergies:</strong> {{ $patient->allergies ?? '-' }}</div>
                        <div class="col-6"><strong>Current Medications:</strong> {{ $patient->medications ?? '-' }}</div>
                        <div class="col-12"><strong>Medical History:</strong> {{ $patient->medical_history ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="text-primary fw-semibold"><i class="bi bi-clock-history me-2"></i> Visit / Checkup History</h5>
        {{-- <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#logVisitModal">
            <i class="bi bi-plus-circle me-1"></i> Log New Visit
        </button> --}}
        @include('admin.pages.patients.new-log')
    </div>
    @include('admin.pages.patients.history')
</div>
@endsection
