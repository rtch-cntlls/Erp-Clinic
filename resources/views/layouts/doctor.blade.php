<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Portal - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/admin-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/doctor.css') }}">
</head>
<body>
    <div class="d-flex">
        <div class="sidebar d-flex flex-column vh-100 p-3">
            <a href="{{ route('doctor.profile.index') }}" class="d-block text-center py-3 text-decoration-none">
                <img src="{{ $doctor->profile_image ? asset($doctor->profile_image) : asset('images/default-doctor.png') }}" 
                     alt="{{ $doctor->name }}" 
                     class="rounded-circle mb-2" 
                     style="width: 60px; height: 60px; object-fit: cover;">
                <h6 class="fw-bold text-primary mb-0">{{ $doctor->name }}</h6>
                <small class="text-muted">{{ $doctor->specialization }}</small>
            </a>            
            <hr>
            <a href="{{ route('doctor.dashboard.index') }}" class="{{ request()->routeIs('doctor.dashboard.index') ? 'active' : '' }}">
                <i class="bi bi-house-door"></i> Dashboard
            </a>
            <a href="{{ route('doctor.patients.index') }}" class="{{ request()->routeIs('doctor.patients.index') ? 'active' : '' }}">
                <i class="bi bi-person me-2"></i> Patients
            </a>
            <form action="" method="POST" class="mt-auto text-center">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm mt-3">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
        <div class="content flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
