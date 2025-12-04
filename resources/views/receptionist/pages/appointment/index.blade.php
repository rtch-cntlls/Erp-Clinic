@extends('layouts.receptionist')
@section('title', 'Appointments')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark"><i class="bi bi-calendar-check"></i> Today's Appointments & Queue</h4>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row g-4">
        <!-- Queue List -->
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="bi bi-list-ol me-2"></i>Queue</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($queue as $appt)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                #{{ $appt->queue_number }} - {{ $appt->patient?->name ?? $appt->user?->name ?? 'Pending Patient' }}
                                <span class="badge 
                                    @if($appt->status === 'Pending') bg-warning
                                    @elseif($appt->status === 'Scheduled') bg-info
                                    @elseif($appt->status === 'Completed') bg-success
                                    @elseif($appt->status === 'Cancelled') bg-danger
                                    @else bg-secondary @endif">
                                    {{ $appt->status }}
                                </span>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted">No appointments today</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Time Schedule -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="bi bi-clock-history me-2"></i>Time Schedule</h6>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Time</th>
                                <th>Patient</th>
                                <th>Doctor</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($appointments as $appt)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($appt->check_in_time)->format('H:i A') }}</td>
                                <td>{{ $appt->patient?->name ?? $appt->user?->name ?? 'Pending Patient' }}</td>
                                <td>{{ $appt->doctor?->name ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge 
                                        @if($appt->status === 'Pending') bg-warning
                                        @elseif($appt->status === 'Scheduled') bg-info
                                        @elseif($appt->status === 'Completed') bg-success
                                        @elseif($appt->status === 'Cancelled') bg-danger
                                        @else bg-secondary @endif">
                                        {{ $appt->status }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($appt->status === 'Pending')
                                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#approveModal{{ $appt->id }}">
                                            Approve
                                        </button>
                                        <div class="modal fade" id="approveModal{{ $appt->id }}" tabindex="-1" aria-labelledby="approveModalLabel{{ $appt->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form action="{{ route('receptionist.appointments.approve', $appt->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title" id="approveModalLabel{{ $appt->id }}">Approve Appointment</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="check_in_time{{ $appt->id }}" class="form-label">Check-In Time</label>
                                                                <input type="time" name="check_in_time" id="check_in_time{{ $appt->id }}" class="form-control">
                                                                <small class="text-muted">Optional: Set patient's check-in time</small>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer border-0">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-success">Approve</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No appointments today</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
