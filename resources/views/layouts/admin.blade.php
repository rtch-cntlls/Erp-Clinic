<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic ERP - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/admin-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="sidebar d-flex flex-column p-3">
        <div class="d-flex justify-content-center align-items-center">
            <img src="{{ asset('images/logo.png') }}" alt="CarePoint Logo" style="width: 50px; height: auto; margin-right: 10px;">
            <h5 class="fw-bold text-primary mb-0">CarePoint</h5>
        </div>  <hr>      
        <a href="{{ route('admin.pages.dashboard.index') }}" class="{{ request()->routeIs('admin.pages.dashboard.index') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i> Dashboard
        </a>
        <a href="{{ route('admin.patients.index') }}" class="{{ request()->routeIs('admin.patients.*') ? 'active' : '' }}">
            <i class="bi bi-person"></i> Patients
        </a>
        <a href="{{ route('admin.appointments.index') }}" class="{{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
            <i class="bi bi-calendar"></i> Appointments
        </a>
        <a href="{{ route('admin.billing.index') }}" class="{{ request()->routeIs('admin.billing.*') ? 'active' : '' }}">
            <i class="bi bi-receipt"></i> Billing
        </a>
        <a href="{{ route('admin.pharmacy.index') }}" class="{{ request()->routeIs('admin.pharmacy.*') ? 'active' : '' }}">
            <i class="bi bi-capsule"></i> Pharmacy
        </a>
        <a href="{{ route('admin.pharmacists.index') }}" class="{{ request()->routeIs('admin.pharmacists.*') ? 'active' : '' }}">
            <i class="bi bi-person-workspace"></i> Pharmacists
        </a>
        <a href="{{ route('admin.inventory.index') }}" class="{{ request()->routeIs('admin.inventory.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Inventory
        </a>
        <a href="{{ route('admin.doctors.index') }}" class="{{ request()->routeIs('admin.doctors.*') ? 'active' : '' }}">
            <i class="bi bi-person-badge"></i> Doctors
        </a>
        <a href="#"><i class="bi bi-people"></i> HR</a>
        <a href="#"><i class="bi bi-graph-up"></i> Reports</a>
        <form action="" method="POST" class="mt-auto text-center">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm mt-3">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
