<div class="modal fade" id="editItemModal{{ $item->id }}" tabindex="-1" aria-labelledby="editItemModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content shadow-sm border-0">
            <form action="{{ route('admin.inventory.update', $item->id) }}" method="POST">
                @csrf
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-bold" id="editItemModalLabel{{ $item->id }}">
                        <i class="bi bi-pencil-square me-2"></i> Edit Item: {{ $item->name }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" name="name" class="form-control" id="itemName{{ $item->id }}" placeholder="Item Name" value="{{ $item->name }}" required>
                                <label class="small" for="itemName{{ $item->id }}">Item Name</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select name="category" class="form-select" id="itemCategory{{ $item->id }}" required>
                                    <option value="" disabled>Select Category</option>
                                    <option value="Analgesics" {{ $item->category == 'Analgesics' ? 'selected' : '' }}>Analgesics / Pain Relief</option>
                                    <option value="Antibiotics" {{ $item->category == 'Antibiotics' ? 'selected' : '' }}>Antibiotics</option>
                                    <option value="Antiseptics" {{ $item->category == 'Antiseptics' ? 'selected' : '' }}>Antiseptics / Disinfectants</option>
                                    <option value="Vitamins" {{ $item->category == 'Vitamins' ? 'selected' : '' }}>Vitamins & Supplements</option>
                                    <option value="Cough & Cold" {{ $item->category == 'Cough & Cold' ? 'selected' : '' }}>Cough & Cold Remedies</option>
                                    <option value="Gastrointestinal" {{ $item->category == 'Gastrointestinal' ? 'selected' : '' }}>Gastrointestinal / Digestive</option>
                                    <option value="Dermatology" {{ $item->category == 'Dermatology' ? 'selected' : '' }}>Dermatology / Skin Care</option>
                                    <option value="Cardiovascular" {{ $item->category == 'Cardiovascular' ? 'selected' : '' }}>Cardiovascular / Heart</option>
                                    <option value="Respiratory" {{ $item->category == 'Respiratory' ? 'selected' : '' }}>Respiratory / Asthma</option>
                                    <option value="Medical Devices" {{ $item->category == 'Medical Devices' ? 'selected' : '' }}>Medical Devices / Supplies</option>
                                </select>
                                <label class="small" for="itemCategory{{ $item->id }}">Category</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" name="quantity" class="form-control" id="itemQuantity{{ $item->id }}" placeholder="Quantity" value="{{ $item->quantity }}" required>
                                <label class="small" for="itemQuantity{{ $item->id }}">Quantity</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" name="unit_price" class="form-control" id="itemUnitPrice{{ $item->id }}" placeholder="Unit Price" step="0.01" min="0" value="{{ $item->unit_price ?? 0 }}" required>
                                <label class="small" for="itemUnitPrice{{ $item->id }}">Unit Price (₱)</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select name="unit" class="form-select" id="itemUnit{{ $item->id }}" required>
                                    <option value="" disabled>Select Unit</option>
                                    <option value="tablet" {{ $item->unit == 'tablet' ? 'selected' : '' }}>Tablet / Pill</option>
                                    <option value="capsule" {{ $item->unit == 'capsule' ? 'selected' : '' }}>Capsule</option>
                                    <option value="bottle" {{ $item->unit == 'bottle' ? 'selected' : '' }}>Bottle</option>
                                    <option value="box" {{ $item->unit == 'box' ? 'selected' : '' }}>Box / Pack</option>
                                    <option value="tube" {{ $item->unit == 'tube' ? 'selected' : '' }}>Tube</option>
                                    <option value="vial" {{ $item->unit == 'vial' ? 'selected' : '' }}>Vial</option>
                                </select>
                                <label class="small" for="itemUnit{{ $item->id }}">Unit</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" name="expiry_date" class="form-control" id="expiryDate{{ $item->id }}" placeholder="Expiry Date" value="{{ $item->expiry_date?->format('Y-m-d') }}">
                                <label class="small" for="expiryDate{{ $item->id }}">Expiry Date</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" name="low_stock_threshold" class="form-control" id="lowStockThreshold{{ $item->id }}" placeholder="Low Stock Threshold" value="{{ $item->low_stock_threshold }}">
                                <label class="small" for="lowStockThreshold{{ $item->id }}">Low Stock Threshold</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 justify-content-between">
                    <button type="button" class="btn btn-outline-secondary rounded-pill d-flex align-items-center" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-success rounded-pill d-flex align-items-center">
                        <i class="bi bi-check2-circle me-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
