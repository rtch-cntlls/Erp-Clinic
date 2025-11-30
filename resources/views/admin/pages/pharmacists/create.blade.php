@extends('layouts.admin')
@section('title', 'Add Pharmacist')
@section('content')
<div class="container">
    <div class="d-flex align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">
            <i class="bi bi-person-plus me-2"></i> Add Pharmacist
        </h4>
    </div>
    <div class="create-patient">
        <div class="card-body">
            <form action="{{ route('admin.pharmacists.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">First Name</label>
                        <input type="text" name="first_name" class="form-control" placeholder="Enter first name" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Last Name</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Enter last name" required>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-4">
                        <label class="form-label small fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="example@example.com" required>
                    </div>
                    <div class="col-4">
                        <label class="form-label small fw-semibold">Phone <span class="text-muted">(Optional)</span></label>
                        <input type="text" name="phone" class="form-control" placeholder="e.g. +63 912 345 6789">
                    </div>
                    <div class="col-4">
                        <label class="form-label small fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password" required minlength="6">
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-sm px-4">
                        <i class="bi bi-check-circle me-1"></i> Save
                    </button>
                    <a href="{{ route('admin.pharmacists.index') }}" class="btn btn-outline-secondary btn-sm px-4">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
