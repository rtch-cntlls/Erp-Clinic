@extends('layouts.admin')
@section('title', 'Pharmacists')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-dark">
            <i class="bi bi-person-workspace me-2"></i> Pharmacists Management
        </h4>
        <a href="{{ route('admin.pharmacists.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Pharmacist
        </a>
    </div>
    <div class="row g-3 mb-4">
        @foreach($cards as $card)
            <div class="col-md-4">
                <div class="card shadow-sm p-3 text-center">
                    <i class="bi {{ $card['icon'] }} fs-2 {{ $card['color'] }} mb-2"></i>
                    <h6 class="text-muted mb-1">{{ $card['title'] }}</h6>
                    <h4 class="fw-bold">{{ $card['value'] }}</h4>
                </div>
            </div>
        @endforeach
    </div> 
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <form method="GET" class="d-flex flex-wrap gap-2 align-items-center flex-grow-1">
            <div class="position-relative flex-grow-1" style="min-width: 200px;">
                <i class="bi bi-search position-absolute" 
                   style="top: 50%; left: 12px; transform: translateY(-50%); color:#6c757d;"></i>
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="form-control ps-5 form-control-sm" placeholder="Search by name or email">
            </div>
            <div class="position-relative" style="min-width: 150px;">
                <i class="bi bi-filter position-absolute" 
                   style="top: 50%; left: 12px; transform: translateY(-50%); color:#6c757d;"></i>
                <select name="status" class="form-select ps-5  form-select-sm">
                    <option value="">All Statuses</option>
                    <option value="1" {{ request('status')==='1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('status')==='0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-sm btn-dark d-flex align-items-center">
                <i class="bi bi-funnel-fill me-1"></i> Filter
            </button>
        </form>
        <div class="dropdown">
            <button class="btn btn-outline-danger btn-sm dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                <i class="bi bi-download me-1"></i> Export
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.pharmacists.exportCsv') }}">
                        <i class="bi bi-filetype-csv me-2 text-success"></i> Export as CSV
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.pharmacists.exportPdf') }}">
                        <i class="bi bi-file-earmark-pdf me-2 text-danger"></i> Export as PDF
                    </a>
                </li>
            </ul>
        </div>
    </div>    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card shadow-sm">
        <div class="card-header">
            <h6 class="mb-0"><i class="bi bi-people-fill me-2"></i>Pharmacist List</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>DOB</th>
                            <th>Status</th>
                            <th width="180">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pharmacists as $ph)
                        <tr>
                            <td>
                                <button type="button" class="btn p-0 border-0" data-bs-toggle="modal" data-bs-target="#showPharmacistModal{{ $ph->id }}">
                                    <img src="{{ asset($ph->profile_photo ?? 'images/default-avatar.png') }}" width="50" class="rounded-circle">
                                </button>
                                @include('admin.pages.pharmacists.show')
                            </td>                            
                            <td>{{ $ph->first_name }} {{ $ph->last_name }}</td>
                            <td>{{ $ph->email }}</td>
                            <td>{{ $ph->phone ?? '—' }}</td>
                            <td>{{ ucfirst($ph->gender ?? '—') }}</td>
                            <td>{{ $ph->date_of_birth?->format('M d, Y') ?? '—' }}</td>
                            <td>
                                @if($ph->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editPharmacistModal{{ $ph->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <form  action="{{ route('admin.pharmacists.toggleStatus', $ph->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" 
                                            class="btn btn-sm {{ $ph->status ? 'btn-outline-danger' : 'btn-outline-success' }}">
                                        {{ $ph->status ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>
                                @include('admin.pages.pharmacists.edit')
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                <i class="bi bi-exclamation-circle me-2"></i>No Pharmacist records found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3 px-3">
                {{ $pharmacists->links('pagination::bootstrap-5') }}
            </div>            
        </div>
    </div>
</div>
@endsection
