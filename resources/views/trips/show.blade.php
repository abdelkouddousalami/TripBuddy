<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $trip->title }} - TripBuddy</title>
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

        /* Navbar Styles */
        .navbar {
            height: 105px !important;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            padding: 1rem 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
        }

        .navbar-brand img {
            height: 80px;
        }

        .navbar.scrolled {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            background: var(--light-color);
        }

        .nav-link {
            position: relative;
            overflow: hidden;
            color: var(--primary-color) !important;
            font-weight: 500;
            margin: 0 0.5rem;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: -100%;
            width: 100%;
            height: 2px;
            background: var(--dark-accent);
            transition: 0.3s ease;
        }

        .nav-link:hover::after {
            left: 0;
        }

        .auth-buttons .btn {
            margin-left: 0.5rem;
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(56, 102, 65, 0.7), rgba(56, 102, 65, 0.7)), url("{{ asset('img/hero.jpg') }}") no-repeat center center;
            background-size: cover;
            color: var(--light-color);
        }

        /* Button Styles */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var (--secondary-color);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: var(--light-color);
        }

        .btn-danger {
            background-color: var(--dark-accent);
            border-color: var(--dark-accent);
        }

        /* Section Styles */
        .section {
            padding: 100px 0;
        }

        .section.bg-light {
            background-color: var(--light-color) !important;
        }

        .card {
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            background-color: white;
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
            object-position: center;
        }

        .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 1.5rem;
        }

        .card-text {
            flex: 1;
            margin-bottom: 1rem;
        }

        /* Section specific card styles */
        #booking .card {
            min-height: 400px;
        }

        #buddy .card, #destinations .card {
            min-height: 450px;
        }

        /* Form styles in booking section */
        #booking form {
            margin-top: auto;
        }

        /* Make all buttons align at bottom */
        .card .btn {
            margin-top: auto;
        }

        /* Section padding consistency */
        .section {
            padding: 100px 0;
        }

        .row.g-4 {
            --bs-gutter-y: 2rem;
        }

        /* Footer */
        .footer {
            background: var(--primary-color);
            color: var(--light-color);
            padding: 60px 0;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--secondary-color);
            margin: 0 10px;
            transition: 0.3s ease;
            color: var(--light-color);
        }

        .social-icon:hover {
            background: var(--dark-accent);
            transform: translateY(-5px);
            color: var(--light-color);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top" data-aos="fade-down">
        <div class="container">
            <!-- Logo on the left -->
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/logo.png') }}" alt="TripBuddy Logo">
            </a>
            
            <!-- Hamburger menu for mobile -->
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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="trip-container">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-4">
                        @if($trip->photo2 || $trip->photo3)
                            <div id="tripCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{ asset('storage/' . $trip->photo1) }}" class="d-block w-100" alt="Trip photo">
                                    </div>
                                    @if($trip->photo2)
                                        <div class="carousel-item">
                                            <img src="{{ asset('storage/' . $trip->photo2) }}" class="d-block w-100" alt="Trip photo">
                                        </div>
                                    @endif
                                    @if($trip->photo3)
                                        <div class="carousel-item">
                                            <img src="{{ asset('storage/' . $trip->photo3) }}" class="d-block w-100" alt="Trip photo">
                                        </div>
                                    @endif
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#tripCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#tripCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @else
                            <img src="{{ asset('storage/' . $trip->photo1) }}" class="d-block w-100 rounded" style="height: 400px; object-fit: cover;" alt="{{ $trip->title }}">
                        @endif
                    </div>

                    <div class="author-info">
                        <div class="author-avatar">
                            {{ substr($trip->user->name, 0, 1) }}
                        </div>
                        <div>
                            <h6 class="mb-0">{{ $trip->user->name }}</h6>
                            <small class="text-muted">Posted {{ $trip->created_at->diffForHumans() }}</small>
                        </div>
                    </div>

                    <h1 class="mb-3">{{ $trip->title }}</h1>
                    
                    <div class="city-badge">
                        <i class="fas fa-map-marker-alt"></i> {{ $trip->city }}
                    </div>

                    <div class="trip-details">
                        <div class="row">
                            <div class="col-md-6">
                                <p><i class="fas fa-users"></i> Looking for {{ $trip->buddies_needed }} buddies</p>
                                <p><i class="fas fa-calendar"></i> From {{ $trip->start_date->format('M d, Y') }}</p>
                                <p><i class="fas fa-calendar-alt"></i> To {{ $trip->end_date->format('M d, Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><i class="fas fa-clock"></i> Duration: {{ $trip->start_date->diffInDays($trip->end_date) + 1 }} days</p>
                                <p><i class="fas fa-user"></i> Posted by {{ $trip->user->name }}</p>
                                <p><i class="fas fa-map-pin"></i> From {{ $trip->user->city }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h4>Trip Description</h4>
                        <p class="lead">{{ $trip->description }}</p>
                    </div>

                    @if(Auth::id() === $trip->user_id)
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('trips.edit', $trip) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit Trip
                            </a>
                            <form action="{{ route('trips.destroy', $trip) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this trip?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Delete Trip
                                </button>
                            </form>
                        </div>
                    @endif

                    <!-- Comments Section -->
                    <div class="mt-5">
                        <h4 class="mb-4">Comments</h4>
                        
                        <!-- Comment Form -->
                        <form action="{{ route('comments.store', $trip) }}" method="POST" class="mb-4">
                            @csrf
                            <div class="form-group">
                                <textarea name="content" class="form-control @error('content') is-invalid @enderror" 
                                          rows="3" placeholder="Share your thoughts about this trip..."></textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">
                                <i class="fas fa-paper-plane"></i> Post Comment
                            </button>
                        </form>

                        <!-- Comments List -->
                        <div class="comments-list">
                            @forelse($trip->comments()->with('user')->latest()->get() as $comment)
                                <div class="comment card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="mb-1">
                                                <i class="fas fa-user-circle"></i>
                                                {{ $comment->user->name }}
                                                <small class="text-muted">
                                                    {{ $comment->created_at->diffForHumans() }}
                                                </small>
                                            </h6>
                                            @if(Auth::id() === $comment->user_id)
                                                <form action="{{ route('comments.destroy', $comment) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger p-0">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                        <p class="mb-0 mt-2">{{ $comment->content }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-muted">
                                    No comments yet. Be the first to comment!
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>