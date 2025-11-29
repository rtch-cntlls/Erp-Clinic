@extends('layouts.doctor')
@section('title', 'Profile')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h3 class="fw-bold">My Profile</h3>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
            <i class="bi bi-plus-circle me-1"></i> Add Schedule
        </button>
        @include('doctor.pages.profile.create')
    </div>
    <div class="card mb-4 shadow-sm">
        <div class="card-body d-flex flex-wrap align-items-center gap-3">
            <img src="{{ $doctor->profile_image ? asset($doctor->profile_image) : asset('images/default-doctor.png') }}" 
                 alt="{{ $doctor->name }}" class="rounded-circle" style="width:100px; height:100px; object-fit:cover;">
            <div class="flex-grow-1">
                <h4 class="fw-bold mb-1">{{ $doctor->name }}</h4>
                <div class="row">
                    <p class="col-6"><i class="bi bi-envelope-fill me-1"></i> {{ $doctor->email }}</p>
                    <p class="col-6"><i class="bi bi-telephone-fill me-1"></i> {{ $doctor->phone ?? 'N/A' }}</p>
                    <p class="col-6"><i class="bi bi-person-badge me-1"></i> {{ $doctor->specialization ?? 'N/A' }}</p>
                    <p class="col-6"><i class="bi bi-geo-alt-fill me-1"></i> {{ $doctor->address ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>
    <h5 class="mb-3">Schedule of Duty</h5>
    <div class="card shadow-sm mb-4">
        <div class="card-body p-0">
            @if($schedules->count())
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Day</th>
                            <th>From</th>
                            <th>To</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schedules as $schedule)
                        <tr>
                            <td>{{ $schedule->day }}</td>
                            <td>{{ \Carbon\Carbon::parse($schedule->from)->format('h:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($schedule->to)->format('h:i A') }}</td>
                        </tr>
                        @endforeach                        
                    </tbody>
                </table>
            </div>
            @else
                <p class="text-center text-muted my-3">No schedule set.</p>
            @endif
        </div>
    </div>
</div>
@endsection
