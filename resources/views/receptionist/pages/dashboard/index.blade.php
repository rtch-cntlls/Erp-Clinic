@extends('layouts.receptionist')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center  mb-4">
        <h4 class="fw-bold">
            <i class="bi bi-house"></i> Receptionist Dashboard
        </h4>
        <a href="{{ route('receptionist.patients.create') }}" class="btn btn-primary d-flex align-items-center">
            <i class="bi bi-plus-circle me-2"></i> Add Patient
        </a>
    </div>
    <div class="row g-3 mb-4">
        @foreach($cards as $card)
            <div class="col-md-3">
                <div class="card shadow-sm p-3 text-center">
                    <i class="bi {{ $card['icon'] }} fs-2 {{ $card['color'] }} mb-2"></i>
                    <h6 class="text-muted mb-1">{{ $card['title'] }}</h6>
                    <h4 class="fw-bold">{{ $card['value'] }}</h4>
                </div>
            </div>
        @endforeach
    </div>
    <div class="card shadow-sm rounded-4 border-0 mt-4">
        <div class="card-body py-4">
            <h5 class="fw-bold mb-1">
                Welcome, {{ auth()->guard('receptionist')->user()->name }}!
            </h5>
            <p class="text-muted mb-0">
                Manage patients, appointments, and the clinic queue efficiently.
            </p>
        </div>
    </div>

</div>

@endsection
