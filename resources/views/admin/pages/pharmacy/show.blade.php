<div class="modal fade" id="viewPrescriptionModal{{ $prescription->id }}" tabindex="-1" aria-labelledby="viewPrescriptionModalLabel{{ $prescription->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-sm border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="viewPrescriptionModalLabel{{ $prescription->id }}">
                    Prescription Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 py-3">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6>Patient: <strong>{{ $prescription->patient->name }}</strong></h6>
                        <h6>Date: <strong>{{ $prescription->created_at->format('M d, Y H:i') }}</strong></h6>
                    </div>
                    <div class="col-md-6">
                        <h6>Doctor: <strong>{{ $prescription->doctor->name }}</strong></h6>
                        <h6>Status: 
                            <span class="badge 
                                {{ $prescription->status == 'pending' ? 'bg-warning text-dark' : 
                                   ($prescription->status == 'dispensed' ? 'bg-success' : 'bg-danger') }}">
                                {{ ucfirst($prescription->status) }}
                            </span>
                        </h6>
                    </div>
                </div>
                <hr>
                <h6 class="fw-bold mb-2">Items:</h6>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle mb-0">
                        <thead class="table-light text-uppercase small fw-semibold">
                            <tr>
                                <th>Medicine</th>
                                <th>Qty</th>
                                <th>Dosage</th>
                                <th>Duration</th>
                                <th>Unit Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prescription->items as $item)
                            <tr>
                                <td>{{ $item->inventory?->name ?? 'Deleted/Unknown Medicine' }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td>{{ $item->dosage ?? '-' }}</td>
                                <td>{{ $item->duration ?? '-' }}</td>
                                <td class="text-end">{{ number_format($item->unit_price, 2) }}</td>
                                <td class="text-end">{{ number_format($item->quantity * ($item->unit_price ?? 0), 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 text-end">
                    <h6 class="fw-bold">Grand Total: 
                        <span class="text-success">
                            {{ number_format($prescription->items->sum(fn($i) => $i->quantity * ($i->unit_price ?? 0)), 2) }}
                        </span>
                    </h6>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
