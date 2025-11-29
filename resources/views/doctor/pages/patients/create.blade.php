<div class="modal fade new-log" id="addVisitModal" tabindex="-1" aria-labelledby="addVisitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <form action="{{ route('doctor.patients.visits.store', $patient->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="addVisitModalLabel">
                        <i class="bi bi-journal-plus me-2"></i>Add Patient Visit
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body px-4 py-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Visit Date & Time</label>
                            <input type="datetime-local" name="visit_date"  class="form-control form-control-lg"
                                value="{{ now()->format('Y-m-d\TH:i') }}" readonly>
                            <small class="text-muted">Automatically recorded based on current doctor's time.</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Action / Visit Type</label>
                            <input type="text"  name="action" class="form-control form-control-lg" 
                                placeholder="e.g. General Checkup, Follow-up, Consultation" required >
                            <small class="text-muted">Specify the type of service performed.</small>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold small">Findings / Notes</label>
                            <textarea name="findings" class="form-control form-control-lg" rows="5"
                                placeholder="Enter doctor's findings, symptoms, diagnosis, or next instructions..."></textarea>
                            <small class="text-muted">This will be shown in the patient's medical record.</small>
                        </div>

                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save me-1"></i>Save Visit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
