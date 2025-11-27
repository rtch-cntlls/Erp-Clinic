@extends('layouts.admin')
@section('title', 'Patients')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Patients Management</h4>
        <a href="{{ route('admin.patients.create') }}" class="btn btn-primary d-flex align-items-center">
            <i class="bi bi-plus-circle me-2"></i> Add Patient
        </a>
    </div>
    <form method="GET" action="{{ route('admin.patients.index') }}" class="mb-4">
        <div class="input-group shadow-sm">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by name, email, or phone">
            <button type="submit" class="btn btn-outline-secondary"><i class="bi bi-search"></i> Search</button>
        </div>
    </form>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="card shadow-sm rounded-4">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
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
                        <tr>
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
                            <td>{{ $patient->dob ? $patient->dob->format('d M, Y') : '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.patients.show', $patient->id) }}" class="btn btn-sm btn-outline-info me-1" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.patients.edit', $patient->id) }}" class="btn btn-sm btn-outline-warning me-1" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No patients found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4 d-flex justify-content-end">
        {{ $patients->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
