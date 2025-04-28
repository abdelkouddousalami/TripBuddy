<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'TripBuddy') }}</title>
    
    <!-- Third-party CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    
    <!-- Base styles -->
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    
    <!-- Page specific styles -->
    @if(Request::is('/'))
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    @endif
    
    @if(Request::is('trips'))
        <link href="{{ asset('css/trips.css') }}" rel="stylesheet">
    @endif
    
    @if(Request::is('trips/create'))
        <link href="{{ asset('css/create.css') }}" rel="stylesheet">
    @endif
    
    @if(Request::is('trips/*') && !Request::is('trips/create'))
        <link href="{{ asset('css/show.css') }}" rel="stylesheet">
    @endif
    
    @if(Request::is('login') || Request::is('register'))
        <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    @endif
    
    @if(Request::is('profile*'))
        <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    @endif
    
    @if(Request::is('hotels*'))
        <link href="{{ asset('css/hotels.css') }}" rel="stylesheet">
    @endif
    
    <!-- Additional styles -->
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('img/logo.png') }}" alt="TripBuddy Logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('trips.*') ? 'active' : '' }}" href="{{ route('trips.index') }}">Find Buddy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#destinations">Destinations</a>
                    </li>
                </ul>
                
                <div class="auth-buttons">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Sign In</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
                    @else
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.show') }}">My Profile</a></li>
                                @if(Auth::user()->role === 'owner')
                                    <li><a class="dropdown-item" href="{{ route('hotels.owner-dashboard') }}">Hotel Dashboard</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('trips.create') }}">Post a Trip</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });

        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.querySelector('.navbar');
            const navbarCollapse = document.querySelector('.navbar-collapse');
            const navLinks = document.querySelectorAll('.nav-link');
            const navbarToggler = document.querySelector('.navbar-toggler');
            let isMenuOpen = false;

            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
                } else {
                    navbar.style.boxShadow = 'none';
                }
            });

            navbarToggler.addEventListener('click', function() {
                isMenuOpen = !isMenuOpen;
                if (isMenuOpen) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = 'auto';
                }
            });

            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 992 && isMenuOpen) {
                        navbarToggler.click();
                    }
                });
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!navbar.contains(e.target) && isMenuOpen) {
                    navbarToggler.click();
                }
            });

            // Reset menu state on window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 992) {
                    navbarCollapse.classList.remove('show');
                    document.body.style.overflow = 'auto';
                    isMenuOpen = false;
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>