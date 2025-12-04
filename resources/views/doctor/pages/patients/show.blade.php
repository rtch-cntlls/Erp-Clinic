@extends('layouts.doctor')
@section('title', 'Patient Details')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <a href="{{ route('doctor.patients.index') }}" class="btn btn-outline-secondary btn-sm me-3">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
            </a>
            <h3 class="fw-bold text-dark mb-0">
                <i class="bi bi-person-lines-fill me-2"></i>Patient Details
            </h3>
        </div>
        <div>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addVisitModal">
                <i class="bi bi-plus-circle me-1"></i> Add Visit Log
            </button>
            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#addPrescriptionModal">
                <i class="bi bi-capsule me-1"></i> Add Prescription
            </button>
        </div>
        @include('doctor.pages.patients.prescription')
        @include('doctor.pages.patients.create')
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
    @if($patient->visits->count() > 0)
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h6 class="mb-0"><i class="bi bi-journal-medical me-2"></i>Patient Visits</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light text-uppercase small">
                            <tr>
                                <th>Visit Date</th>
                                <th>Action</th>
                                <th>Findings</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patient->visits as $visit)
                            <tr>
                                <td>{{ $visit->visit_date->format('M d, Y H:i') }}</td>
                                <td>
                                    @if($visit->action)
                                        <span class="badge bg-success">{{ $visit->action }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($visit->findings)
                                        {{ $visit->findings }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class=" text-center mt-3">
            <i class="bi bi-info-circle me-1"></i>No visits recorded for this patient.
        </div>
    @endif
</div>
@endsection
