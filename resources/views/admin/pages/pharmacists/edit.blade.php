<div class="modal fade" id="editPharmacistModal{{ $ph->id }}" tabindex="-1" aria-labelledby="editPharmacistModalLabel{{ $ph->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-sm border-0">
            <form action="{{ route('admin.pharmacists.update', $ph->id) }}" method="POST">
                @csrf
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-bold" id="editPharmacistModalLabel{{ $ph->id }}">
                        <i class="bi bi-pencil-square me-2"></i>Edit Pharmacist
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="first_name" value="{{ $ph->first_name }}" class="form-control" id="firstName{{ $ph->id }}" placeholder="First Name" required>
                                <label for="firstName{{ $ph->id }}">First Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="last_name" value="{{ $ph->last_name }}" class="form-control" id="lastName{{ $ph->id }}" placeholder="Last Name" required>
                                <label for="lastName{{ $ph->id }}">Last Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mt-3">
                        <input type="email" name="email" value="{{ $ph->email }}" class="form-control" id="email{{ $ph->id }}" placeholder="Email" required>
                        <label for="email{{ $ph->id}}">Email</label>
                    </div>
                    <div class="form-floating mt-3">
                        <input type="text" name="phone" value="{{ $ph->phone }}" class="form-control" id="phone{{ $ph->id }}" placeholder="Phone">
                        <label for="phone{{ $ph->id }}">Phone</label>
                    </div>
                    <div class="mt-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select">
                            <option value="1" {{ $ph->status ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ !$ph->status ? 'selected' : '' }}>Inactive</option>
                        </select>
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
