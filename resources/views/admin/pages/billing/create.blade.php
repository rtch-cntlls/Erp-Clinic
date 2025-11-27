@extends('layouts.admin')
@section('title', 'Create Billing')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">
            <i class="bi bi-receipt me-2"></i> New Billing Record
        </h3>
        <a href="{{ route('admin.billing.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
    @if($errors->any())
        <div class="alert alert-danger rounded-3">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card shadow-sm rounded-4 border-0">
        <div class="card-body p-4">
            <form action="{{ route('admin.billing.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Patient</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-person"></i>
                            </span>
                            <select name="patient_id" class="form-select" required>
                                <option value="">-- Select Patient --</option>
                                @foreach ($patients as $p)
                                    <option value="{{ $p->id }}">{{ $p->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Appointment (optional)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-calendar-event"></i>
                            </span>
                            <select name="appointment_id" class="form-select">
                                <option value="">-- None --</option>
                                @foreach ($appointments as $a)
                                    <option value="{{ $a->id }}">
                                        Appointment #{{ $a->id }} ({{ $a->date }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Amount</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                ₱
                            </span>
                            <input type="number" step="0.01" name="amount" class="form-control" placeholder="0.00" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Payment Method</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-credit-card"></i>
                            </span>
                            <select name="payment_method" class="form-select">
                                <option value="">-- Select Method --</option>
                                <option value="cash">Cash</option>
                                <option value="gcash">GCash</option>
                                <option value="bank">Bank Transfer</option>
                                <option value="insurance">Insurance</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Notes</label>
                        <textarea name="notes" rows="3" class="form-control" placeholder="Optional notes..."></textarea>
                    </div>

                </div>
                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary px-4">
                        <i class="bi bi-check-circle me-1"></i> Create Bill
                    </button>
                    <a href="{{ route('admin.billing.index') }}" class="btn btn-secondary px-4">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
