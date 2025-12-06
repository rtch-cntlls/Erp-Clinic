@extends('layouts.admin')
@section('title', 'Doctors')
@section('content')
@include('components.sweetAlert')
<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="m-0 fw-bold text-dark">
            <i class="bi bi-person-badge me-2"></i>Doctors Management
        </h4>   
        <a href="{{ route('admin.doctors.create') }}" class="btn btn-outline-primary d-flex align-items-center">
            <i class="bi bi-plus-circle me-1"></i> Add Doctor
        </a>
    </div>
    <div class="row g-4 mb-4">
        @foreach($cards as $card)
            <div class="col-md-3">
                <div class="card border-0 shadow-sm p-3 transition-hover">
                    <div class="d-flex align-items-center mb-3 gap-3">
                        <div class="icon-wrapper">
                            <i class="bi {{ $card['icon'] }} {{ $card['color'] }}"></i>
                        </div>
                        <h6 class="mb-0 text-uppercase fw-bold">{{ $card['title'] }}</h6>
                    </div>
                    <div class="d-flex align-items-end justify-content-between">
                        <h4 class="fw-bold mb-0">{{ $card['value'] }}</h4>
                        <div class="bar-chart d-flex align-items-end gap-1">
                            <div class="bar" style="height: 80%"></div>
                            <div class="bar" style="height: 60%"></div>
                            <div class="bar" style="height: 70%"></div>
                            <div class="bar" style="height: 90%"></div>
                        </div>
                    </div>                    
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form method="GET" action="{{ route('admin.doctors.index') }}">
            <div class="input-group rounded-3 shadow-sm border" style="overflow: hidden; width: 500px;">
                <button type="submit" class="btn btn-outline-secondary border-0"><i class="bi bi-search me-1"></i> Search</button>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control border-0" placeholder="Search by name, email, or phone">
            </div>
        </form>
        <div class="dropdown">
            <button class="btn btn-outline-danger btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="bi bi-download me-1"></i> Export
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item small" href="{{ route('admin.doctors.export.csv') }}">
                        <i class="bi bi-filetype-csv me-2 text-success"></i>Export as CSV
                    </a>
                </li>
                <li>
                    <a class="dropdown-item small" href="{{ route('admin.doctors.export.pdf') }}">
                        <i class="bi bi-file-earmark-pdf text-danger me-2"></i>Export as PDF
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card border-0 shadow-sm bg-white">
        <div class="card-header bg-white">
            <h6 class="mb-0 fw-bold"><i class="bi bi-person me-2"></i>Doctors List</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-white border-bottom">
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
                            <td>{{ $doctor->full_name }}</td>
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
                                <button type="button" class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editDoctorModal{{ $doctor->id }}">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </button>
                                <a href="{{ route('admin.doctors.show', $doctor->id) }}" class="btn btn-sm btn-outline-success me-1">
                                    <i class="bi bi-eye me-1"></i> View
                                </a>
                                <form action="{{ route('admin.doctors.toggleStatus', $doctor->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $doctor->status == 'active' ? 'btn-outline-danger' : 'btn-outline-success' }}">
                                        @if($doctor->status == 'active')
                                            <i class="bi bi-person-x me-1"></i> Deactivate
                                        @else
                                            <i class="bi bi-person-check me-1"></i> Activate
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
        <div class="mt-3 px-3">
            {{ $doctors->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
