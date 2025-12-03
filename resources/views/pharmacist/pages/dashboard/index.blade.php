@extends('layouts.pharmacist')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <h4 class="fw-bold mb-4">
        <i class="bi bi-house-door me-2"></i>Pharmacist Dashboard
    </h4>
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
    <div class="mb-5">
        <h5 class="fw-bold mb-3">Recent Inventory Items</h5>
        <div class="table-responsive shadow-sm border">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-light text-muted">
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Added On</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentInventory as $index => $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->category }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ $item->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mb-5">
        <h5 class="fw-bold mb-3">Recent Dispenses</h5>
        <div class="table-responsive shadow-sm border">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-light text-muted">
                    <tr>
                        <th>Dispensed By</th>
                        <th>Total Amount</th>
                        <th>Dispense Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentDispenses as $dispense)
                        <tr>
                            <td>{{ $dispense->admin->name ?? '-' }}</td>
                            <td>{{ number_format($dispense->total_amount, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($dispense->dispense_date)->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
