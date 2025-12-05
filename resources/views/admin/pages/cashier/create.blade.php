@extends('layouts.admin')
@section('title', isset($cashier) ? 'Edit Cashier' : 'Add Cashier')
@section('content')
<div class="container">
    <div class="">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">
                <i class="bi bi-person-badge me-2"></i> {{ isset($cashier) ? 'Edit Cashier' : 'Add Cashier' }}
            </h4>
            <a href="{{ route('admin.cashiers.index') }}" class="btn btn-secondary btn-pill">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
            </a>
        </div>
        <form action="{{ isset($cashier) ? route('admin.cashiers.update', $cashier->id) : route('admin.cashiers.store') }}" method="POST">
            @csrf
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" value="{{ old('first_name', $cashier->first_name ?? '') }}" required>
                        <label for="first_name">First Name</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" name="middle_name" class="form-control" id="middle_name" placeholder="Middle Name" value="{{ old('middle_name', $cashier->middle_name ?? '') }}">
                        <label for="middle_name">Middle Name</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" value="{{ old('last_name', $cashier->last_name ?? '') }}" required>
                        <label for="last_name">Last Name</label>
                    </div>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email', $cashier->email ?? '') }}">
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" value="{{ old('phone', $cashier->phone ?? '') }}">
                        <label for="phone">Phone</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" name="address" class="form-control" id="address" placeholder="Address" value="{{ old('address', $cashier->address ?? '') }}">
                        <label for="address">Address</label>
                    </div>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="date" name="date_hired" class="form-control" id="date_hired" placeholder="Date Hired" value="{{ old('date_hired', $cashier->date_hired ?? '') }}">
                        <label for="date_hired">Date Hired</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <select name="shift" class="form-select" id="shift">
                            <option value="">Select Shift</option>
                            <option value="morning" {{ (old('shift', $cashier->shift ?? '') == 'morning') ? 'selected' : '' }}>Morning</option>
                            <option value="afternoon" {{ (old('shift', $cashier->shift ?? '') == 'afternoon') ? 'selected' : '' }}>Afternoon</option>
                            <option value="night" {{ (old('shift', $cashier->shift ?? '') == 'night') ? 'selected' : '' }}>Night</option>
                        </select>
                        <label for="shift">Shift</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <select name="status" class="form-select" id="status" required>
                            <option value="active" {{ (old('status', $cashier->status ?? '') == 'active') ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ (old('status', $cashier->status ?? '') == 'inactive') ? 'selected' : '' }}>Inactive</option>
                            <option value="terminated" {{ (old('status', $cashier->status ?? '') == 'terminated') ? 'selected' : '' }}>Terminated</option>
                        </select>
                        <label for="status">Status</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <textarea name="notes" class="form-control" placeholder="Notes" id="notes" style="height:100px">{{ old('notes', $cashier->notes ?? '') }}</textarea>
                    <label for="notes">Notes</label>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success btn-pill">
                    <i class="bi bi-check-circle me-1"></i> {{ isset($cashier) ? 'Update' : 'Create' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
