<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }}'s Profile - TripBuddy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <style>
        :root {
            --primary-color: #386641;
            --secondary-color: #6A994E;
            --accent-color: #A7C957;
            --light-color: #F2E8CF;
            --dark-accent: #BC4749;
        }

        body {
            background-color: var(--light-color);
            min-height: 100vh;
            overflow-x: hidden;
            padding-top: 76px; /* Added to account for fixed navbar */
        }

        .navbar {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-brand img {
            height: 40px;
        }

        .nav-link {
            color: var(--primary-color) !important;
            font-weight: 500;
        }

        .nav-link:hover {
            color: var(--accent-color) !important;
        }

        .profile-header {
            background: linear-gradient(rgba(56, 102, 65, 0.9), rgba(56, 102, 65, 0.9)), url("{{ asset('img/hero.jpg') }}") no-repeat center center;
            background-size: cover;
            color: white;
            padding: 100px 0 50px;
            margin-top: 60px;
            position: relative;
            overflow: hidden;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at center, transparent 0%, rgba(0,0,0,0.3) 100%);
            z-index: 1;
        }

        .profile-header .container {
            position: relative;
            z-index: 2;
        }

        .profile-header h1 {
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            transform: translateY(20px);
            opacity: 0;
            animation: fadeInUp 0.6s ease forwards;
        }

        .profile-header p {
            transform: translateY(20px);
            opacity: 0;
            animation: fadeInUp 0.6s ease 0.2s forwards;
        }

        @keyframes fadeInUp {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .profile-stats {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-top: -50px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transform: translateY(30px);
            opacity: 0;
            animation: slideUp 0.6s ease 0.4s forwards;
        }

        @keyframes slideUp {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .user-info {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .user-info:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: -100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .btn-primary:hover::after {
            left: 100%;
        }

        .trip-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            height: 100%;
            transform: scale(0.98);
            opacity: 0.9;
        }

        .trip-card:hover {
            transform: scale(1) translateY(-10px);
            opacity: 1;
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        .trip-image {
            height: 200px;
            object-fit: cover;
            transition: all 0.4s ease;
        }

        .trip-card:hover .trip-image {
            transform: scale(1.05);
        }

        .stat-box {
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            background: var(--light-color);
            margin-bottom: 10px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .stat-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.8), transparent);
            transform: translateX(-100%);
            transition: 0.6s;
        }

        .stat-box:hover::before {
            transform: translateX(100%);
        }

        .stat-box i {
            font-size: 24px;
            color: var(--primary-color);
            margin-bottom: 10px;
            transition: transform 0.3s ease;
        }

        .stat-box:hover i {
            transform: scale(1.2);
        }

        .stat-box h3 {
            color: var(--dark-accent);
            font-weight: bold;
            margin: 10px 0;
        }

        .alert {
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .user-info i {
            transition: transform 0.3s ease;
        }

        .user-info:hover i {
            transform: scale(1.2) rotate(360deg);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('img/logo.png') }}" alt="TripBuddy Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('trips.index') }}">Trips</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('profile.show') }}">Profile</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="profile-header text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h1 class="display-4">{{ $user->name }}</h1>
                    <p class="lead"><i class="fas fa-map-marker-alt"></i> {{ $user->city }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('success'))
                    <div class="alert alert-success mt-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="profile-stats mb-4" data-aos="fade-up">
                    <div class="row text-center">
                        <div class="col">
                            <div class="stat-box">
                                <i class="fas fa-map-marked-alt"></i>
                                <h3>{{ $trips->count() }}</h3>
                                <p class="text-muted mb-0">Trips Posted</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="stat-box">
                                <i class="fas fa-calendar-alt"></i>
                                <h3>{{ $user->created_at->format('M Y') }}</h3>
                                <p class="text-muted mb-0">Joined</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="stat-box">
                                <i class="fas fa-user-edit"></i>
                                <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                                    Edit Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="user-info mb-4" data-aos="fade-up" data-aos-delay="200">
                    <h4>About Me</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <p><i class="fas fa-envelope text-primary"></i> {{ $user->email }}</p>
                            <p><i class="fas fa-map-marker-alt text-primary"></i> {{ $user->city }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><i class="fas fa-calendar text-primary"></i> Member since {{ $user->created_at->format('F j, Y') }}</p>
                            <p><i class="fas fa-plane text-primary"></i> {{ $trips->count() }} trips planned</p>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3" data-aos="fade-up" data-aos-delay="300">
                        <h2>My Trip Announcements</h2>
                        <a href="{{ route('trips.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> New Trip
                        </a>
                    </div>

                    @if($trips->isEmpty())
                        <div class="alert alert-info" data-aos="fade-up" data-aos-delay="400">
                            You haven't posted any trips yet. Start by creating your first trip!
                        </div>
                    @else
                        <div class="row g-4">
                            @foreach($trips as $trip)
                                <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 + 400 }}">
                                    <div class="card trip-card">
                                        @if($trip->photo1)
                                            <img src="{{ asset('storage/' . $trip->photo1) }}" class="card-img-top trip-image" alt="{{ $trip->title }}">
                                        @endif
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $trip->title }}</h5>
                                            <p class="card-text">
                                                <i class="fas fa-map-marker-alt text-primary"></i> {{ $trip->city }}<br>
                                                <i class="fas fa-users text-primary"></i> Looking for {{ $trip->buddies_needed }} buddies<br>
                                                <i class="fas fa-calendar text-primary"></i> {{ $trip->start_date->format('M d, Y') }} - {{ $trip->end_date->format('M d, Y') }}
                                            </p>
                                            <div class="d-flex justify-content-between mt-auto">
                                                <a href="{{ route('trips.show', $trip) }}" class="btn btn-outline-primary">View Details</a>
                                                <a href="{{ route('trips.edit', $trip) }}" class="btn btn-outline-secondary">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
    </script>
</body>
</html>