<div class="modal fade" id="cashierModal{{ $cashier->id }}" tabindex="-1" aria-labelledby="cashierModalLabel{{ $cashier->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-sm">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="cashierModalLabel">
                    <i class="bi bi-person-badge me-2"></i> Edit Cashier
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.cashiers.update', $cashier->id ?? 0) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="first_name" class="form-control" placeholder="First Name" 
                                       value="{{ old('first_name', $cashier->first_name ?? '') }}" required>
                                <label>First Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name" 
                                       value="{{ old('last_name', $cashier->last_name ?? '') }}" required>
                                <label>Last Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" name="email" class="form-control" placeholder="Email" 
                                       value="{{ old('email', $cashier->email ?? '') }}">
                                <label>Email</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="phone" class="form-control" placeholder="Phone" 
                                       value="{{ old('phone', $cashier->phone ?? '') }}">
                                <label>Phone</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="address" class="form-control" placeholder="Address" 
                                       value="{{ old('address', $cashier->address ?? '') }}">
                                <label>Address</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="file" name="profile_image" class="form-control">
                                <label>Profile Image</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" name="date_hired" class="form-control" 
                                       value="{{ old('date_hired', $cashier->date_hired ?? '') }}">
                                <label>Date Hired</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="shift" class="form-select">
                                    <option value="">Select Shift</option>
                                    <option value="morning" {{ old('shift', $cashier->shift ?? '') == 'morning' ? 'selected' : '' }}>Morning</option>
                                    <option value="afternoon" {{ old('shift', $cashier->shift ?? '') == 'afternoon' ? 'selected' : '' }}>Afternoon</option>
                                    <option value="night" {{ old('shift', $cashier->shift ?? '') == 'night' ? 'selected' : '' }}>Night</option>
                                </select>
                                <label>Shift</label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="form-floating">
                            <textarea name="notes" class="form-control" placeholder="Notes" style="height:100px">{{ old('notes', $cashier->notes ?? '') }}</textarea>
                            <label>Notes</label>
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
