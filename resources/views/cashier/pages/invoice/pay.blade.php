<div class="modal fade" id="payModal{{ $invoice->id }}" tabindex="-1" aria-labelledby="payModalLabel{{ $invoice->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('cashier.invoices.paid', $invoice->id) }}" method="POST">
            @csrf
            <input type="hidden" name="patient_id" value="{{ $invoice->patient_id }}">
            <input type="hidden" name="appointment_id" value="{{ $invoice->appointment_id }}">
            <div class="modal-content shadow-sm">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="payModalLabel{{ $invoice->id }}">Pay Invoice: {{ $invoice->invoice_no }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <select name="payment_method" class="form-select" required>
                            <option value="">Select Method</option>
                            <option value="cash">Cash</option>
                            <option value="card">GCash</option>
                            <option value="card">Card</option>
                            <option value="insurance">Insurance</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Amount Received</label>
                        <input type="number" name="amount" class="form-control" min="0" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" readonly>{{ $invoice->notes }}</textarea>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success rounded-pill">
                        <i class="bi bi-check-circle me-1"></i> Mark Paid
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>