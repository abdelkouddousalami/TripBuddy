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
            
            <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('trips.index') ? 'active' : '' }}" href="{{ route('trips.index') }}">
                            <i class="fas fa-search me-1"></i>Find Buddy
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#destinations">
                            <i class="fas fa-map-marker-alt me-1"></i>Destinations
                        </a>
                    </li>
                </ul>
                
                <div class="auth-buttons">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">
                            <i class="fas fa-sign-in-alt me-2"></i>Sign In
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary">
                            <i class="fas fa-user-plus me-2"></i>Sign Up
                        </a>
                    @else
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-2"></i>{{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                                        <i class="fas fa-user me-2"></i>My Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('trips.create') }}">
                                        <i class="fas fa-plus-circle me-2"></i>Post a Trip
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

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

            
        </div>
    </section>

    <section id="features" class="section bg-light">
        <div class="container">
            <h2 class="text-center mb-5" data-aos="fade-up">Why Choose TripBuddy</h2>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card text-center">
                        <div class="feature-icon mb-4">
                            <i class="fas fa-users fa-3x text-primary"></i>
                        </div>
                        <h4>Connect with Travelers</h4>
                        <p>Meet like-minded explorers and share incredible adventures together</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card text-center">
                        <div class="feature-icon mb-4">
                            <i class="fas fa-map-marked-alt fa-3x text-success"></i>
                        </div>
                        <h4>Curated Destinations</h4>
                        <p>Explore hand-picked destinations and hidden gems worldwide</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card text-center">
                        <div class="feature-icon mb-4">
                            <i class="fas fa-shield-alt fa-3x text-danger"></i>
                        </div>
                        <h4>Safe & Secure</h4>
                        <p>Verified profiles and secure messaging for peace of mind</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-card text-center">
                        <div class="feature-icon mb-4">
                            <i class="fas fa-calendar-alt fa-3x text-warning"></i>
                        </div>
                        <h4>Easy Planning</h4>
                        <p>Simple tools to plan and organize your perfect trip</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="500">
                <a href="{{ route('trips.index') }}" class="btn btn-primary btn-lg">Start Exploring</a>
            </div>
        </div>
    </section>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="{{ asset('js/home.js') }}"></script>
</body>
</html>