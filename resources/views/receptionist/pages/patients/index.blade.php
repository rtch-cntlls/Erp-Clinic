@extends('layouts.receptionist')
@section('title', 'Patients')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center  mb-4">
        <h4 class="fw-bold text-dark">
            <i class="bi bi-people-fill"></i> Patients Management
        </h4>
        <a href="{{ route('receptionist.patients.create') }}" class="btn btn-primary d-flex align-items-center">
            <i class="bi bi-plus-circle me-2"></i> Add Patient
        </a>
    </div>    
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form method="GET" action="{{ route('receptionist.patients.index') }}">
            <div class="input-group rounded-3 shadow-sm border" style="overflow: hidden; width: 500px;">
                <button type="submit" class="btn btn-outline-secondary border-0"><i class="bi bi-search me-1"></i> Search</button>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control border-0" placeholder="Search by name, email, or phone">
            </div>
        </form>
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="card shadow-sm">
        <div class="card-header">
            <h6 class="mb-0"><i class="bi bi-people-fill me-2"></i>Patients List</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
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
                                <td>{{ $patient->name }}</td>
                                <td>{{ $patient->email ?? '-' }}</td>
                                <td>{{ $patient->phone ?? '-' }}</td>
                                <td>
                                    @if($patient->gender)
                                        <span class="badge bg-primary">{{ ucfirst($patient->gender) }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $patient->dob ? $patient->dob->format('M. d, Y') : '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('receptionist.patients.show', $patient->id) }}" class="btn btn-sm btn-primary" title="View">
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
