@extends('layouts.admin')
@section('title', 'Doctor Details')
@section('content')
<div>
    <div class="d-flex gap-2 align-items-center mb-4">
        <a href="{{ route('admin.doctors.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left-circle me-1"></i> Back
        </a>
        <h4 class="fw-bold mb-0">Doctor Details</h4>
    </div>
    <div class="">
        <div class="row g-4">
            <div class="col-md-3 text-center">
                @if($doctor->profile_image)
                    <img src="{{ asset($doctor->profile_image) }}" alt="Doctor Image" class="img-fluid rounded-circle border mb-3" style="width:150px;height:150px;object-fit:cover;">
                @else
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3" style="width:150px;height:150px;">
                        <i class="bi bi-person text-muted fs-1"></i>
                    </div>
                @endif
                <h5 class="fw-bold">{{ $doctor->first_name }} {{ $doctor->last_name }}</h5>
                <span class="badge rounded-pill {{ $doctor->status=='active' ? 'bg-success' : 'bg-secondary' }}">
                    {{ ucfirst($doctor->status) }}
                </span>
            </div>
            <div class="col-md-9">
                <div class="row g-3">
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Email</p>
                        <h6>{{ $doctor->email }}</h6>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Phone</p>
                        <h6>{{ $doctor->phone ?? 'N/A' }}</h6>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Gender</p>
                        <h6>{{ ucfirst($doctor->gender) ?? 'N/A' }}</h6>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Birthdate</p>
                        <h6>{{ $doctor->birthdate ? \Carbon\Carbon::parse($doctor->birthdate)->format('M d, Y') : 'N/A' }}</h6>
                    </div>
                    <div class="col-md-4">
                        <p class="text-muted mb-1">License No.</p>
                        <h6>{{ $doctor->license_no }}</h6>
                    </div>
                    <div class="col-md-4">
                        <p class="text-muted mb-1">PTR No.</p>
                        <h6>{{ $doctor->ptr_no ?? 'N/A' }}</h6>
                    </div>
                    <div class="col-md-4">
                        <p class="text-muted mb-1">S2 No.</p>
                        <h6>{{ $doctor->s2_no ?? 'N/A' }}</h6>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Specialization</p>
                        <h6>{{ $doctor->specialization }}</h6>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Sub Specialization</p>
                        <h6>{{ $doctor->sub_specialization ?? 'N/A' }}</h6>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Department</p>
                        <h6>{{ $doctor->department ?? 'N/A' }}</h6>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Years of Experience</p>
                        <h6>{{ $doctor->years_experience }} yrs</h6>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Consultation Fee</p>
                        <h6>₱{{ number_format($doctor->consultation_fee, 2) }}</h6>
                    </div>
                    <div class="col-md-12">
                        <p class="text-muted mb-1">Address</p>
                        <h6>{{ $doctor->address ?? 'N/A' }}</h6>
                    </div>
                    <div class="col-md-12">
                        <p class="text-muted mb-1">Bio</p>
                        <h6>{{ $doctor->bio ?? 'N/A' }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
