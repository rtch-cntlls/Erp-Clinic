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
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card shadow-sm">
        <div class="card-header">
            <h6 class="mb-0"><i class="bi bi-people-fill me-2"></i>Pharmacist List</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th width="160">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pharmacists as $ph)
                            <tr>
                                <td>{{ $ph->first_name }} {{ $ph->last_name }}</td>
                                <td>{{ $ph->email }}</td>
                                <td>{{ $ph->phone ?? '—' }}</td>
                                <td>
                                    @if($ph->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editPharmacistModal{{ $ph->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    @include('admin.pages.pharmacists.edit')
                                </td>
                            </tr>
                        @empty
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="bi bi-exclamation-circle me-2"></i>No Pharmacist records found.
                            </td>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $pharmacists->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
