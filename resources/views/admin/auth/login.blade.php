<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="container login-container">
        <div class="login-card shadow-lg rounded">
            <div class="login-image d-none d-md-flex flex-column justify-content-center align-items-center text-center text-white p-4" 
                 style="background: url('{{ asset('images/login.jpg') }}') center/cover no-repeat;">
            </div>
            <div class="login-form">
                <div class="text-center">
                    <img src="{{ asset('images/logo.png') }}" width="100" class="mb-2">
                    <h3 class="mb-4 fw-bold">
                        <span style="color: #e60073;">Care</span><span style="color: #00bfff;">Point</span> Login
                    </h3>                                  
                </div>
                @if($errors->any())
                    <div class="alert alert-danger small">{{ $errors->first() }}</div>
                @endif
                <form method="POST" action="{{ route('admin.login.post') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="fw-bold form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="btn btn-outline-primary w-100 mt-4">Login</button>
                    <div class="mt-3 text-center">
                        <a href="#" class="small">Forgot Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
