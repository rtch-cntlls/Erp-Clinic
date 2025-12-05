@extends('layouts.admin')

@section('title', 'Cashiers')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h4 class="fw-bold text-dark">
            <i class="bi bi-person-badge me-2"></i> Cashiers Management
        </h4>   
        <a href="{{ route('admin.cashiers.create') }}" class="btn btn-primary d-flex align-items-center">
            <i class="bi bi-plus-circle me-1"></i> Add Cashier
        </a>
    </div>

    {{-- Optional: summary cards (like Doctors) --}}
    @if(isset($cards))
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
    @endif

    <div class="card shadow-sm">
        <div class="card-header">
            <h6 class="mb-0"><i class="bi bi-person-badge me-2"></i>Cashiers List</h6>
        </div>
        <div class="card-body p-0">
            @if(session('success'))
                <div class="alert alert-success m-3">{{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Shift</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cashiers as $cashier)
                        <tr>
                            <td>{{ $cashier->full_name }}</td>
                            <td>{{ $cashier->email }}</td>
                            <td>{{ $cashier->phone }}</td>
                            <td>{{ ucfirst($cashier->shift) ?? '-' }}</td>
                            <td>
                                @php
                                    $statusClass = $cashier->status == 'active' ? 'success' : 'danger';
                                @endphp
                                <span class="badge bg-{{ $statusClass }}">{{ ucfirst($cashier->status) }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.cashiers.create', $cashier->id) }}" class="btn btn-sm btn-primary me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.cashiers.toggleStatus', $cashier->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    <button class="btn btn-sm {{ $cashier->status == 'active' ? 'btn-danger' : 'btn-success' }}">
                                        @if($cashier->status == 'active')
                                            <i class="bi bi-person-x"></i> Deactivate
                                        @else
                                            <i class="bi bi-person-check"></i> Activate
                                        @endif
                                    </button>
                                </form>                                
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-exclamation-circle me-2"></i> No cashiers found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-end">
        {{ $cashiers->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
