<div class="mb-5">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Action / Checkup</th>
                        <th>Findings</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patient->visits as $visit)
                        <tr>
                            <td>
                                <span class="badge bg-primary">{{ $visit->visit_date->format('M. d, Y') }}</span>
                            </td>
                            <td>
                                <span class="fw-semibold">{{ $visit->action }}</span>
                            </td>
                            <td>
                                @if($visit->findings)
                                    <span class="text-truncate d-block" style="max-width: 300px;" title="{{ $visit->findings }}">
                                        {{ $visit->findings }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                <i class="bi bi-exclamation-circle me-2"></i> No visit history found for this patient.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
