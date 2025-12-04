<div class="modal fade" id="addPrescriptionModal" tabindex="-1" aria-labelledby="addPrescriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <form action="{{ route('doctor.patients.prescriptions.store', $patient->id) }}" method="POST">
                @csrf
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="addPrescriptionModalLabel">
                        <i class="bi bi-capsule me-2"></i>Create Prescription
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body px-4 py-4">
                    <div class="table-responsive border rounded">
                        <table class="table table-striped align-middle mb-0" id="medicineTable">
                            <thead class="bg-light text-uppercase small fw-semibold">
                                <tr>
                                    <th>Medicine</th>
                                    <th width="100" class="text-center">Qty</th>
                                    <th width="200">Dosage</th>
                                    <th width="200">Duration</th>
                                    <th width="60"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="medicine-row">
                                    <td>
                                        <select name="medicine_id[]" class="form-select form-select-md" required>
                                            <option value="">-- Select Medicine --</option>
                                            @foreach($medicines as $med)
                                                <option value="{{ $med->id }}">
                                                    {{ $med->name }} • Stock: {{ $med->quantity }} {{ $med->unit }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="quantity[]" class="form-control text-center" min="1" required>
                                    </td>
                                    <td>
                                        <input type="text" name="dosage[]" class="form-control" placeholder="e.g., 1 tablet 3x/day">
                                    </td>
                                    <td>
                                        <input type="text" name="duration[]" class="form-control" placeholder="e.g., 7 days">
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-outline-danger btn-sm remove-row">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        <button type="button" class="btn btn-outline-primary btn-sm" id="addRowBtn">
                            <i class="bi bi-plus-circle me-1"></i> Add Medicine
                        </button>
                    </div>
                </div>

                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save me-1"></i>Save Prescription
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const addRowBtn = document.getElementById('addRowBtn');
const tableBody = document.querySelector('#medicineTable tbody');

addRowBtn.addEventListener('click', function () {
    const newRow = document.createElement('tr');
    newRow.classList.add('medicine-row');
    newRow.innerHTML = `
        <td>
            <select name="medicine_id[]" class="form-select form-select-md" required>
                <option value="">-- Select Medicine --</option>
                @foreach($medicines as $med)
                    <option value="{{ $med->id }}">
                        {{ $med->name }} • Stock: {{ $med->quantity }} {{ $med->unit }}
                    </option>
                @endforeach
            </select>
        </td>
        <td>
            <input type="number" name="quantity[]" class="form-control text-center" min="1" required>
        </td>
        <td>
            <input type="text" name="dosage[]" class="form-control" placeholder="e.g., 1 tablet 3x/day">
        </td>
        <td>
            <input type="text" name="duration[]" class="form-control" placeholder="e.g., 7 days">
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-outline-danger btn-sm remove-row">
                <i class="bi bi-x-lg"></i>
            </button>
        </td>
    `;
    tableBody.appendChild(newRow);
});

tableBody.addEventListener('click', function(e){
    if(e.target.closest('.remove-row')){
        const row = e.target.closest('tr');
        row.remove();
    }
});
</script>
