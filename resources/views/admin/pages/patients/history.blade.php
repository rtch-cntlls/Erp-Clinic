<div class="card shadow-sm border-0 mb-5">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Date</th>
                    <th>Action / Checkup</th>
                    <th>Findings</th>
                    <th>Doctor</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($patient->visits as $visit)
                    <tr>
                        <td><span class="badge bg-primary">{{ $visit->visit_date->format('M. d, Y') }}</span></td>
                        <td>{{ $visit->action }}</td>
                        <td>
                            @if($visit->findings)
                                <span class="text-truncate d-block" style="max-width: 250px;" title="{{ $visit->findings }}">{{ $visit->findings }}</span>
                            @else <span class="text-muted">-</span> @endif
                        </td>
                        <td>{{ $visit->doctor->full_name ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $visit->status == 'completed' ? 'bg-success' : ($visit->status == 'pending' ? 'bg-warning text-dark' : 'bg-info') }}">
                                {{ ucfirst($visit->status ?? 'N/A') }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            <i class="bi bi-exclamation-circle me-2"></i> No visit history found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>