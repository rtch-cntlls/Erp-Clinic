@extends('layouts.admin')
@section('title', 'Add Doctor')
@section('content')
<div class="container create-doctor">
    <div class="">
        <div class="card-body">
            <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <a href="{{ route('admin.doctors.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left-circle me-1"></i> Back
                        </a>
                        <h4 class="fw-bold mb-0">Add Doctor</h4>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-person-plus me-2"></i>Save Doctor
                        </button>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="first_name" class="form-control rounded-3 @error('first_name') is-invalid @enderror" 
                                id="firstName" value="{{ old('first_name') }}" placeholder="First Name" >
                            <label for="firstName">First Name</label>
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="last_name" class="form-control rounded-3 @error('last_name') is-invalid @enderror" 
                                id="lastName" value="{{ old('last_name') }}" placeholder="Last Name" >
                            <label for="lastName">Last Name</label>
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" name="email" class="form-control rounded-3 @error('email') is-invalid @enderror" 
                                id="email" value="{{ old('email') }}" placeholder="Email" >
                            <label for="email">Email</label>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="phone" class="form-control rounded-3 @error('phone') is-invalid @enderror" 
                                id="phone" value="{{ old('phone') }}" placeholder="Phone">
                            <label for="phone">Phone</label>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select name="gender" class="form-select rounded-3 @error('gender') is-invalid @enderror" id="gender">
                                <option value="" selected>Select Gender</option>
                                <option value="male" {{ old('gender')=='male' ? 'selected':'' }}>Male</option>
                                <option value="female" {{ old('gender')=='female' ? 'selected':'' }}>Female</option>
                            </select>
                            <label for="gender">Gender</label>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" name="birthdate" class="form-control rounded-3 @error('birthdate') is-invalid @enderror" 
                                id="birthdate" value="{{ old('birthdate') }}">
                            <label for="birthdate">Birthdate</label>
                            @error('birthdate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" name="license_no" class="form-control rounded-3 @error('license_no') is-invalid @enderror" 
                                id="licenseNo" value="{{ old('license_no') }}" placeholder="License No." >
                            <label for="licenseNo">License No.</label>
                            @error('license_no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" name="ptr_no" class="form-control rounded-3 @error('ptr_no') is-invalid @enderror" 
                                id="ptrNo" value="{{ old('ptr_no') }}" placeholder="PTR No.">
                            <label for="ptrNo">PTR No.</label>
                            @error('ptr_no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" name="s2_no" class="form-control rounded-3 @error('s2_no') is-invalid @enderror" 
                                id="s2No" value="{{ old('s2_no') }}" placeholder="S2 No.">
                            <label for="s2No">S2 No.</label>
                            @error('s2_no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select name="specialization" class="form-select rounded-3 @error('specialization') is-invalid @enderror" id="specialization">
                                <option value="" selected>Select Specialization</option>
                                <option value="Cardiologist" {{ old('specialization')=='Cardiologist' ? 'selected':'' }}>Cardiologist</option>
                                <option value="Dermatologist" {{ old('specialization')=='Dermatologist' ? 'selected':'' }}>Dermatologist</option>
                                <option value="Neurologist" {{ old('specialization')=='Neurologist' ? 'selected':'' }}>Neurologist</option>
                                <option value="Pediatrician" {{ old('specialization')=='Pediatrician' ? 'selected':'' }}>Pediatrician</option>
                                <option value="Orthopedic Surgeon" {{ old('specialization')=='Orthopedic Surgeon' ? 'selected':'' }}>Orthopedic Surgeon</option>
                                <option value="Gynecologist" {{ old('specialization')=='Gynecologist' ? 'selected':'' }}>Gynecologist</option>
                                <option value="General Surgeon" {{ old('specialization')=='General Surgeon' ? 'selected':'' }}>General Surgeon</option>
                                <option value="ENT Specialist" {{ old('specialization')=='ENT Specialist' ? 'selected':'' }}>ENT Specialist</option>
                                <option value="Ophthalmologist" {{ old('specialization')=='Ophthalmologist' ? 'selected':'' }}>Ophthalmologist</option>
                                <option value="Psychiatrist" {{ old('specialization')=='Psychiatrist' ? 'selected':'' }}>Psychiatrist</option>
                                <option value="Radiologist" {{ old('specialization')=='Radiologist' ? 'selected':'' }}>Radiologist</option>
                                <option value="Anesthesiologist" {{ old('specialization')=='Anesthesiologist' ? 'selected':'' }}>Anesthesiologist</option>
                                <option value="Urologist" {{ old('specialization')=='Urologist' ? 'selected':'' }}>Urologist</option>
                                <option value="Oncologist" {{ old('specialization')=='Oncologist' ? 'selected':'' }}>Oncologist</option>
                                <option value="Internist" {{ old('specialization')=='Internist' ? 'selected':'' }}>Internist</option>
                            </select>
                            <label for="specialization">Specialization</label>
                            @error('specialization')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select name="sub_specialization" class="form-select rounded-3 @error('sub_specialization') is-invalid @enderror" id="subSpecialization">
                                <option value="" selected>Select Sub Specialization (Optional)</option>
                                <option value="Interventional Cardiologist" {{ old('sub_specialization')=='Interventional Cardiologist' ? 'selected':'' }}>Interventional Cardiologist</option>
                                <option value="Electrophysiologist" {{ old('sub_specialization')=='Electrophysiologist' ? 'selected':'' }}>Electrophysiologist</option>
                                <option value="Pediatric Cardiologist" {{ old('sub_specialization')=='Pediatric Cardiologist' ? 'selected':'' }}>Pediatric Cardiologist</option>
                                <option value="Cosmetic Dermatologist" {{ old('sub_specialization')=='Cosmetic Dermatologist' ? 'selected':'' }}>Cosmetic Dermatologist</option>
                                <option value="Pediatric Dermatologist" {{ old('sub_specialization')=='Pediatric Dermatologist' ? 'selected':'' }}>Pediatric Dermatologist</option>
                                <option value="Stroke Specialist" {{ old('sub_specialization')=='Stroke Specialist' ? 'selected':'' }}>Stroke Specialist</option>
                                <option value="Epileptologist" {{ old('sub_specialization')=='Epileptologist' ? 'selected':'' }}>Epileptologist</option>
                                <option value="Neonatologist" {{ old('sub_specialization')=='Neonatologist' ? 'selected':'' }}>Neonatologist</option>
                                <option value="Pediatric Endocrinologist" {{ old('sub_specialization')=='Pediatric Endocrinologist' ? 'selected':'' }}>Pediatric Endocrinologist</option>
                                <option value="Spine Surgeon" {{ old('sub_specialization')=='Spine Surgeon' ? 'selected':'' }}>Spine Surgeon</option>
                                <option value="Sports Medicine Specialist" {{ old('sub_specialization')=='Sports Medicine Specialist' ? 'selected':'' }}>Sports Medicine Specialist</option>
                            </select>
                            <label for="subSpecialization">Sub Specialization</label>
                            @error('sub_specialization')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>                    
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="department" class="form-control rounded-3 @error('department') is-invalid @enderror" 
                                id="department" value="{{ old('department') }}" placeholder="Department">
                            <label for="department">Department</label>
                            @error('department')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" name="years_experience" class="form-control rounded-3 @error('years_experience') is-invalid @enderror" 
                                id="experience" value="{{ old('years_experience') }}" min="0" placeholder="Years of Experience">
                            <label for="experience">Years of Experience</label>
                            @error('years_experience')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" name="consultation_fee" class="form-control rounded-3 @error('consultation_fee') is-invalid @enderror" 
                                id="fee" value="{{ old('consultation_fee') }}" min="0" step="0.01" placeholder="Consultation Fee">
                            <label for="fee">Consultation Fee</label>
                            @error('consultation_fee')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <textarea name="address" class="form-control rounded-3 @error('address') is-invalid @enderror" id="address" style="height:60px" placeholder="Address">{{ old('address') }}</textarea>
                            <label for="address">Address</label>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea name="bio" class="form-control rounded-3 @error('bio') is-invalid @enderror" id="bio" style="height:80px" placeholder="Bio">{{ old('bio') }}</textarea>
                            <label for="bio">Bio</label>
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Profile Image</label>
                        <input type="file" name="profile_image" class="form-control rounded-3 @error('profile_image') is-invalid @enderror">
                        @error('profile_image')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select name="status" class="form-select rounded-3 @error('status') is-invalid @enderror" id="status">
                                <option value="active" {{ old('status')=='active'?'selected':'' }}>Active</option>
                                <option value="inactive" {{ old('status')=='inactive'?'selected':'' }}>Inactive</option>
                            </select>
                            <label for="status">Status</label>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
