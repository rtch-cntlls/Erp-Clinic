@extends('layouts.pharmacist')
@section('title', 'Profile')
@section('content')
<div class="container">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light border-0 rounded-top-4 d-flex align-items-center py-3">
            <img src="{{ asset($pharmacist->profile_photo ?? 'images/default-avatar.png') }}" 
                 class="rounded-circle me-3 shadow-sm" width="80" height="80" style="object-fit: cover;">
            <div>
                <h4 class="fw-bold mb-0">{{ $pharmacist->first_name }} {{ $pharmacist->last_name }}</h4>
                <small class="text-muted">{{ $pharmacist->email }}</small>
            </div>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="p-3 bg-light rounded-3 h-100 shadow-sm">
                        <h6 class="fw-bold text-secondary mb-3"><i class="bi bi-person me-2"></i>Personal Info</h6>
                        <p class="mb-2"><strong>Full Name:</strong> {{ $pharmacist->first_name }} {{ $pharmacist->last_name }}</p>
                        <p class="mb-2"><strong>Gender:</strong> {{ ucfirst($pharmacist->gender ?? '—') }}</p>
                        <p class="mb-0"><strong>Date of Birth:</strong> {{ $pharmacist->date_of_birth?->format('M d, Y') ?? '—' }}</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="p-3 bg-light rounded-3 h-100 shadow-sm">
                        <h6 class="fw-bold text-secondary mb-3"><i class="bi bi-envelope me-2"></i>Contact</h6>
                        <p class="mb-2"><strong>Email:</strong> {{ $pharmacist->email }}</p>
                        <p class="mb-2"><strong>Phone:</strong> {{ $pharmacist->phone ?? '—' }}</p>
                        <p class="mb-0"><strong>Address:</strong> {{ $pharmacist->address ?? '—' }}</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="p-3 bg-light rounded-3 h-100 shadow-sm">
                        <h6 class="fw-bold text-secondary mb-3"><i class="bi bi-card-text me-2"></i>Professional</h6>
                        <p class="mb-2"><strong>License Number:</strong> {{ $pharmacist->license_number ?? '—' }}</p>
                        <p class="mb-2"><strong>Status:</strong> 
                            <span class="badge {{ $pharmacist->status ? 'bg-success' : 'bg-secondary' }}">
                                {{ $pharmacist->status ? 'Active' : 'Inactive' }}
                            </span>
                        </p>
                        <p class="mb-0"><strong>Joined At:</strong> {{ $pharmacist->created_at?->format('M d, Y') ?? '—' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
