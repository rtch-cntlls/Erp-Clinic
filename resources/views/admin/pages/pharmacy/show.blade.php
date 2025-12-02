<div class="modal fade" id="viewPrescriptionModal{{ $prescription->id }}" tabindex="-1" aria-labelledby="viewPrescriptionModalLabel{{ $prescription->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-sm border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="viewPrescriptionModalLabel{{ $prescription->id }}">
                    Prescription Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Patient: <strong>{{ $prescription->patient->first_name }} {{ $prescription->patient->last_name }}</strong></h6>
                <h6>Doctor: <strong>{{ $prescription->doctor->name }}</strong></h6>
                <h6>Status: 
                    <span class="badge 
                        {{ $prescription->status == 'pending' ? 'bg-warning text-dark' : 
                           ($prescription->status == 'dispensed' ? 'bg-success' : 'bg-danger') }}">
                        {{ ucfirst($prescription->status) }}
                    </span>
                </h6>
                <h6>Date: <strong>{{ $prescription->created_at->format('M. d, Y') }}</strong></h6>
                <hr>
                <h6 class="fw-bold">Items:</h6>
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>Medicine</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prescription->items as $item)
                        <tr>
                            <td>{{ $item->inventory?->name ?? 'Deleted/Unknown Medicine' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->unit_price, 2) }}</td>
                            <td>{{ number_format($item->quantity * $item->unit_price, 2) }}</td>
                        </tr>
                        @endforeach                        
                    </tbody>
                </table>
                <h6 class="text-end fw-bold">Grand Total: <span class="text-success">
                    {{ number_format($prescription->items->sum(fn($i) => $i->quantity * ($i->unit_price ?? 0)), 2) }}
                </span></h6>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
