@extends('layouts.admin')
@section('title', 'Appointments')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">
            <i class="bi bi-calendar-check me-2"></i> Appointments Management
        </h3>        
    </div>
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="bi bi-calendar-check fs-2 text-primary mb-2"></i>
                <h6 class="text-muted mb-1">Total Appointments</h6>
                <h4 class="fw-bold">{{ $appointments->total() }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="bi bi-hourglass-split fs-2 text-warning mb-2"></i>
                <h6 class="text-muted mb-1">Pending</h6>
                <h4 class="fw-bold text-warning">{{ $appointments->where('status', 'Pending')->count() }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="bi bi-check-circle fs-2 text-success mb-2"></i>
                <h6 class="text-muted mb-1">Completed</h6>
                <h4 class="fw-bold text-success">{{ $appointments->where('status', 'Completed')->count() }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <i class="bi bi-calendar-day fs-2 text-info mb-2"></i>
                <h6 class="text-muted mb-1">Today</h6>
                <h4 class="fw-bold text-info">{{ $appointments->where('appointment_date', now()->format('Y-m-d'))->count() }}</h4>
            </div>
        </div>
    </div>
    <div class="card shadow-sm">
        <div class="card-body p-0">
            @if(session('success'))
                <div class="alert alert-success m-3">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th></th>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->id }}</td>
                            <td>{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</td>
                            <td>{{ $appointment->doctor?->name ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M, Y h:i A') }}</td>
                            <td>
                                @php
                                    $statusClass = match($appointment->status){
                                        'Completed' => 'success',
                                        'Pending' => 'warning',
                                        'Cancelled' => 'danger',
                                        default => 'secondary',
                                    };
                                @endphp
                                <span class="badge bg-{{ $statusClass }}">{{ $appointment->status }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.appointments.edit', $appointment->id) }}" class="btn btn-sm btn-outline-warning me-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this appointment?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-exclamation-circle me-2"></i> No appointments found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-3 d-flex justify-content-end">
        {{ $appointments->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection
