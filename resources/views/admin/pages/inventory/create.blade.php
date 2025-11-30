<div class="modal fade create-patient" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content shadow-sm border-0">
            <form action="{{ route('admin.inventory.store') }}" method="POST">
                @csrf
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-bold" id="addItemModalLabel">
                        <i class="bi bi-plus-circle me-2"></i> Add Inventory Item
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" name="name" class="form-control" id="itemName" placeholder="Item Name" required>
                                <label class="small" for="itemName">Item Name</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select name="category" class="form-select" id="itemCategory" required>
                                    <option value="" selected disabled>Select Category</option>
                                    <option value="Analgesics">Analgesics / Pain Relief</option>
                                    <option value="Antibiotics">Antibiotics</option>
                                    <option value="Antiseptics">Antiseptics / Disinfectants</option>
                                    <option value="Vitamins">Vitamins & Supplements</option>
                                    <option value="Cough & Cold">Cough & Cold Remedies</option>
                                    <option value="Gastrointestinal">Gastrointestinal / Digestive</option>
                                    <option value="Dermatology">Dermatology / Skin Care</option>
                                    <option value="Cardiovascular">Cardiovascular / Heart</option>
                                    <option value="Respiratory">Respiratory / Asthma</option>
                                    <option value="Medical Devices">Medical Devices / Supplies</option>
                                </select>
                                <label class="small" for="itemCategory">Category</label>
                            </div>
                        </div>                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" name="quantity" class="form-control" id="itemQuantity" placeholder="Quantity" required>
                                <label class="small" for="itemQuantity">Quantity</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" name="unit_price" class="form-control" id="itemUnitPrice" placeholder="Unit Price" step="0.01" min="0" required>
                                <label class="small" for="itemUnitPrice">Unit Price (₱)</label>
                            </div>
                        </div>   
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select name="unit" class="form-select" id="itemUnit" required>
                                    <option value="" selected disabled>Select Unit</option>
                                    <option value="tablet">Tablet / Pill</option>
                                    <option value="capsule">Capsule</option>
                                    <option value="bottle">Bottle</option>
                                    <option value="box">Box / Pack</option>
                                    <option value="tube">Tube</option>
                                    <option value="vial">Vial</option>
                                </select>
                                <label class="small" for="itemUnit">Unit</label>
                            </div>
                        </div>                                             
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" name="expiry_date" class="form-control" id="expiryDate" placeholder="Expiry Date">
                                <label class="small" for="expiryDate">Expiry Date</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" name="low_stock_threshold" class="form-control" id="lowStockThreshold" placeholder="Low Stock Threshold" value="5">
                                <label class="small" for="lowStockThreshold">Low Stock Threshold</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 justify-content-between">
                    <button type="button" class="btn btn-outline-secondary rounded-pill d-flex align-items-center" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Close
                    </button>
                    <button type="submit" class="btn btn-success rounded-pill d-flex align-items-center">
                        <i class="bi bi-check2-circle me-1"></i> Add Item
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
