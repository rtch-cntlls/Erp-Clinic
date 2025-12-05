<div class="modal fade create-doctor" id="editDoctorModal{{ $doctor->id }}" tabindex="-1" aria-labelledby="editDoctorModalLabel{{ $doctor->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-sm rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="editDoctorModalLabel{{ $doctor->id }}">
                    <i class="bi bi-pencil-square me-2"></i> Edit Doctor
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">

                        <!-- First Name -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="first_name" class="form-control rounded-3 @error('first_name') is-invalid @enderror" 
                                    id="firstName{{ $doctor->id }}" value="{{ old('first_name', $doctor->first_name) }}" placeholder="First Name" required>
                                <label for="firstName{{ $doctor->id }}">First Name</label>
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="last_name" class="form-control rounded-3 @error('last_name') is-invalid @enderror" 
                                    id="lastName{{ $doctor->id }}" value="{{ old('last_name', $doctor->last_name) }}" placeholder="Last Name" required>
                                <label for="lastName{{ $doctor->id }}">Last Name</label>
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" name="email" class="form-control rounded-3 @error('email') is-invalid @enderror" 
                                    id="email{{ $doctor->id }}" value="{{ old('email', $doctor->email) }}" placeholder="Email" required>
                                <label for="email{{ $doctor->id }}">Email</label>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="phone" class="form-control rounded-3 @error('phone') is-invalid @enderror" 
                                    id="phone{{ $doctor->id }}" value="{{ old('phone', $doctor->phone) }}" placeholder="Phone">
                                <label for="phone{{ $doctor->id }}">Phone</label>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="gender" class="form-select rounded-3 @error('gender') is-invalid @enderror" id="gender{{ $doctor->id }}">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender', $doctor->gender)=='male' ? 'selected':'' }}>Male</option>
                                    <option value="female" {{ old('gender', $doctor->gender)=='female' ? 'selected':'' }}>Female</option>
                                </select>
                                <label for="gender{{ $doctor->id }}">Gender</label>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Birthdate -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" name="birthdate" class="form-control rounded-3 @error('birthdate') is-invalid @enderror" 
                                    id="birthdate{{ $doctor->id }}" value="{{ old('birthdate', $doctor->birthdate) }}">
                                <label for="birthdate{{ $doctor->id }}">Birthdate</label>
                                @error('birthdate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- License No -->
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" name="license_no" class="form-control rounded-3 @error('license_no') is-invalid @enderror" 
                                    id="licenseNo{{ $doctor->id }}" value="{{ old('license_no', $doctor->license_no) }}" placeholder="License No" required>
                                <label for="licenseNo{{ $doctor->id }}">License No.</label>
                                @error('license_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- PTR No -->
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" name="ptr_no" class="form-control rounded-3 @error('ptr_no') is-invalid @enderror" 
                                    id="ptrNo{{ $doctor->id }}" value="{{ old('ptr_no', $doctor->ptr_no) }}" placeholder="PTR No">
                                <label for="ptrNo{{ $doctor->id }}">PTR No.</label>
                                @error('ptr_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- S2 No -->
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" name="s2_no" class="form-control rounded-3 @error('s2_no') is-invalid @enderror" 
                                    id="s2No{{ $doctor->id }}" value="{{ old('s2_no', $doctor->s2_no) }}" placeholder="S2 No">
                                <label for="s2No{{ $doctor->id }}">S2 No.</label>
                                @error('s2_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Specialization -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="specialization" class="form-select rounded-3 @error('specialization') is-invalid @enderror" id="specialization{{ $doctor->id }}">
                                    <option value="">Select Specialization</option>
                                    <option value="Cardiologist" {{ old('specialization', $doctor->specialization)=='Cardiologist'?'selected':'' }}>Cardiologist</option>
                                    <option value="Dermatologist" {{ old('specialization', $doctor->specialization)=='Dermatologist'?'selected':'' }}>Dermatologist</option>
                                    <option value="Neurologist" {{ old('specialization', $doctor->specialization)=='Neurologist'?'selected':'' }}>Neurologist</option>
                                    <option value="Pediatrician" {{ old('specialization', $doctor->specialization)=='Pediatrician'?'selected':'' }}>Pediatrician</option>
                                    <option value="Orthopedic Surgeon" {{ old('specialization', $doctor->specialization)=='Orthopedic Surgeon'?'selected':'' }}>Orthopedic Surgeon</option>
                                    <option value="Gynecologist" {{ old('specialization', $doctor->specialization)=='Gynecologist'?'selected':'' }}>Gynecologist</option>
                                    <option value="General Surgeon" {{ old('specialization', $doctor->specialization)=='General Surgeon'?'selected':'' }}>General Surgeon</option>
                                    <option value="ENT Specialist" {{ old('specialization', $doctor->specialization)=='ENT Specialist'?'selected':'' }}>ENT Specialist</option>
                                    <option value="Ophthalmologist" {{ old('specialization', $doctor->specialization)=='Ophthalmologist'?'selected':'' }}>Ophthalmologist</option>
                                    <option value="Psychiatrist" {{ old('specialization', $doctor->specialization)=='Psychiatrist'?'selected':'' }}>Psychiatrist</option>
                                    <option value="Radiologist" {{ old('specialization', $doctor->specialization)=='Radiologist'?'selected':'' }}>Radiologist</option>
                                    <option value="Anesthesiologist" {{ old('specialization', $doctor->specialization)=='Anesthesiologist'?'selected':'' }}>Anesthesiologist</option>
                                    <option value="Urologist" {{ old('specialization', $doctor->specialization)=='Urologist'?'selected':'' }}>Urologist</option>
                                    <option value="Oncologist" {{ old('specialization', $doctor->specialization)=='Oncologist'?'selected':'' }}>Oncologist</option>
                                    <option value="Internist" {{ old('specialization', $doctor->specialization)=='Internist'?'selected':'' }}>Internist</option>
                                </select>
                                <label for="specialization{{ $doctor->id }}">Specialization</label>
                                @error('specialization')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Sub Specialization -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="sub_specialization" class="form-select rounded-3 @error('sub_specialization') is-invalid @enderror" id="subSpecialization{{ $doctor->id }}">
                                    <option value="">Select Sub Specialization (Optional)</option>
                                    <option value="Interventional Cardiologist" {{ old('sub_specialization', $doctor->sub_specialization)=='Interventional Cardiologist'?'selected':'' }}>Interventional Cardiologist</option>
                                    <option value="Electrophysiologist" {{ old('sub_specialization', $doctor->sub_specialization)=='Electrophysiologist'?'selected':'' }}>Electrophysiologist</option>
                                    <option value="Pediatric Cardiologist" {{ old('sub_specialization', $doctor->sub_specialization)=='Pediatric Cardiologist'?'selected':'' }}>Pediatric Cardiologist</option>
                                    <option value="Cosmetic Dermatologist" {{ old('sub_specialization', $doctor->sub_specialization)=='Cosmetic Dermatologist'?'selected':'' }}>Cosmetic Dermatologist</option>
                                    <option value="Pediatric Dermatologist" {{ old('sub_specialization', $doctor->sub_specialization)=='Pediatric Dermatologist'?'selected':'' }}>Pediatric Dermatologist</option>
                                    <option value="Stroke Specialist" {{ old('sub_specialization', $doctor->sub_specialization)=='Stroke Specialist'?'selected':'' }}>Stroke Specialist</option>
                                    <option value="Epileptologist" {{ old('sub_specialization', $doctor->sub_specialization)=='Epileptologist'?'selected':'' }}>Epileptologist</option>
                                    <option value="Neonatologist" {{ old('sub_specialization', $doctor->sub_specialization)=='Neonatologist'?'selected':'' }}>Neonatologist</option>
                                    <option value="Pediatric Endocrinologist" {{ old('sub_specialization', $doctor->sub_specialization)=='Pediatric Endocrinologist'?'selected':'' }}>Pediatric Endocrinologist</option>
                                    <option value="Spine Surgeon" {{ old('sub_specialization', $doctor->sub_specialization)=='Spine Surgeon'?'selected':'' }}>Spine Surgeon</option>
                                    <option value="Sports Medicine Specialist" {{ old('sub_specialization', $doctor->sub_specialization)=='Sports Medicine Specialist'?'selected':'' }}>Sports Medicine Specialist</option>
                                </select>
                                <label for="subSpecialization{{ $doctor->id }}">Sub Specialization</label>
                                @error('sub_specialization')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea name="address" class="form-control rounded-3 @error('address') is-invalid @enderror" 
                                    id="address{{ $doctor->id }}" style="height:60px">{{ old('address', $doctor->address) }}</textarea>
                                <label for="address{{ $doctor->id }}">Address</label>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Bio -->
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea name="bio" class="form-control rounded-3 @error('bio') is-invalid @enderror" 
                                    id="bio{{ $doctor->id }}" style="height:80px">{{ old('bio', $doctor->bio) }}</textarea>
                                <label for="bio{{ $doctor->id }}">Bio</label>
                                @error('bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Profile Image -->
                        <div class="col-md-6">
                            <label for="profile_image{{ $doctor->id }}" class="form-label fw-bold">Profile Image</label>
                            <input type="file" name="profile_image" id="profile_image{{ $doctor->id }}" class="form-control @error('profile_image') is-invalid @enderror">
                            @error('profile_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($doctor->profile_image)
                                <div class="mt-2">
                                    <img src="{{ asset($doctor->profile_image) }}" width="60" class="rounded-circle border shadow-sm">
                                    <small class="text-muted d-block mt-1">Current Image</small>
                                </div>
                            @endif
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="status" class="form-select rounded-3 @error('status') is-invalid @enderror" id="status{{ $doctor->id }}">
                                    <option value="active" {{ old('status', $doctor->status)=='active'?'selected':'' }}>Active</option>
                                    <option value="inactive" {{ old('status', $doctor->status)=='inactive'?'selected':'' }}>Inactive</option>
                                </select>
                                <label for="status{{ $doctor->id }}">Status</label>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary d-flex align-items-center" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary d-flex align-items-center">
                        <i class="bi bi-check2-circle me-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
