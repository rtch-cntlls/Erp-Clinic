@extends('layouts.admin')
@section('title', 'Add Doctor')
@section('content')
<div class="container create-patient">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h4 class="fw-bold mb-0"><i class="bi bi-person-plus me-2"></i> Add Doctor</h4>
        <a href="{{ route('admin.doctors.index') }}" class="btn btn-outline-secondary btn-sm me-2">
            <i class="bi bi-arrow-left-circle me-1"></i> Back
        </a>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger rounded-4 shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="">
        <div class="card-body">
            <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label small fw-bold">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="Doctor Name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label small fw-bold">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="doctor@example.com" required>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label small fw-bold">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form-control" placeholder="Optional">
                    </div>
                    <div class="col-md-6">
                        <label for="specialization" class="form-label small fw-bold">Specialization</label>
                        <input type="text" name="specialization" id="specialization" value="{{ old('specialization') }}" class="form-control" placeholder="e.g., Cardiologist">
                    </div>
                    <div class="col-md-12">
                        <label for="address" class="form-label small fw-bold">Address</label>
                        <textarea name="address" id="address" class="form-control" rows="3" placeholder="Optional">{{ old('address') }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="profile_image" class="form-label small fw-bold">Profile Image</label>
                        <input type="file" name="profile_image" id="profile_image" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="form-label small fw-bold">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary d-flex align-items-center">
                        <i class="bi bi-check2-circle me-1"></i> Save Doctor
                    </button>
                    <a href="{{ route('admin.doctors.index') }}" class="btn btn-secondary d-flex align-items-center">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
