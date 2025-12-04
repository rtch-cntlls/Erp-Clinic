@extends('layouts.patient')
@section('title', 'My Appointments')
@section('content')
<div class="container" style="margin-top:100px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">My Appointments</h3>
    </div>
    @if($appointments->isEmpty())
        <div class="text-center py-5">
            <img src="{{ asset('images/empty-appointments.svg') }}" 
                 class="img-fluid mb-3" style="max-width:200px;" alt="">
            <h4 class="fw-semibold">No Appointments Yet</h4>
            <p class="text-muted">Book your first appointment to get started.</p>
        </div>
    @else
        <div class="row g-3">
            @foreach($appointments as $a)
            <div class="col-12">
                <div class="card p-3">
                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                        <div class="d-flex align-items-center">
                            <img src="{{ $a->doctor->profile_image ? asset( $a->doctor->profile_image)
                                : asset('images/doctor-default.png') }}" class="rounded-circle me-3 shadow-sm"
                                width="65" height="65" style="object-fit:cover;">
                            <div>
                                <h5 class="fw-bold mb-1">{{ $a->doctor->name ?? 'Unknown Doctor' }}</h5>
                                <span class="text-muted small d-block">
                                    {{ $a->doctor->specialization ?? 'General Practitioner' }}
                                </span>
                                <span class="text-muted small d-block mt-1">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    {{ \Carbon\Carbon::parse($a->appointment_date)->format('M d, Y') }}
                                    @if(in_array(strtolower($a->status), ['scheduled', 'checked-in', 'completed']) && $a->check_in_time)
                                        at {{ \Carbon\Carbon::parse($a->check_in_time)->format('H:i A') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="mt-3 mt-md-0">
                            @php
                                $statusColors = [
                                    'booked'     => 'primary',
                                    'checked-in' => 'warning',
                                    'completed'  => 'success',
                                    'cancelled'  => 'danger',
                                    'scheduled'  => 'info',
                                ];
                                $badge = $statusColors[strtolower($a->status)] ?? 'danger';
                            @endphp

                            <span class="badge bg-{{ $badge }} px-3 py-2 rounded-pill">
                                <i class="bi bi-circle-fill me-1 small"></i>
                                {{ ucfirst($a->status) }}
                            </span>

                        </div>
                    </div>
                    <hr class="my-3">
                    <div class="row small text-muted">
                        <div class="col-md-4 mb-2">
                            <i class="bi bi-clipboard2-plus me-1"></i>
                            Type: <strong class="text-dark">{{ ucfirst($a->type) }}</strong>
                        </div>

                        @if($a->reason)
                        <div class="col-md-8 mb-2">
                            <i class="bi bi-chat-left-text me-1"></i>
                            Reason: <strong class="text-dark">{{ $a->reason }}</strong>
                        </div>
                        @endif
                        @if($a->is_first_visit)
                        <div class="col-12 mt-2">
                            <span class="badge bg-dark rounded-pill">
                                <i class="bi bi-star-fill me-1"></i> First Visit
                            </span>
                        </div>
                        @endif
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        @if(strtolower($a->status) !== 'cancelled' && strtolower($a->status) !== 'completed')
                            <form method="POST" action="{{ route('patient.appointments.cancel', $a->id) }}"
                                onsubmit="return confirm('Are you sure you want to cancel this appointment?')">
                                @csrf
                                <button class="btn btn-outline-danger rounded-pill px-4">
                                    <i class="bi bi-x-circle me-1"></i> Cancel
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
