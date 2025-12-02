@extends('layouts.receptionist')
@section('title', 'Add Patient')
@section('content')
<div class="container create-patient">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="">
        <div class="card-body">
            <form action="{{ route('admin.patients.store') }}" method="POST">
                @csrf
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('receptionist.patients.index') }}" class="btn btn-outline-secondary btn-sm me-2">
                            <i class="bi bi-arrow-left-circle me-1"></i> Back
                        </a>
                        <h4 class="mb-0 fw-bold">Add New Patient</h4>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center">
                        <i class="bi bi-person-plus me-1"></i> Save Patient
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="first_name" class="form-label fw-bold small">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter first name" value="{{ old('first_name') }}" required>
                        <small  class="text-muted" style="font-size: 12px;">Patient's given name.</small>
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label fw-bold small">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter last name" value="{{ old('last_name') }}" required>
                        <small  class="text-muted" style="font-size: 12px;">Patient's family name.</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="email" class="form-label fw-bold small">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}">
                        <small  class="text-muted" style="font-size: 12px;">Optional, used for notifications if available.</small>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label fw-bold small">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter phone number" value="{{ old('phone') }}">
                        <small  class="text-muted" style="font-size: 12px;">Optional, e.g., +63 912 345 6789.</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="dob" class="form-label fw-bold small">Date of Birth</label>
                        <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob') }}">
                        <small  class="text-muted" style="font-size: 12px;">Patient's date of birth.</small>
                    </div>
                    <div class="col-md-4">
                        <label for="gender" class="form-label fw-bold small">Gender</label>
                        <select name="gender" id="gender" class="form-select">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        <small  class="text-muted" style="font-size: 12px;">Optional, helps with patient categorization.</small>
                    </div>

                    <div class="col-md-4">
                        <label for="blood_group" class="form-label fw-bold small">Blood Group</label>
                        <input type="text" name="blood_group" id="blood_group" class="form-control" placeholder="e.g., O+, A-" value="{{ old('blood_group') }}">
                        <small  class="text-muted" style="font-size: 12px;">Optional, important for medical emergencies.</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="emergency_contact" class="form-label fw-bold small">Emergency Contact</label>
                        <input type="text" name="emergency_contact" id="emergency_contact" placeholder="Patient emergency contact" class="form-control" value="{{ old('emergency_contact') }}">
                        <small class="text-muted" style="font-size: 12px;">Optional, in case of emergencies.</small>
                    </div>
                    <div class="col-6">
                        <label for="insurance" class="form-label fw-bold small">Insurance</label>
                        <input type="text" name="insurance" id="insurance" class="form-control" placeholder="Insurance provider" value="{{ old('insurance') }}">
                        <small class="text-muted" style="font-size: 12px;">Optional, patient's insurance provider.</small>
                    </div>
                </div>
                <div class="">
                    <label for="address" class="form-label fw-bold small">Address</label>
                    <textarea name="address" id="address" rows="2" class="form-control" placeholder="Enter patient address">{{ old('address') }}</textarea>
                    <small  class="text-muted" style="font-size: 12px;">Optional, for correspondence or emergency contact.</small>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="allergies" class="form-label fw-bold small">Allergies</label>
                        <textarea name="allergies" id="allergies" class="form-control" placeholder="Patient Allergies" rows="2">{{ old('allergies') }}</textarea>
                        <small class="text-muted" style="font-size: 12px;">Optional, list allergies if any.</small>
                    </div>
                    <div class="col-4">
                        <label for="medications" class="form-label fw-bold small">Current Medications</label>
                        <textarea name="medications" id="medications" class="form-control" placeholder="Medicine in take" rows="2">{{ old('medications') }}</textarea>
                        <small class="text-muted" style="font-size: 12px;">Optional, current medications being taken.</small>
                    </div>
                    <div class="col-4">
                        <label for="medical_history" class="form-label fw-bold small">Medical History</label>
                        <textarea name="medical_history" id="medical_history" class="form-control" placeholder="Brief medical history">{{ old('medical_history') }}</textarea>
                        <small  class="text-muted" style="font-size: 12px;">Optional, relevant for treatment decisions.</small>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
