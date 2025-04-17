<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TripBuddy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #386641;
            --secondary-color: #6A994E;
            --accent-color: #A7C957;
            --light-color: #F2E8CF;
            --dark-accent: #BC4749;
        }

        body {
            background: linear-gradient(rgba(56, 102, 65, 0.7), rgba(56, 102, 65, 0.7)), url("{{ asset('img/hero.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
        }

        .auth-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 2rem;
            max-width: 500px;
            width: 90%;
            margin: 2rem auto;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(56, 102, 65, 0.25);
        }

        .auth-switch {
            color: var(--primary-color);
            text-decoration: none;
        }

        .auth-switch:hover {
            color: var(--dark-accent);
        }

        .logo {
            max-width: 150px;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body class="d-flex align-items-center">
    <div class="container">
        <div class="auth-container" id="authForm">
            <div class="text-center mb-4">
                <img src="{{ asset('img/logo.png') }}" alt="TripBuddy Logo" class="logo">
                <h2 class="mb-3">Welcome Back!</h2>
            </div>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" required>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
            </form>

            <div class="text-center">
                <p>Don't have an account? 
                    <a href="{{ route('register') }}" class="auth-switch">Register here</a>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>