<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic ERP - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 220px;
            height: 100vh;
            position: fixed;
            background-color: #1e1e2f;
            color: #fff;
            transition: all 0.3s;
        }
        .sidebar h4 {
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 1rem;
            padding: 1rem 0;
            background-color: #27293d;
        }
        .sidebar a {
            color: #ced4da;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px 20px;
            font-weight: 500;
            border-radius: 8px;
            margin: 4px 10px;
            transition: all 0.2s;
        }
        .sidebar a i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        .sidebar a:hover {
            background-color: #343a50;
            color: #fff;
        }
        .sidebar .active {
            background-color: #6366f1;
            color: #fff;
        }
        .sidebar form button {
            width: 90%;
            margin: 0 auto;
            border-radius: 8px;
        }
        .content {
            margin-left: 220px;
            padding: 25px;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        }

        .card h5 {
            font-weight: 600;
        }
        @media(max-width: 768px){
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .content {
                margin-left: 0;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar d-flex flex-column">
        <h4 class="text-center">Clinic ERP</h4>
        <a href="{{ route('admin.pages.dashboard.index') }}" class="{{ request()->routeIs('admin.pages.dashboard.index') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i> Dashboard
        </a>
        <a href="{{ route('admin.patients.index') }}" class="{{ request()->routeIs('admin.patients.*') ? 'active' : '' }}">
            <i class="bi bi-person"></i> Patients
        </a>
        <a href=""><i class="bi bi-calendar-check"></i> Appointments</a>
        <a href=""><i class="bi bi-receipt"></i> Billing</a>
        <a href=""><i class="bi bi-capsule"></i> Pharmacy</a>
        <a href=""><i class="bi bi-box-seam"></i> Inventory</a>
        <a href=""><i class="bi bi-people"></i> HR</a>
        <a href=""><i class="bi bi-graph-up"></i> Reports</a>
        <form action="" method="POST" class="mt-auto mb-3 text-center">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-box-arrow-right"></i> Logout</button>
        </form>
    </div>
    <div class="content">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
