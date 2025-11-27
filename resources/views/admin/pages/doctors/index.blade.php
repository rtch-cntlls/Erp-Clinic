@extends('layouts.admin')
@section('title', 'Doctors')
@section('content')
<div class="container">
    <!-- Header & Stats -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">
            <i class="bi bi-person-badge me-2"></i> Doctors Management
        </h3>   
        <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary d-flex align-items-center">
            <i class="bi bi-plus-circle me-1"></i> Add Doctor
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="bi bi-person-lines-fill fs-2 text-primary mb-2"></i>
                <h6 class="text-muted mb-1">Total Doctors</h6>
                <h4 class="fw-bold">{{ $doctors->total() }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="bi bi-person-check fs-2 text-success mb-2"></i>
                <h6 class="text-muted mb-1">Active</h6>
                <h4 class="fw-bold text-success">{{ $doctors->where('status', 'active')->count() }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="bi bi-person-x fs-2 text-danger mb-2"></i>
                <h6 class="text-muted mb-1">Inactive</h6>
                <h4 class="fw-bold text-danger">{{ $doctors->where('status', 'inactive')->count() }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="bi bi-star fs-2 text-warning mb-2"></i>
                <h6 class="text-muted mb-1">Specializations</h6>
                <h4 class="fw-bold">{{ $doctors->pluck('specialization')->unique()->count() }}</h4>
            </div>
        </div>
    </div>

    <!-- Doctors Table -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            @if(session('success'))
                <div class="alert alert-success m-3">{{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Specialization</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($doctors as $doctor)
                        <tr>
                            <td>
                                @if($doctor->profile_image)
                                    <img src="{{ asset($doctor->profile_image) }}" width="50" class="rounded-circle">
                                @else
                                    <i class="bi bi-person-circle fs-3 text-muted"></i>
                                @endif
                            </td>
                            <td>{{ $doctor->name }}</td>
                            <td>{{ $doctor->email }}</td>
                            <td>{{ $doctor->phone }}</td>
                            <td>{{ $doctor->specialization }}</td>
                            <td>
                                @php
                                    $statusClass = $doctor->status == 'active' ? 'success' : 'danger';
                                @endphp
                                <span class="badge bg-{{ $statusClass }}">{{ ucfirst($doctor->status) }}</span>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#editDoctorModal{{ $doctor->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <form action="{{ route('admin.doctors.toggleStatus', $doctor->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $doctor->status == 'active' ? 'btn-danger' : 'btn-success' }}">
                                        @if($doctor->status == 'active')
                                            <i class="bi bi-person-x"></i> Deactivate
                                        @else
                                            <i class="bi bi-person-check"></i> Activate
                                        @endif
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @include('admin.pages.doctors.edit')
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="bi bi-exclamation-circle me-2"></i> No doctors found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="mt-3 d-flex justify-content-end">
        {{ $doctors->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
