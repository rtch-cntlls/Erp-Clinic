@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="p-4 bg-white border shadow-sm text-center">
                <h6 class="text-muted mb-2">Total Patients</h6>
                <h3 class="fw-bold">{{ $totalPatients }}</h3>
                <i class="bi bi-people-fill fs-3 text-primary"></i>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-4 bg-white border shadow-sm text-center">
                <h6 class="text-muted mb-2">Total Doctors</h6>
                <h3 class="fw-bold">{{ $totalDoctors }}</h3>
                <i class="bi bi-person-badge-fill fs-3 text-danger"></i>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-4 bg-white border shadow-sm text-center">
                <h6 class="text-muted mb-2">Appointments Today</h6>
                <h3 class="fw-bold">{{ $appointmentsToday }}</h3>
                <i class="bi bi-calendar-check-fill fs-3 text-success"></i>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-4 bg-white border shadow-sm text-center">
                <h6 class="text-muted mb-2">Revenue This Month</h6>
                <h3 class="fw-bold">₱{{ number_format($revenueThisMonth, 2) }}</h3>
                <span class="fs-3 text-warning">₱</span>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="p-4 shadow-sm" style="background-color: #ffffff;">
                <h5 class="fw-semibold text-primary mb-3"><i class="bi bi-bar-chart-line me-2"></i>Monthly Visits</h5>
                <canvas id="visitsChart" height="200"></canvas>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="p-4 shadow-sm" style="background-color: #ffffff;">
                <h5 class="fw-semibold text-primary mb-3"><span>₱</span> Revenue Trends</h5>
                <canvas id="revenueChart" height="200"></canvas>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="p-4 rounded-4 shadow-sm" style="background-color: #f9f9f9;">
                <h5 class="fw-semibold text-primary mb-3"><i class="bi bi-clock-history me-2"></i>Upcoming Appointments</h5>
                <ul class="list-group list-group-flush">
                    @forelse($upcomingAppointments as $appt)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $appt->patient->name }}
                        <span class="badge bg-info text-dark">{{ $appt->appointment_date->format('M d, Y H:i') }}</span>
                    </li>
                    @empty
                    <li class="list-group-item text-center text-muted">No upcoming appointments</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="p-4 rounded-4 shadow-sm" style="background-color: #f9f9f9;">
                <h5 class="fw-semibold text-primary mb-3"><i class="bi bi-people-fill me-2"></i>New Patients This Month</h5>
                <ul class="list-group list-group-flush">
                    @forelse($newPatients as $p)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $p->name }}
                        <span class="text-muted small">{{ $p->created_at->format('M d') }}</span>
                    </li>
                    @empty
                    <li class="list-group-item text-center text-muted">No new patients this month</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const visitsCtx = document.getElementById('visitsChart').getContext('2d');
    new Chart(visitsCtx, {
        type: 'line',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets: [{
                label: 'Visits',
                data: [
                    @for($m=1; $m<=12; $m++)
                        {{ $monthlyVisits[$m] }}, 
                    @endfor
                ],
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13,110,253,0.1)',
                fill: true,
                tension: 0.3
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
    });

    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets: [{
                label: 'Revenue',
                data: [
                    @for($m=1; $m<=12; $m++)
                        {{ $monthlyRevenue[$m] }}, 
                    @endfor
                ],
                backgroundColor: '#ffc107'
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
    });
</script>
@endsection
