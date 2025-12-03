<div class="modal fade" id="showPharmacistModal{{ $ph->id }}" tabindex="-1" aria-labelledby="showPharmacistModalLabel{{ $ph->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-sm border-0">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="showPharmacistModalLabel{{ $ph->id }}">
                    <i class="bi bi-person-badge me-2"></i>{{ $ph->first_name }} {{ $ph->last_name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3">
                <div class="row g-4">
                    <div class="col-md-4 text-center">
                        <img src="{{ asset($ph->profile_photo ?? 'images/default-avatar.png') }}" 
                             class="" 
                             style="max-width:160px; object-fit: cover;">
                        <p class="mt-2 text-muted small">Profile Photo</p>
                    </div>
                    <div class="col-md-8">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-envelope me-2"></i>Email</span>
                                <span class="text-end">{{ $ph->email }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-telephone me-2"></i>Phone</span>
                                <span class="text-end">{{ $ph->phone ?? '—' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-gender-ambiguous me-2"></i>Gender</span>
                                <span class="text-end">{{ ucfirst($ph->gender ?? '—') }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-calendar-event me-2"></i>Date of Birth</span>
                                <span class="text-end">{{ $ph->date_of_birth?->format('M d, Y') ?? '—' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-geo-alt me-2"></i>Address</span>
                                <span class="text-end">{{ $ph->address ?? '—' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-card-text me-2"></i>License Number</span>
                                <span class="text-end">{{ $ph->license_number ?? '—' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-check-circle me-2"></i>Status</span>
                                @if($ph->status)
                                    <span class="badge bg-success rounded-pill">Active</span>
                                @else
                                    <span class="badge bg-secondary rounded-pill">Inactive</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-3">
                <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>
