<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .login-header {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #6366f1;
        }
        .info-text {
            font-size: 0.85rem;
            color: #6c757d;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card login-card">
                <div class="card-header bg-indigo text-white text-center login-header py-3" style="background-color:#6366f1;">
                    <h4>Admin Login</h4>
                </div>
                <div class="card-body p-4">

                    @if($errors->any())
                        <div class="alert alert-danger small" role="alert">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.login.post') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter your admin email" required>
                            <div class="info-text">Use the email registered for admin access.</div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
                            <div class="info-text">Minimum 8 characters. Keep it secure.</div>
                        </div>

                        <button type="submit" class="btn btn-indigo w-100 py-2" style="background-color:#6366f1;">Login</button>

                        <div class="mt-3 text-center">
                            <a href="#" class="text-decoration-none small" style="color:#6366f1;">Forgot Password?</a>
                        </div>
                    </form>

                </div>
                <div class="card-footer text-center small text-muted">
                    © 2025 Clinic ERP. All rights reserved.
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
