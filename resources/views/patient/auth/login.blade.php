@extends('layouts.patient')
@section('title', 'Patient Login / Sign Up')
@section('content')
<section class="section d-flex align-items-center justify-content-center" 
    style="min-height: 100vh; 
           background: linear-gradient(rgba(255,255,255,0.85), rgba(255,255,255,0.85)), 
                       url('{{ asset('images/hero.jpg') }}') center/cover no-repeat;">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg border-0 p-4 bg-white">
                    <div class="mb-3 text-center">
                        <h4 class="fw-meduim mb-2">Welcome to  
                            <span style="color: #e60073;">Care</span><span style="color: #00bfff;">Point</span> Clinic</h4>
                        <small class="text-muted mb-0">Please login or sign up to continue</small>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <ul class="nav nav-tabs mb-4 justify-content-center" id="authTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active fw-semibold text-primary" id="login-tab" 
                                    data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab">
                                Login
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-semibold text-success" id="signup-tab" 
                                    data-bs-toggle="tab" data-bs-target="#signup" type="button" role="tab">
                                Sign Up
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="authTabContent">
                        <div class="tab-pane fade show active" id="login" role="tabpanel">
                            <a href="{{ route('google.redirect') }}" 
                               class="btn btn-dark w-100 mb-3 rounded-pill shadow-sm d-flex align-items-center justify-content-center">
                                <i class="bi bi-google me-2"></i> Login with Google
                            </a><hr>
                            <form method="POST" action="{{ route('patient.login') }}">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control border-1" id="loginEmail" 
                                           name="email" placeholder="name@example.com" required>
                                    <label for="loginEmail">Email address</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control border-1" id="loginPassword" 
                                           name="password" placeholder="Password" required>
                                    <label for="loginPassword">Password</label>
                                </div><hr>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                                        <label class="form-check-label" for="rememberMe">Remember me</label>
                                    </div>
                                    <a href="" class="small text-decoration-none text-muted">
                                        Forgot Password?
                                    </a>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 rounded-pill shadow-sm">
                                    Login
                                </button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="signup" role="tabpanel">
                            <form method="POST" action="{{ route('patient.register') }}">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control border-1" id="fullName" name="name" 
                                           placeholder="Full Name" required>
                                    <label for="fullName">Full Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control border-1" id="signupEmail" name="email" 
                                           placeholder="name@example.com" required>
                                    <label for="signupEmail">Email address</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control border-1" id="signupPassword" name="password" 
                                           placeholder="Password" required>
                                    <label for="signupPassword">Password</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control border-1" id="signupPasswordConfirm" 
                                           name="password_confirmation" placeholder="Confirm Password" required>
                                    <label for="signupPasswordConfirm">Confirm Password</label>
                                </div><hr>
                                <button type="submit" class="btn btn-success w-100 rounded-pill shadow-sm">
                                    Sign Up
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
