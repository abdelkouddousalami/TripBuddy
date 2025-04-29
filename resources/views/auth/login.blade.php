<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TripBuddy - Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #386641;
            --secondary-color: #6A994E;
            --accent-color: #A7C957;
            --light-color: #F2E8CF;
            --dark-accent: #BC4749;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(rgba(56, 102, 65, 0.7), rgba(106, 153, 78, 0.7)), url("{{ asset('img/hero.jpg') }}") no-repeat center center;
            background-size: cover;
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.5rem;
        }

        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }

        .navbar-nav .nav-link {
            color: var(--primary-color);
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: var(--secondary-color);
        }

        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .auth-container {
            width: 100%;
            max-width: 1200px;
            min-height: 600px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            overflow: hidden;
            display: flex;
        }

        .brand-section {
            width: 45%;
            padding: 3rem;
            background: var(--primary-color);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }

        .brand-section img {
            max-width: 200px;
            margin-bottom: 2rem;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .brand-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .brand-section p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 80%;
            margin: 0 auto;
        }

        .forms-section {
            width: 55%;
            padding: 3rem;
            position: relative;
            overflow: visible; 
        }

        .forms-container {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .auth-form {
            position: relative; 
            width: 100%;
            opacity: 1;
            transition: all 0.5s ease;
            transform: translateX(0);
            display: block;
        }

        .auth-form.register-form {
            display: none; 
        }

        .auth-form.fade-out {
            opacity: 0;
            transform: translateX(-100%);
            pointer-events: none;
        }

        .auth-form.fade-in {
            opacity: 1;
            transform: translateX(0);
            pointer-events: auto;
        }

        .form-switch {
            color: var(--primary-color);
            text-decoration: none;
            cursor: pointer;
            font-weight: 500;
            display: inline-block;
            position: relative;
        }

        .form-switch::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: var(--accent-color);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .form-switch:hover::after {
            transform: scaleX(1);
        }

        .form-control {
            border: 2px solid rgba(56, 102, 65, 0.2);
            padding: 0.8rem 1rem 0.8rem 3rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 5px 15px rgba(56, 102, 65, 0.1);
            transform: translateY(-2px);
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .form-control:focus + .input-icon {
            opacity: 1;
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
            padding: 0.8rem 2rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(56, 102, 65, 0.2);
        }

        @media (max-width: 991px) {
            .auth-container {
                flex-direction: column;
                min-height: auto;
                margin: 1rem;
                border-radius: 10px;
            }

            .brand-section, .forms-section {
                width: 100%;
                padding: 2rem 1rem;
            }

            .brand-section img {
                max-width: 150px;
                margin-bottom: 1rem;
            }

            .brand-section h1 {
                font-size: 1.8rem;
            }

            .brand-section p {
                font-size: 1rem;
            }

            .auth-form h2 {
                font-size: 1.5rem;
                margin-bottom: 1rem;
            }

            .form-control {
                font-size: 0.9rem;
                padding: 0.7rem 1rem;
            }

            .btn-primary {
                font-size: 0.9rem;
                padding: 0.7rem 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .auth-container {
                margin: 0;
                border-radius: 0;
                min-height: 100vh;
            }

            .brand-section {
                padding: 1.5rem 1rem;
            }

            .forms-section {
                padding: 1.5rem 1rem;
            }

            .form-control {
                font-size: 0.85rem;
                padding: 0.6rem 1rem;
            }

            .btn-primary {
                font-size: 0.85rem;
                padding: 0.6rem 1.2rem;
            }

            .navbar {
                padding: 0.5rem 1rem;
            }

            .navbar-brand {
                font-size: 1.2rem;
            }

            .navbar-brand img {
                height: 30px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('img/logo.png') }}" alt="TripBuddy Logo">
                TripBuddy
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <div class="auth-container">
            <div class="brand-section">
                <img src="{{ asset('img/logo.png') }}" alt="TripBuddy Logo">
                <h1>Welcome to TripBuddy</h1>
                <p>Connect with fellow travelers, share experiences, and explore the world together.</p>
            </div>

            <div class="forms-section">
                <div class="forms-container">
                    <div class="auth-form login-form">
                        <h2 class="mb-4">Sign In</h2>
                        
                        @if (session('error'))
                            <div class="alert alert-danger mb-4">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       name="email" placeholder="Email address" value="{{ old('email') }}" required>
                                <i class="fas fa-envelope input-icon"></i>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       name="password" placeholder="Password" required>
                                <i class="fas fa-lock input-icon"></i>
                                <button type="button" class="password-toggle" onclick="togglePassword(this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-4">
                                <i class="fas fa-sign-in-alt me-2"></i>Sign In
                            </button>
                        </form>

                        <div class="text-center">
                            <p>Don't have an account? 
                                <a class="form-switch" onclick="toggleForms()">Sign Up</a>
                            </p>
                        </div>
                    </div>

                    <div class="auth-form register-form">
                        <h2 class="mb-4">Create Account</h2>

                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       name="name" placeholder="Full Name" value="{{ old('name') }}" required>
                                <i class="fas fa-user input-icon"></i>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="input-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       name="email" placeholder="Email address" value="{{ old('email') }}" required>
                                <i class="fas fa-envelope input-icon"></i>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="input-group">
                                <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                       name="city" placeholder="City" value="{{ old('city') }}" required>
                                <i class="fas fa-map-marker-alt input-icon"></i>
                                @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       name="password" placeholder="Password" required>
                                <i class="fas fa-lock input-icon"></i>
                                <button type="button" class="password-toggle" onclick="togglePassword(this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="input-group">
                                <input type="password" class="form-control" 
                                       name="password_confirmation" placeholder="Confirm Password" required>
                                <i class="fas fa-lock input-icon"></i>
                                <button type="button" class="password-toggle" onclick="togglePassword(this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-4">
                                <i class="fas fa-user-plus me-2"></i>Create Account
                            </button>
                        </form>

                        <div class="text-center">
                            <p>Already have an account? 
                                <a class="form-switch" onclick="toggleForms()">Sign In</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleForms() {
            const loginForm = document.querySelector('.login-form');
            const registerForm = document.querySelector('.register-form');
            
            if (loginForm.style.display !== 'none') {
                loginForm.style.display = 'none';
                registerForm.style.display = 'block';
                
                registerForm.classList.add('fade-in');
                setTimeout(() => {
                    registerForm.classList.remove('fade-in');
                }, 500);
            } else {
                registerForm.style.display = 'none';
                loginForm.style.display = 'block';
                
                loginForm.classList.add('fade-in');
                setTimeout(() => {
                    loginForm.classList.remove('fade-in');
                }, 500);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.querySelector('.login-form');
            const registerForm = document.querySelector('.register-form');
            
            loginForm.style.display = 'block';
            registerForm.style.display = 'none';
        });

        function togglePassword(button) {
            const input = button.parentElement.querySelector('input');
            const icon = button.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>