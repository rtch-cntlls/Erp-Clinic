<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Portal - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/admin-layout.css') }}">
</head>
<body>
    <div class="sidebar d-flex flex-column p-3">
        <div class="text-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 50px; margin-right: 10px;">
            <h4 class="fw-bold text-success mb-0">Pharmacist</h4>
        </div>
        <hr>
        <a href="{{ route('pharmacist.dashboard.index') }}" 
           class="{{ request()->routeIs('pharmacist.dashboard.index') ? 'active' : '' }}">
            <i class="bi bi-house"></i> Dashboard
        </a>
        <a href="{{ route('pharmacist.stock.index') }}" 
           class="{{ request()->routeIs('pharmacist.stock.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Inventory
        </a>
        <a href="{{ route('pharmacist.dispense.index') }}" 
           class="{{ request()->routeIs('pharmacist.dispense.*') ? 'active' : '' }}">
            <i class="bi bi-arrow-right-circle"></i> Dispense
        </a>
        <a href="{{ route('pharmacist.expiry.index') }}" 
           class="{{ request()->routeIs('pharmacist.expiry.*') ? 'active' : '' }}">
            <i class="bi bi-exclamation-triangle"></i> Expiring Soon
        </a>
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
