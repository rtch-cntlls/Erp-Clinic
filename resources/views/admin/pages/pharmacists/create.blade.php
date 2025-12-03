@extends('layouts.admin')
@section('title', 'Add Pharmacist')
@section('content')
<div class="container create-patient">
    <div class=" shadow-sm border-0 rounded-4">
        <div class="card-body">
            <form action="{{ route('admin.pharmacists.store') }}" method="POST" 
                  enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h4 class="fw-bold text-dark mb-0">
                        <i class="bi bi-person-plus me-2"></i> Add Pharmacist
                    </h4>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-sm px-4 rounded-pill">
                            <i class="bi bi-check-circle me-1"></i> Save
                        </button>
                        <a href="{{ route('admin.pharmacists.index') }}" 
                           class="btn btn-outline-secondary btn-sm px-4 rounded-pill">
                            Cancel
                        </a>
                    </div>
                </div>
                <h6 class="fw-bold text-primary mb-3">Basic Information</h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">First Name</label>
                        <input type="text" name="first_name" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Last Name</label>
                        <input type="text" name="last_name" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-semibold">Phone</label>
                        <input type="text" name="phone" class="form-control" placeholder="Optional">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control" required minlength="6">
                    </div>
                </div>
                <h6 class="fw-bold text-primary mb-3">Profile Details</h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label small fw-semibold">Profile Photo</label>
                        <input type="file" name="profile_photo" class="form-control" accept="image/*">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-semibold">Gender</label>
                        <select name="gender" class="form-select">
                            <option value="" selected>Select gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-semibold">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control">
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-semibold">Address</label>
                        <textarea name="address" class="form-control" rows="2" placeholder="Enter address..."></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">License Number (PRC)</label>
                        <input type="text" name="license_number" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Status</label>
                        <select name="status" class="form-select">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
