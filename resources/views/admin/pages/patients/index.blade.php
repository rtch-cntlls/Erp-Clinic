@extends('layouts.admin')
@section('title', 'Patients')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold text-dark">
            <i class="bi bi-people-fill me-2"></i>Patients Management
        </h4>
    </div>
    <div class="row g-3 mb-3">
        @foreach ($cards as $card)
            <div class="col-md-4">
                <div class="card shadow-sm p-3 text-center">
                    <i class="bi {{ $card['icon'] }} fs-2 {{ $card['color'] }} mb-2"></i>
                    <h6 class="text-muted mb-1">{{ $card['title'] }}</h6>
                    <h4 class="fw-bold {{ $card['color'] }}">{{ $card['value'] }}</h4>
                </div>
            </div>
        @endforeach
    </div>    
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form method="GET" action="{{ route('admin.patients.index') }}">
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
                    <a class="dropdown-item" href="{{ route('admin.patients.export.csv') }}">
                        <i class="bi bi-filetype-csv me-2 text-success"></i>Export as CSV
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.patients.export.pdf') }}">
                        <i class="bi bi-file-earmark-pdf text-danger me-2"></i>Export as PDF
                    </a>
                </li>
            </ul>
        </div>
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
                                <td class="fw-semibold">{{ $patient->first_name }} {{ $patient->last_name }}</td>
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
