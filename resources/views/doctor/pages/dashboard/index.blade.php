@extends('layouts.doctor')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <h3 class="fw-bold mb-4">Welcome, Dr. {{ $doctor->name }}</h3>
    <div class="row g-3 mb-4">
        @foreach($cards as $card)
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center">
                <h6 class="text-muted mb-2">{{ $card['title'] }}</h6>
                <h3 class="fw-bold">{{ $card['count'] }}</h3>
                <i class="bi {{ $card['icon'] }} fs-3 text-{{ $card['color'] }}"></i>
            </div>
        </div>
        @endforeach
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h6 class="mb-0"><i class="bi bi-calendar-week me-2"></i> Todays Appointments</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Patient</th>
                            <th>Time</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->patient->full_name }}</td>
                            <td>{{ $appointment->appointment_date->format('M. d, Y H:i') }}</td>
                            <td>{{ ucfirst($appointment->type) }}</td>
                            <td>
                                @if($appointment->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($appointment->status == 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($appointment->status) }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="" class="btn btn-sm btn-outline-primary">View</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No upcoming appointments</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $appointments->links() }}
            </div>            
        </div>
    </div>
</div>
@endsection
