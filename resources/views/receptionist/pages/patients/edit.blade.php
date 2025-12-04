<div class="modal fade" id="editPatientModal" tabindex="-1" aria-labelledby="editPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('receptionist.patients.update', $patient->id) }}">
            @csrf
            <div class="modal-content rounded-4 shadow-sm border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="editPatientModalLabel">Edit Patient Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Full Name" value="{{ $patient->name }}" required>
                                <label for="name">Full Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ $patient->email }}">
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" value="{{ $patient->phone }}">
                                <label for="phone">Phone</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="gender" class="form-select" id="gender">
                                    <option value="">Select</option>
                                    <option value="male" {{ $patient->gender === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ $patient->gender === 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                <label for="gender">Gender</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" name="dob" class="form-control" id="dob" placeholder="Date of Birth" value="{{ $patient->dob?->format('Y-m-d') }}">
                                <label for="dob">Date of Birth</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="blood_group" class="form-control" id="bloodGroup" placeholder="Blood Group" value="{{ $patient->blood_group }}">
                                <label for="bloodGroup">Blood Group</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="emergency_contact" class="form-control" id="emergencyContact" placeholder="Emergency Contact" value="{{ $patient->emergency_contact }}">
                                <label for="emergencyContact">Emergency Contact</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea name="address" class="form-control" id="address" placeholder="Address" style="height: 80px">{{ $patient->address }}</textarea>
                                <label for="address">Address</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="insurance" class="form-control" id="insurance" placeholder="Insurance" value="{{ $patient->insurance }}">
                                <label for="insurance">Insurance</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="allergies" class="form-control" id="allergies" placeholder="Allergies" value="{{ $patient->allergies }}">
                                <label for="allergies">Allergies</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" name="medications" class="form-control" id="medications" placeholder="Medications" value="{{ $patient->medications }}">
                                <label for="medications">Medications</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <textarea name="medical_history" class="form-control" id="medicalHistory" placeholder="Medical History" style="height: 100px">{{ $patient->medical_history }}</textarea>
                                <label for="medicalHistory">Medical History</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save me-1"></i> Save Changes
                    </button>
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
