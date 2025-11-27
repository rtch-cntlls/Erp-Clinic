<div class="modal fade" id="editItemModal{{ $item->id }}" tabindex="-1" aria-labelledby="editItemModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-4 shadow-sm">
            <form action="{{ route('admin.inventory.update', $item->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="editItemModalLabel{{ $item->id }}">
                        <i class="bi bi-pencil-square me-1"></i> Edit Item: {{ $item->name }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label">Item Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $item->name }}" placeholder="Enter item name" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Category</label>
                            <input type="text" name="category" class="form-control" value="{{ $item->category }}" placeholder="Enter category" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Quantity</label>
                            <input type="number" name="quantity" class="form-control" value="{{ $item->quantity }}" placeholder="Enter quantity" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Unit</label>
                            <input type="text" name="unit" class="form-control" value="{{ $item->unit }}" placeholder="e.g., pcs, boxes" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Expiry Date</label>
                            <input type="date" name="expiry_date" class="form-control" value="{{ $item->expiry_date?->format('Y-m-d') }}">
                            <small class="text-muted">Optional: Set expiry date if applicable</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Low Stock Threshold</label>
                            <input type="number" name="low_stock_threshold" class="form-control" value="{{ $item->low_stock_threshold }}">
                            <small class="text-muted">Quantity below this triggers low stock badge</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex gap-2">
                    <button type="submit" class="btn btn-success d-flex align-items-center">
                        <i class="bi bi-check2-circle me-1"></i> Save Changes
                    </button>
                    <button type="button" class="btn btn-secondary d-flex align-items-center" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
