<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Portal - @yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/admin-layout.css') }}">
</head>
<body>
    <div class="sidebar d-flex flex-column p-3">
        <div class="text-center mb-2">
            <img src="{{ asset('images/logo.png') }}" style="width: 50px;">
            <h4 class="fw-bold text-primary mb-0">Cashier</h4>
        </div>
        <hr>
        <a href="{{ route('cashier.dashboard.index') }}"
           class="{{ request()->routeIs('cashier.dashboard.index') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="{{ route('cashier.invoices.index') }}"
           class="{{ request()->routeIs('cashier.invoices.*') ? 'active' : '' }}">
            <i class="bi bi-receipt"></i> Invoices
        </a>

        <a href="{{ route('cashier.profile.index') }}"
           class="{{ request()->routeIs('cashier.profile.*') ? 'active' : '' }}">
            <i class="bi bi-person-circle"></i> Profile
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
