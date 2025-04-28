<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TripBuddy - Find Your Travel Companion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top" data-aos="fade-down">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('img/logo.png') }}" alt="TripBuddy Logo">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation items in the middle -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('trips.index') }}">Find Buddy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#destinations">Destinations</a>
                    </li>
                </ul>
                
                <!-- Auth buttons on the right -->
                <div class="auth-buttons">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Sign In</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
                    @else
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                                <li><a class="dropdown-item" href="{{ route('profile.show') }}">My Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('trips.create') }}">Post a Trip</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
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

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-background"></div>
        <div class="hero-blur-overlay"></div>
        <div class="container position-relative">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-8" data-aos="fade-right">
                    <div class="hero-content">
                        <h1 class="hero-title">Explore the World with New Friends</h1>
                        <p class="hero-subtitle">Connect with fellow travelers, share adventures, and create unforgettable memories together</p>
                        <div class="hero-buttons">
                            @auth
                                <a href="{{ route('trips.create') }}" class="btn btn-danger me-3">
                                    <i class="fas fa-plane-departure me-2"></i>Post a Trip
                                </a>
                                <a href="{{ route('trips.index') }}" class="btn btn-outline-light">
                                    <i class="fas fa-search me-2"></i>Find Trips
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-danger me-3">
                                    <i class="fas fa-sign-in-alt me-2"></i>Start Your Journey
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-outline-light">
                                    <i class="fas fa-user-plus me-2"></i>Join Our Community
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-stats">
                <div class="row g-4">
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="hero-stat-item">
                            <div class="hero-stat-number">10,000+</div>
                            <div class="hero-stat-label">Happy Travelers</div>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="hero-stat-item">
                            <div class="hero-stat-number">150+</div>
                            <div class="hero-stat-label">Destinations</div>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="hero-stat-item">
                            <div class="hero-stat-number">5,000+</</div>
                            <div class="hero-stat-label">Active Trips</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Hero Section Styles */
        .hero {
            position: relative;
            min-height: 100vh;
            overflow: hidden;
            margin-top: -76px; /* Adjust based on your navbar height */
            padding-top: 76px;
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("{{ asset('img/hero.jpg') }}") no-repeat center center;
            background-size: cover;
            transform: scale(1.1);
            filter: brightness(0.8);
            z-index: 1;
        }

        .hero-blur-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(8px);
            z-index: 2;
        }

        .container {
            position: relative;
            z-index: 3;
        }

        .hero-content {
            color: white;
            padding: 4rem 0;
            max-width: 800px;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            animation: fadeInDown 1s ease;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 2.5rem;
            opacity: 0.9;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 1s ease 0.3s;
            animation-fill-mode: both;
        }

        .hero-buttons {
            animation: fadeInUp 1s ease 0.6s;
            animation-fill-mode: both;
        }

        .hero-buttons .btn {
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .hero-buttons .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .hero-stats {
            margin-top: 2rem;
        }

        .hero-stat-item {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            color: white;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hero-stat-item:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }

        .hero-stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: linear-gradient(45deg, #fff, #f2e8cf);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-stat-label {
            font-size: 1.1rem;
            font-weight: 500;
            opacity: 0.9;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Navbar Styles */
        .navbar {
            background: rgba(255, 255, 255, 0.01);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar.scrolled .nav-link,
        .navbar.scrolled .navbar-brand {
            color: #2c3e50;
        }

        .navbar .nav-link {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .navbar .nav-link:hover {
            color: #fff;
            transform: translateY(-1px);
        }

        .navbar.scrolled .nav-link:hover {
            color: var(--primary-color);
        }

        .navbar-brand img {
            height: 40px;
            transition: all 0.3s ease;
        }

        .auth-buttons {
            display: flex;
            gap: 1rem;
        }

        .auth-buttons .btn {
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .navbar.scrolled .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .navbar.scrolled .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: rgba(255, 255, 255, 0.95);
                padding: 1rem;
                border-radius: 10px;
                margin-top: 0.5rem;
            }

            .navbar-collapse .nav-link {
                color: #2c3e50;
            }

            .auth-buttons {
                flex-direction: column;
                width: 100%;
            }

            .auth-buttons .btn {
                width: 100%;
            }
        }

        /* Responsive Styles */
        @media (max-width: 991.98px) {
            .hero-title {
                font-size: 3rem;
            }
            
            .hero-subtitle {
                font-size: 1.3rem;
            }
        }

        @media (max-width: 767.98px) {
            .hero-content {
                text-align: center;
                padding: 3rem 1rem;
            }
            
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
            }
            
            .hero-buttons .btn {
                padding: 0.875rem 1.75rem;
                font-size: 1rem;
            }
            
            .hero-stat-item {
                padding: 1.5rem;
            }
        }

        @media (max-width: 575.98px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .hero-buttons {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }
            
            .hero-buttons .btn {
                width: 100%;
                margin: 0 !important;
            }
        }
    </style>

    <!-- Booking Section -->
    <section id="booking" class="section bg-light">
        <div class="container">
            <h2 class="text-center mb-5" data-aos="fade-up">Find Your Perfect Stay</h2>
            <div class="row g-4">
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Hotels</h3>
                            <p class="card-text">Discover luxury hotels and resorts worldwide.</p>
                            <form>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Where do you want to go?">
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="date" class="form-control" placeholder="Check-in">
                                    </div>
                                    <div class="col">
                                        <input type="date" class="form-control" placeholder="Check-out">
                                    </div>
                                </div>
                                <button class="btn btn-primary w-100">Search Hotels</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Hostels</h3>
                            <p class="card-text">Find budget-friendly hostels and meet fellow travelers.</p>
                            <form>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Destination">
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="date" class="form-control" placeholder="Check-in">
                                    </div>
                                    <div class="col">
                                        <input type="date" class="form-control" placeholder="Check-out">
                                    </div>
                                </div>
                                <button class="btn btn-primary w-100">Search Hostels</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Find Buddy Section -->
    <section id="buddy" class="section">
        <div class="container">
            <h2 class="text-center mb-5" data-aos="fade-up">Find Your Travel Buddy</h2>
            <div class="row g-4">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                        <img src="{{ asset('img/paris.jpg') }}" class="card-img-top" alt="Traveler">
                        <div class="card-body">
                            <h5 class="card-title">Connect with Travelers</h5>
                            <p class="card-text">Find like-minded travelers heading to your destination.</p>
                            <a href="#" class="btn btn-outline-primary">Browse Travelers</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card">
                        <img src="{{ asset('img/tokyo.jpg') }}" class="card-img-top" alt="Adventure">
                        <div class="card-body">
                            <h5 class="card-title">Join Group Adventures</h5>
                            <p class="card-text">Participate in exciting group trips and activities.</p>
                            <a href="#" class="btn btn-outline-primary">Find Groups</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card">
                        <img src="{{ asset('img/bali.jpg') }}" class="card-img-top" alt="Friends">
                        <div class="card-body">
                            <h5 class="card-title">Create Your Trip</h5>
                            <p class="card-text">Plan your own trip and invite others to join.</p>
                            <a href="#" class="btn btn-outline-primary">Start Planning</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Destinations Section -->
    <section id="destinations" class="section bg-light">
        <div class="container">
            <h2 class="text-center mb-5" data-aos="fade-up">Popular Destinations</h2>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                        <img src="{{ asset('img/paris.jpg') }}" class="card-img-top" alt="Paris">
                        <div class="card-body">
                            <h5 class="card-title">Paris, France</h5>
                            <p class="card-text">The city of love and lights awaits you.</p>
                            <a href="#" class="btn btn-outline-primary">Explore</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card">
                        <img src="{{ asset('img/tokyo.jpg') }}" class="card-img-top" alt="Tokyo">
                        <div class="card-body">
                            <h5 class="card-title">Tokyo, Japan</h5>
                            <p class="card-text">Experience the perfect blend of tradition and future.</p>
                            <a href="#" class="btn btn-outline-primary">Explore</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card">
                        <img src="{{ asset('img/bali.jpg') }}" class="card-img-top" alt="Bali">
                        <div class="card-body">
                            <h5 class="card-title">Bali, Indonesia</h5>
                            <p class="card-text">Paradise island with rich culture and beauty.</p>
                            <a href="#" class="btn btn-outline-primary">Explore</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h4>TripBuddy</h4>
                    <p>Your ultimate travel companion for discovering new places and meeting amazing people.</p>
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h4>Quick Links</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none">About Us</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Contact</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Privacy Policy</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Terms of Service</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h4>Connect With Us</h4>
                    <div class="mt-3">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-4 bg-light">
            <div class="text-center">
                <p class="mb-0">&copy; 2025 TripBuddy. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init({
                duration: 1000,
                once: true,
                offset: 100
            });

            // Navbar scroll effect with smooth transition
            const navbar = document.querySelector('.navbar');
            let lastScroll = 0;
            
            function handleScroll() {
                const currentScroll = window.scrollY;
                
                if (currentScroll > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
                
                lastScroll = currentScroll;
            }

            // Add scroll event listener with throttling
            let ticking = false;
            window.addEventListener('scroll', function() {
                if (!ticking) {
                    window.requestAnimationFrame(function() {
                        handleScroll();
                        ticking = false;
                    });
                    ticking = true;
                }
            });

            // Initial check
            handleScroll();
        });
    </script>
</body>
</html>