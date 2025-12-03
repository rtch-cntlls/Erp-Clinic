<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Clinic')</title>
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            scroll-behavior: smooth;
        }

        /* Navbar */
        .navbar { transition: 0.3s; }
        .navbar.scrolled { background: #fff !important; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }

        /* Hero */
        .hero {
            background: url('{{ asset('images/clinic-hero.jpg') }}') center/cover no-repeat;
            height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
            position: relative;
        }
        .hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.4);
        }
        .hero .container { position: relative; z-index: 2; }

        .section { padding: 80px 0; }

        .card:hover { transform: translateY(-5px); transition: all 0.3s ease; }

        footer { background: #1e1e1e; color: #fff; }

        .floating-contact {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1050;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #0d6efd;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            color: #fff;
            font-size: 1.5rem;
            transition: 0.3s;
        }
        .floating-contact:hover { background: #0b5ed7; }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm py-3">
        <div class="container">  
           <div class="d-flex align-items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" width="60">
                <a class="navbar-brand fw-bold fs-4" href="{{ url('/') }}">
                    <span style="color: #e60073;">Care</span><span style="color: #00bfff;">Point</span>
                </a>
           </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-medium" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-medium" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-medium" href="#contact">Contact</a>
                    </li>
                    @if(Auth::check())
                        <li class="nav-item dropdown ms-3">
                            <a class="nav-link text-dark fw-bold fs-5 d-flex align-items-center" href="#" id="patientDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="patientDropdown" style="min-width: 250px;">
                                <li class="text-center py-3">
                                    <i class="bi bi-person-circle me-1 fs-2"></i>
                                    <p class="m-0 fs-5">{{ Auth::user()->name }}</p>
                                    <p class="m-0 small">{{ Auth::user()->email }}</p>
                                </li>
                                <hr class="dropdown-divider">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center fs-6 py-2" href="">
                                        <i class="bi bi-calendar-check me-2"></i> My Appointments
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center fs-6 py-2" href="">
                                        <i class="bi bi-capsule me-2"></i> My Prescriptions
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center fs-6 py-2" href="">
                                        <i class="bi bi-file-earmark-medical me-2"></i> Medical Records
                                    </a>
                                </li>
                                <hr class="dropdown-divider">
                                <li>
                                    <form method="POST" action="{{ route('patient.logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item d-flex align-items-center fs-6 py-2 text-danger">
                                            <i class="bi bi-box-arrow-right me-2 fs-5"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item ms-3">
                            <a class="btn btn-outline-primary btn-sm rounded-pill px-4 shadow-sm" href="{{ route('patient.login.form') }}">
                                Login
                            </a>
                        </li>
                    @endif                
                </ul>                
            </div>        
        </div>
    </nav>
    
@yield('content')
<footer class="bg-dark text-white pt-5 pb-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold mb-3">About Our Clinic</h5>
                <p>Providing top-quality healthcare with a modern ERP system to manage appointments, pharmacy, and patient records efficiently.</p>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold mb-3">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#services" class="text-white text-decoration-none">Services</a></li>
                    <li><a href="#contact" class="text-white text-decoration-none">Contact</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Patient Login</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold mb-3">Contact Us</h5>
                <p><i class="bi bi-geo-alt me-2"></i>123 Health St, City, Country</p>
                <p><i class="bi bi-telephone me-2"></i>+123 456 7890</p>
                <p><i class="bi bi-envelope me-2"></i>info@clinic.com</p>
                <div class="mt-2">
                    <a href="#" class="text-white me-2 fs-5"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-2 fs-5"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-white me-2 fs-5"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white fs-5"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
        <hr class="bg-white">
        <div class="text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Our Clinic. All Rights Reserved.</p>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const navbar = document.querySelector('.navbar');
    window.addEventListener('scroll', () => {
        if(window.scrollY > 50) navbar.classList.add('scrolled');
        else navbar.classList.remove('scrolled');
    });
</script>
@stack('scripts')
</body>
</html>
