<div class="modal fade" id="showItemModal{{ $item->id }}" tabindex="-1" aria-labelledby="showItemModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-sm border-0">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="showItemModalLabel{{ $item->id }}">
                    <i class="bi bi-eye me-2"></i> Inventory Item Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-3">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="{{ $item->name }}" id="itemName{{ $item->id }}" readonly>
                            <label for="itemName{{ $item->id }}">Name</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="{{ $item->category }}" id="itemCategory{{ $item->id }}" readonly>
                            <label for="itemCategory{{ $item->id }}">Category</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="{{ $item->quantity }} {{ $item->unit }}" id="itemQuantity{{ $item->id }}" readonly>
                            <label for="itemQuantity{{ $item->id }}">Quantity</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="{{ $item->unit }}" id="itemUnit{{ $item->id }}" readonly>
                            <label for="itemUnit{{ $item->id }}">Unit</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="{{ number_format($item->unit_price, 2) }}" id="itemPrice{{ $item->id }}" readonly>
                            <label for="itemPrice{{ $item->id }}">Unit Price</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="{{ $item->expiry_date?->format('Y-m-d') ?? '-' }}" id="itemExpiry{{ $item->id }}" readonly>
                            <label for="itemExpiry{{ $item->id }}">Expiry Date</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="{{ $item->low_stock_threshold }}" id="itemThreshold{{ $item->id }}" readonly>
                            <label for="itemThreshold{{ $item->id }}">Low Stock Threshold</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-end">
                <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>
