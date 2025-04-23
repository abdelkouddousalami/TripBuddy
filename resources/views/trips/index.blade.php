<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Travel Buddies - TripBuddy</title>
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
            --card-shadow: 0 10px 20px rgba(0,0,0,0.1);
            --hover-shadow: 0 15px 30px rgba(0,0,0,0.15);
            --transition: all 0.3s ease;
            --border-radius: 20px;
            --card-padding: 1.5rem;
            --glass-bg: rgba(255, 255, 255, 0.95);
        }

        body {
            background-color: #f8f9fa;
            padding-top: 70px;
        }

        /* Navbar styles */
        .navbar {
            height: 70px !important;
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1030;
        }

        /* Search Section */
        .search-section {
            background: linear-gradient(rgba(56, 102, 65, 0.9), rgba(56, 102, 65, 0.8)), 
                        url("{{ asset('img/hero.jpg') }}") center/cover no-repeat fixed;
            padding: 4rem 0;
            margin-bottom: 3rem;
            color: white;
            border-radius: 0 0 30px 30px;
        }

        .search-box {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: var(--border-radius);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .search-box .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            padding: 0.8rem 1.2rem;
            border-radius: 12px;
            font-size: 1rem;
        }

        .search-box .form-control:focus {
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.3);
        }

        /* Trips Grid */
        .trips-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            padding: 1rem;
        }

        .trip-card {
            background: var(--glass-bg);
            border: none;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .trip-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }

        .trip-image {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .trip-card .card-body {
            padding: var(--card-padding);
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .trip-title {
            color: var(--primary-color);
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .trip-meta {
            list-style: none;
            padding: 0;
            margin: 0 0 1.5rem 0;
            color: #666;
        }

        .trip-meta li {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .trip-meta i {
            width: 20px;
            color: var(--secondary-color);
            margin-right: 0.5rem;
        }

        .trip-footer {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid rgba(0,0,0,0.1);
        }

        .trip-footer .user-info {
            display: flex;
            align-items: center;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 0.8rem;
            object-fit: cover;
        }

        .user-name {
            font-weight: 600;
            color: var(--primary-color);
        }

        .btn {
            padding: 0.6rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(56, 102, 65, 0.2);
        }

        .filters {
            background: white;
            padding: 1.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            margin-bottom: 2rem;
        }

        .filter-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .filter-section {
            margin-bottom: 1.5rem;
        }

        .filter-section:last-child {
            margin-bottom: 0;
        }

        /* Pagination */
        .pagination {
            margin-top: 2rem;
            justify-content: center;
        }

        .page-link {
            color: var(--primary-color);
            border: none;
            margin: 0 0.3rem;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .page-item.active .page-link {
            background-color: var(--primary-color);
            color: white;
        }

        .page-link:hover {
            background-color: var(--light-color);
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .search-section {
                padding: 2rem 0;
            }

            .trips-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                padding: 0.5rem;
            }

            .trip-card {
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 576px) {
            .search-box {
                padding: 1rem;
            }

            .trip-meta {
                font-size: 0.9rem;
            }

            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
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

    <section class="search-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h1 class="text-center mb-4" data-aos="fade-up">Find Your Perfect Travel Buddy</h1>
                    <div class="search-box" data-aos="fade-up" data-aos-delay="100">
                        <form action="{{ route('trips.index') }}" method="GET">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="city" placeholder="Where to?" value="{{ request('city') }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="start_date" placeholder="Start Date" value="{{ request('start_date') }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="end_date" placeholder="End Date" value="{{ request('end_date') }}">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="filters" data-aos="fade-right">
                    <h4 class="filter-title">Filters</h4>
                    <form action="{{ route('trips.index') }}" method="GET">
                        <div class="filter-section">
                            <label class="mb-2">Budget Range</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" name="min_budget" placeholder="Min" value="{{ request('min_budget') }}">
                                <input type="number" class="form-control" name="max_budget" placeholder="Max" value="{{ request('max_budget') }}">
                            </div>
                        </div>

                        <div class="filter-section">
                            <label class="mb-2">Duration (Days)</label>
                            <select class="form-select" name="duration">
                                <option value="">Any</option>
                                <option value="1-7" {{ request('duration') == '1-7' ? 'selected' : '' }}>1-7 days</option>
                                <option value="8-14" {{ request('duration') == '8-14' ? 'selected' : '' }}>8-14 days</option>
                                <option value="15+" {{ request('duration') == '15+' ? 'selected' : '' }}>15+ days</option>
                            </select>
                        </div>

                        <div class="filter-section">
                            <label class="mb-2">Trip Type</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="type[]" value="adventure" id="adventure">
                                <label class="form-check-label" for="adventure">Adventure</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="type[]" value="cultural" id="cultural">
                                <label class="form-check-label" for="cultural">Cultural</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="type[]" value="relaxation" id="relaxation">
                                <label class="form-check-label" for="relaxation">Relaxation</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="trips-grid">
                    @forelse($trips as $trip)
                        <div class="trip-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            @if($trip->photo1)
                                <img src="{{ asset('storage/' . $trip->photo1) }}" class="trip-image" alt="{{ $trip->title }}">
                            @else
                                <img src="{{ asset('img/default-trip.jpg') }}" class="trip-image" alt="Default trip image">
                            @endif
                            
                            <div class="card-body">
                                <h5 class="trip-title">{{ $trip->title }}</h5>
                                <ul class="trip-meta">
                                    <li><i class="fas fa-map-marker-alt"></i> {{ $trip->city }}</li>
                                    <li><i class="fas fa-calendar"></i> {{ $trip->start_date->format('M d') }} - {{ $trip->end_date->format('M d, Y') }}</li>
                                    <li><i class="fas fa-users"></i> {{ $trip->buddies_needed }} buddies needed</li>
                                    <li><i class="fas fa-money-bill-wave"></i> Budget: ${{ $trip->budget }}</li>
                                </ul>
                                
                                <div class="trip-footer">
                                    <div class="user-info">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($trip->user->name) }}&background=random" 
                                             class="user-avatar" alt="{{ $trip->user->name }}">
                                        <span class="user-name">{{ $trip->user->name }}</span>
                                    </div>
                                    <a href="{{ route('trips.show', $trip) }}" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center" data-aos="fade-up">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                No trips found matching your criteria. Try adjusting your filters!
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="d-flex justify-content-center">
                    {{ $trips->links() }}
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
            offset: 50
        });
    </script>
</body>
</html>