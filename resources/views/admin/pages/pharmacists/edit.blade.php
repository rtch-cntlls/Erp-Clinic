<div class="modal fade" id="editPharmacistModal{{ $ph->id }}" tabindex="-1" aria-labelledby="editPharmacistModalLabel{{ $ph->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-sm border-0">
            <form action="{{ route('admin.pharmacists.update', $ph->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-bold" id="editPharmacistModalLabel{{ $ph->id }}">
                        <i class="bi bi-pencil-square me-2"></i>Edit Pharmacist
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" name="first_name" value="{{ $ph->first_name }}" class="form-control" id="firstName{{ $ph->id }}" placeholder="First Name" required>
                                <label for="firstName{{ $ph->id }}">First Name</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" name="last_name" value="{{ $ph->last_name }}" class="form-control" id="lastName{{ $ph->id }}" placeholder="Last Name" required>
                                <label for="lastName{{ $ph->id }}">Last Name</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="email" name="email" value="{{ $ph->email }}" class="form-control" id="email{{ $ph->id }}" placeholder="Email" required>
                                <label for="email{{ $ph->id }}">Email</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" name="phone" value="{{ $ph->phone }}" class="form-control" id="phone{{ $ph->id }}" placeholder="Phone">
                                <label for="phone{{ $ph->id }}">Phone</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" name="license_number" value="{{ $ph->license_number }}" class="form-control" id="license{{ $ph->id }}" placeholder="License Number">
                                <label for="license{{ $ph->id }}">License Number</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="date" name="date_of_birth" value="{{ $ph->date_of_birth?->format('Y-m-d') }}" class="form-control" id="dob{{ $ph->id }}" placeholder="Date of Birth">
                                <label for="dob{{ $ph->id }}">Date of Birth</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Gender</label>
                            <select name="gender" class="form-select">
                                <option value="">Select Gender</option>
                                <option value="male" {{ $ph->gender==='male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $ph->gender==='female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ $ph->gender==='other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" name="address" value="{{ $ph->address }}" class="form-control" id="address{{ $ph->id }}" placeholder="Address">
                                <label for="address{{ $ph->id }}">Address</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Profile Photo</label>
                            <input type="file" name="profile_photo" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 justify-content-between">
                    <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill">
                        <i class="bi bi-check-circle me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
