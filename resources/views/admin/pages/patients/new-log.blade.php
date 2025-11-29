<div class="modal fade new-log" id="logVisitModal" tabindex="-1" aria-labelledby="logVisitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-sm">
            <form action="{{ route('admin.patients.visits.store', $patient->id) }}" method="POST">
                @csrf
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="logVisitModalLabel">
                        <i class="bi bi-journal-medical me-2"></i> Log New Visit
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="visit_date" class="form-label small fw-semibold">Visit Date</label>
                        <input type="date" name="visit_date" id="visit_date" class="form-control" required>
                        <small style="font-size: 12px;">Select the date of the patient's visit.</small>
                    </div>
                    <div class="mb-3">
                        <label for="action" class="form-label small fw-semibold">Action / Checkup</label>
                        <input type="text" name="action" id="action" class="form-control" placeholder="e.g., General Checkup, Lab Test" required>
                        <small style="font-size: 12px;">Describe the procedure or examination performed.</small>
                    </div>
                    <div class="mb-3">
                        <label for="findings" class="form-label small fw-semibold">Findings</label>
                        <textarea name="findings" id="findings" class="form-control" rows="3" placeholder="Enter doctor's notes or observations"></textarea>
                        <small style="font-size: 12px;">Optional: Summarize important notes or recommendations.</small>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-sm btn-outline-secondary d-flex align-items-center" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-sm btn-primary d-flex align-items-center">
                        <i class="bi bi-check-circle me-1"></i> Save Visit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
