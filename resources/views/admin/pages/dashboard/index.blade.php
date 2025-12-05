@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('content')
<div class="container">
    <div class="row align-items-center mb-4 bg-light shadow-sm">
        <div class="col-md-4 text-center text-md-start">
            <img src="{{ asset('images/header.png') }}" alt="Welcome" class="img-fluid">
        </div>
        <div class="col-md-8 mt-3 mt-md-0">
            <h2 class="fw-bold" style="color: #00bfff;">Welcome Back, Admin!</h2>
            <p class=" text-muted">
                Here’s a quick overview of your clinic’s activities. Check patients, staff, and statistics at a glance.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
             <div class="row g-3">
                 @foreach($cards as $card)
                     <div class="col-md-6">
                         <div class="card border-0 shadow-sm p-3 transition-hover">
                            <div class="d-flex align-items-center mb-3 gap-3">
                                <div class="icon-wrapper fs-5">
                                    <i class="bi {{ $card['icon'] }} {{ $card['color'] }}"></i>
                                </div>
                                <h6 class="mb-0 text-uppercase fw-bold">{{ $card['title'] }}</h6>
                            </div>
                            <div class="d-flex align-items-end justify-content-between">
                                <h4 class="fw-bold mb-0">{{ $card['value'] }}</h4>
                                <div class="bar-chart d-flex align-items-end gap-1">
                                    <div class="bar" style="height: 80%;"></div>
                                    <div class="bar" style="height: 60%;"></div>
                                    <div class="bar" style="height: 70%;"></div>
                                    <div class="bar" style="height: 90%;"></div>
                                </div>
                            </div>
                            @if(isset($card['route']))
                                <a href="{{ $card['route'] }}" class=" mt-3 small text-decoration-none text-primary">View All &raquo;</a>
                            @endif
                         </div>
                     </div>
                 @endforeach
             </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-3">
                <h6 class="fw-bold mb-3">Patient Gender Distribution</h6>
                <canvas id="genderChart" height="200"></canvas>
                <div class="mt-3 d-flex justify-content-between">
                    <div>
                        <span class="fw-bold">Male:</span> {{ $malePatients }} 
                        <span class="text-success">({{ $maleGrowth }}% vs last week)</span>
                    </div>
                    <div>
                        <span class="fw-bold">Female:</span> {{ $femalePatients }} 
                        <span class="text-success">({{ $femaleGrowth }}% vs last week)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('genderChart').getContext('2d');
const genderChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Male', 'Female'],
        datasets: [{
            label: 'Patients',
            data: [{{ $malePatients }}, {{ $femalePatients }}],
            backgroundColor: ['#0d6efd', '#d63384'],
            borderRadius: 6
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.parsed.y + ' Patients';
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 5 }
            }
        }
    }
});
</script>
@endsection
