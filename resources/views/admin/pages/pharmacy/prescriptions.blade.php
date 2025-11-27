<div class="modal fade" id="pendingPrescriptionsModal" tabindex="-1" aria-labelledby="pendingPrescriptionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-sm">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold" id="pendingPrescriptionsModalLabel">
                    <i class="bi bi-clock-history me-2 text-warning"></i> Pending prescriptions
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                @if($prescriptions->count())
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th></th>
                                    <th>Patient</th>
                                    <th>Doctor</th>
                                    <th>Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($prescriptions as $prescription)
                                <tr>
                                    <td>{{ $prescription->id }}</td>
                                    <td>{{ $prescription->patient->name }}</td>
                                    <td>{{ $prescription->doctor->name }}</td>
                                    <td>{{ $prescription->created_at->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.pharmacy.show', $prescription->id) }}" 
                                           class="btn btn-sm btn-info d-flex align-items-center justify-content-center mb-1">
                                            <i class="bi bi-eye me-1"></i> View
                                        </a>
                                        <form action="{{ route('admin.pharmacy.dispense', $prescription->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success d-flex align-items-center justify-content-center mb-1">
                                                <i class="bi bi-check-circle me-1"></i> Dispense
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-exclamation-circle fs-2 mb-2"></i>
                        <p class="mb-0 fw-semibold">No pending prescriptions at the moment.</p>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary d-flex align-items-center">
                    <i class="bi bi-x-circle me-1"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>
