@extends('layouts.admin')
@section('title', 'Receptionists')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-dark">
            <i class="bi bi-person-lines-fill me-2"></i> Receptionists Management
        </h4>
        <button class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#createReceptionistModal">
            <i class="bi bi-plus-circle me-1"></i> Add Receptionist
        </button>
        @include('admin.pages.receptionists.create')
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
    <div class="card">
        <div class="card-header">
            <h6 class="mb-0"><i class="bi bi-people-fill me-2"></i> Receptionist List</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($receptionists as $rec)
                        <tr>
                            <td>{{ $rec->name }}</td>
                            <td>{{ $rec->email }}</td>
                            <td>{{ $rec->phone ?? '—' }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editReceptionistModal{{ $rec->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                @include('admin.pages.receptionists.edit')
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="bi bi-exclamation-circle me-2"></i>No Receptionist records found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
