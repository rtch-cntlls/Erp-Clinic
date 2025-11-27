@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid py-4">
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="p-4 rounded-4 shadow-sm text-center" style="background-color: #eef6fb;">
                <h6 class="text-muted mb-2">Total Patients</h6>
                <h3 class="fw-bold">128</h3>
                <i class="bi bi-people-fill fs-3 text-primary"></i>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-4 rounded-4 shadow-sm text-center" style="background-color: #fef6f6;">
                <h6 class="text-muted mb-2">Total Doctors</h6>
                <h3 class="fw-bold">12</h3>
                <i class="bi bi-person-badge-fill fs-3 text-danger"></i>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-4 rounded-4 shadow-sm text-center" style="background-color: #f6fef6;">
                <h6 class="text-muted mb-2">Appointments Today</h6>
                <h3 class="fw-bold">18</h3>
                <i class="bi bi-calendar-check-fill fs-3 text-success"></i>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-4 rounded-4 shadow-sm text-center" style="background-color: #fff7e6;">
                <h6 class="text-muted mb-2">Revenue This Month</h6>
                <h3 class="fw-bold">₱4,520.50</h3>
                <span class="fs-3 text-warning">₱</span>
            </div>
        </div>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="p-4 rounded-4 shadow-sm" style="background-color: #ffffff;">
                <h5 class="fw-semibold text-primary mb-3"><i class="bi bi-bar-chart-line me-2"></i>Monthly Visits</h5>
                <canvas id="visitsChart" height="200"></canvas>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="p-4 rounded-4 shadow-sm" style="background-color: #ffffff;">
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
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Matt
                        <span class="badge bg-info text-dark">Nov 28, 2025 09:00</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Marlon
                        <span class="badge bg-info text-dark">Nov 28, 2025 10:30</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Trax
                        <span class="badge bg-info text-dark">Nov 28, 2025 11:00</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="p-4 rounded-4 shadow-sm" style="background-color: #f9f9f9;">
                <h5 class="fw-semibold text-primary mb-3"><i class="bi bi-people-fill me-2"></i>New Patients This Month</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Matt
                        <span class="text-muted small">Nov 05</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Trax
                        <span class="text-muted small">Nov 12</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Marlon
                        <span class="text-muted small">Nov 18</span>
                    </li>
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
                data: [12, 15, 18, 20, 25, 30, 28, 32, 35, 40, 38, 45],
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13,110,253,0.1)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets: [{
                label: 'Revenue',
                data: [1200, 1500, 1800, 2000, 2500, 3000, 2800, 3200, 3500, 4000, 3800, 4520.5],
                backgroundColor: '#ffc107'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@endsection
