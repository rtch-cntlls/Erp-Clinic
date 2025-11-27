@extends('layouts.admin')
@section('title', 'Patients')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="fw-bold text-dark"><i class="bi bi-people-fill me-2"></i>Patients Management</h3>
        <a href="{{ route('admin.patients.create') }}" class="btn btn-primary d-flex align-items-center">
            <i class="bi bi-plus-circle me-2"></i> Add Patient
        </a>
    </div>
    <div class="row g-3 mt-2">
        <div class="col-md-4">
            <div class="card shadow-sm p-3 text-center">
                <i class="bi bi-people-fill fs-2 text-secondary mb-2"></i>
                <h6 class="text-muted mb-1">Total Patients</h6>
                <h4 class="fw-bold">{{ $patients->total() }}</h4>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-3 text-center">
                <i class="bi bi-gender-male fs-2 text-primary mb-2"></i>
                <h6 class="text-muted mb-1">Male Patients</h6>
                <h4 class="fw-bold text-primary">{{ $patients->where('gender', 'male')->count() }}</h4>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-3 text-center">
                <i class="bi bi-gender-female fs-2 text-danger mb-2"></i>
                <h6 class="text-muted mb-1">Female Patients</h6>
                <h4 class="fw-bold text-danger">{{ $patients->where('gender', 'female')->count() }}</h4>
            </div>
        </div>
    <form method="GET" action="{{ route('admin.patients.index') }}" class="mb-4">
        <div class="input-group rounded-3 shadow-sm" style="overflow: hidden;">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control border-0" placeholder="Search by name, email, or phone">
            <button type="submit" class="btn btn-outline-secondary"><i class="bi bi-search me-1"></i> Search</button>
        </div>
    </form>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>DOB</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($patients as $patient)
                            <tr class="align-middle">
                                <td>{{ $patient->id }}</td>
                                <td class="fw-semibold">{{ $patient->first_name }} {{ $patient->last_name }}</td>
                                <td>{{ $patient->email ?? '-' }}</td>
                                <td>{{ $patient->phone ?? '-' }}</td>
                                <td>
                                    @if($patient->gender)
                                        <span class="badge bg-info text-dark">{{ ucfirst($patient->gender) }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $patient->dob ? $patient->dob->format('M. d, Y') : '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.patients.show', $patient->id) }}" class="btn btn-sm btn-primary" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="bi bi-exclamation-circle me-2"></i>No billing records found.
                            </td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="mt-4 d-flex justify-content-end">
        {{ $patients->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
    </div>
</div>
@endsection
