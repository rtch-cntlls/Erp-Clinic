@extends('layouts.cashier')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <h4 class="fw-bold mb-4"> <i class="bi bi-house-door me-2"></i>Cashier Dashboard</h4>
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
</div>
@endsection
