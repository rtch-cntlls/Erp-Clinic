<div class="modal fade" id="billingDetailsModal{{ $billing->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-semibold">
                    <i class="bi bi-receipt me-2"></i> Billing Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-4">
                    <h6 class="fw-bold text-secondary mb-3">
                        <i class="bi bi-person-circle me-1"></i> Patient Information
                    </h6>

                    <div class="bg-light p-3 rounded border">
                        <p class="mb-1">
                            <strong>Name:</strong> {{ $billing->patient->full_name }}
                        </p>

                        @if ($billing->appointment)
                        <p class="mb-0">
                            <strong>Appointment:</strong>
                            #{{ $billing->appointment->id }} — {{ $billing->appointment->date }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="mb-4">
                    <h6 class="fw-bold text-secondary mb-3">
                        <i class="bi bi-file-text me-1"></i> Billing Summary
                    </h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="p-3 rounded border text-center">
                                <h6 class="text-muted mb-1">Status</h6>
                                <span class="badge 
                                    @if($billing->status == 'paid') bg-success
                                    @elseif($billing->status == 'pending') bg-warning
                                    @else bg-secondary @endif
                                ">
                                    {{ ucfirst($billing->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 rounded border text-center">
                                <h6 class="text-muted mb-1">Amount</h6>
                                <h5 class="fw-bold">₱{{ number_format($billing->amount, 2) }}</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 rounded border text-center">
                                <h6 class="text-muted mb-1">Payment Method</h6>
                                <h6 class="fw-semibold text-dark">
                                    {{ ucfirst($billing->payment_method ?? '—') }}
                                </h6>
                            </div>
                        </div>

                    </div>
                </div>
                <div>
                    <h6 class="fw-bold text-secondary mb-3">
                        <i class="bi bi-journal-text me-1"></i> Notes
                    </h6>

                    <div class="p-3 rounded border bg-light">
                        {{ $billing->notes ?? 'No notes provided.' }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Close
                </button>
            </div>

        </div>
    </div>
</div>
