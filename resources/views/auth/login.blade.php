<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TripBuddy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #386641;
            --secondary-color: #6A994E;
            --accent-color: #A7C957;
            --light-color: #F2E8CF;
            --dark-accent: #BC4749;
            --forest-green: #2D5A27;
            --leaf-green: #4A7856;
            --sunlight: #F9C80E;
        }

        body {
            background: linear-gradient(rgba(45, 90, 39, 0.7), rgba(74, 120, 86, 0.7)), url("{{ asset('img/hero.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
        }

        .auth-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            padding: 3rem;
            max-width: 650px;
            width: 95%;
            margin: 2rem auto;
            transform: translateY(20px);
            opacity: 0;
            animation: slideUp 0.6s ease forwards;
            border: 1px solid rgba(167, 201, 87, 0.2);
        }

        @keyframes slideUp {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .form-control {
            border: 2px solid rgba(106, 153, 78, 0.2);
            padding: 14px;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .form-control:focus {
            transform: translateY(-2px);
            border-color: var(--accent-color);
            box-shadow: 0 5px 15px rgba(167, 201, 87, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--secondary-color), var(--forest-green));
            border: none;
            padding: 14px 28px;
            font-weight: 600;
            letter-spacing: 0.5px;
            border-radius: 12px;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            font-size: 1.1rem;
        }

        .btn-primary:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(56, 102, 65, 0.3);
            background: linear-gradient(135deg, var(--forest-green), var(--secondary-color));
        }

        .btn-primary:hover:before {
            left: 100%;
        }

        .btn-primary:active {
            transform: translateY(-1px);
        }

        .form-label {
            font-weight: 500;
            color: var(--forest-green);
            font-size: 1.1rem;
            margin-bottom: 0.7rem;
        }

        .form-check-input:checked {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .auth-switch {
            color: var(--forest-green);
            text-decoration: none;
            font-weight: 500;
            position: relative;
            display: inline-block;
            padding: 2px;
        }

        .auth-switch::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: 0;
            left: 0;
            background: linear-gradient(90deg, var(--accent-color), var(--secondary-color));
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .auth-switch:hover::after {
            transform: scaleX(1);
        }

        .logo {
            max-width: 180px;
            margin-bottom: 2rem;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-20px);
            }
            60% {
                transform: translateY(-10px);
            }
        }

        h2 {
            color: var(--forest-green);
            font-size: 2.2rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .invalid-feedback {
            animation: shake 0.5s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
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

            @if (session('error'))
                <div class="alert alert-danger mb-4">
                    {{ session('error') }}
                </div>
            @endif

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