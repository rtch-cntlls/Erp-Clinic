<div class="modal fade create-patient" id="editDoctorModal{{ $doctor->id }}" tabindex="-1" aria-labelledby="editDoctorModalLabel{{ $doctor->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-sm">
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
                        <div class="col-md-6">
                            <label for="name{{ $doctor->id }}" class="form-label small fw-bold">Name</label>
                            <input type="text" name="name" id="name{{ $doctor->id }}" value="{{ $doctor->name }}" class="form-control" placeholder="Doctor Name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email{{ $doctor->id }}" class="form-label small fw-bold">Email</label>
                            <input type="email" name="email" id="email{{ $doctor->id }}" value="{{ $doctor->email }}" class="form-control" placeholder="doctor@example.com" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone{{ $doctor->id }}" class="form-label small fw-bold">Phone</label>
                            <input type="text" name="phone" id="phone{{ $doctor->id }}" value="{{ $doctor->phone }}" class="form-control" placeholder="Optional">
                        </div>
                        <div class="col-md-6">
                            <label for="specialization{{ $doctor->id }}" class="form-label small fw-bold">Specialization</label>
                            <input type="text" name="specialization" id="specialization{{ $doctor->id }}" value="{{ $doctor->specialization }}" class="form-control" placeholder="e.g., Cardiologist">
                        </div>
                        <div class="col-md-12">
                            <label for="address{{ $doctor->id }}" class="form-label small fw-bold">Address</label>
                            <textarea name="address" id="address{{ $doctor->id }}" class="form-control" rows="3" placeholder="Optional">{{ $doctor->address }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="profile_image{{ $doctor->id }}" class="form-label small fw-bold">Profile Image</label>
                            <input type="file" name="profile_image" id="profile_image{{ $doctor->id }}" class="form-control">
                            @if($doctor->profile_image)
                                <div class="mt-2">
                                    <img src="{{ asset($doctor->profile_image) }}" width="60" class="rounded-circle border shadow-sm">
                                    <small class="text-muted d-block mt-1">Current Image</small>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="status{{ $doctor->id }}" class="form-label small fw-bold">Status</label>
                            <select name="status" id="status{{ $doctor->id }}" class="form-select">
                                <option value="active" {{ $doctor->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $doctor->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
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