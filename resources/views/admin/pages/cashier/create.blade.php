@extends('layouts.admin')
@section('title', 'Add Cashier')
@section('content')
@include('components.sweetAlert')
<form action="{{ isset($cashier) ? route('admin.cashiers.update', $cashier->id) : route('admin.cashiers.store') }}" 
    method="POST" enctype="multipart/form-data">
    @csrf
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('admin.cashiers.index') }}" class="btn btn-secondary btn-sm btn-pill">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
            </a>
            <h4 class="fw-bold mb-0">
                <i class="bi bi-person-badge me-2"></i>Add Cashier
            </h4>
        </div>
        <button class="btn btn-success btn-sm btn-pill">
            <i class="bi bi-check-circle me-1"></i>
            Add New Cashier
        </button>
    </div>
    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" name="first_name" class="form-control" required
                        value="{{ old('first_name', $cashier->first_name ?? '') }}" placeholder="First Name">
                <label>First Name</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" name="last_name" class="form-control" required
                        value="{{ old('last_name', $cashier->last_name ?? '') }}" placeholder="Last Name">
                <label>Last Name</label>
            </div>
        </div>
    </div>
    <div class="row g-3 mb-3">
        <div class="col-md-4">
            <div class="form-floating">
                <input type="email" name="email" class="form-control"
                        value="{{ old('email', $cashier->email ?? '') }}" placeholder="Email">
                <label>Email</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input type="text" name="phone" class="form-control"
                        value="{{ old('phone', $cashier->phone ?? '') }}" placeholder="Phone">
                <label>Phone</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input type="text" name="address" class="form-control"
                        value="{{ old('address', $cashier->address ?? '') }}" placeholder="Address">
                <label>Address</label>
            </div>
        </div>
    </div>
    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <div class="form-floating">
                <input type="date" name="date_hired" class="form-control"
                        value="{{ old('date_hired', $cashier->date_hired ?? '') }}" placeholder="Date Hired">
                <label>Date Hired</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <select name="shift" class="form-select">
                    <option value="">Select Shift</option>
                    <option value="morning" {{ old('shift', $cashier->shift ?? '') == 'morning' ? 'selected' : '' }}>Morning</option>
                    <option value="afternoon" {{ old('shift', $cashier->shift ?? '') == 'afternoon' ? 'selected' : '' }}>Afternoon</option>
                    <option value="night" {{ old('shift', $cashier->shift ?? '') == 'night' ? 'selected' : '' }}>Night</option>
                </select>
                <label>Shift</label>
            </div>
        </div>
    </div>
    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <div class="form-floating">
                <input type="number" step="0.01" name="float_amount" class="form-control"
                        value="{{ old('float_amount', $cashier->float_amount ?? '') }}" placeholder="Float Amount">
                <label>Float Amount</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input type="file" name="profile_image" class="form-control">
                <label>Profile Image</label>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <div class="form-floating">
            <textarea name="notes" class="form-control" style="height:100px" placeholder="Notes">{{ old('notes', $cashier->notes ?? '') }}</textarea>
            <label>Notes</label>
        </div>
    </div>
</form>
@endsection
