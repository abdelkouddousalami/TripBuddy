<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Travel Buddies - TripBuddy</title>
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
            background-color: var(--light-color);
            min-height: 100vh;
            padding-top: 80px;
        }

        .search-section {
            background: linear-gradient(rgba(56, 102, 65, 0.9), rgba(56, 102, 65, 0.9)), url("{{ asset('img/hero.jpg') }}") no-repeat center center;
            background-size: cover;
            padding: 60px 0;
            margin-top: -80px;
            margin-bottom: 40px;
            color: white;
        }

        .trip-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease;
            height: 100%;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .trip-card:hover {
            transform: translateY(-10px);
        }

        .trip-image {
            height: 250px;
            object-fit: cover;
        }

        .carousel-item img {
            height: 250px;
            object-fit: cover;
        }

        .author-info {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .author-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            background-color: var(--accent-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .search-form .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.25rem rgba(167, 201, 87, 0.25);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .city-badge {
            background-color: var(--accent-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <!-- Search Section -->
    <section class="search-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h1 class="display-4 mb-4">Find Your Travel Buddy</h1>
                    <form class="search-form">
                        <div class="row g-3">
                            <div class="col-md-5">
                                <input type="text" class="form-control form-control-lg" placeholder="Destination city">
                            </div>
                            <div class="col-md-5">
                                <input type="date" class="form-control form-control-lg" placeholder="Travel date">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-lg w-100">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Trips Grid -->
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-8">
                <h2>Latest Trip Announcements</h2>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('trips.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Post Your Trip
                </a>
            </div>
        </div>

        <div class="row g-4">
            @forelse($trips as $trip)
                <div class="col-md-6 col-lg-4">
                    <div class="trip-card">
                        @if($trip->photo2 || $trip->photo3)
                            <div id="carousel{{ $trip->id }}" class="carousel slide" data-bs-ride="carousel">
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
                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $trip->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $trip->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @else
                            <img src="{{ asset('storage/' . $trip->photo1) }}" class="trip-image w-100" alt="{{ $trip->title }}">
                        @endif

                        <div class="card-body">
                            <div class="author-info">
                                <div class="author-avatar">
                                    {{ substr($trip->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ $trip->user->name }}</h6>
                                    <small class="text-muted">{{ $trip->created_at->diffForHumans() }}</small>
                                </div>
                            </div>

                            <h5 class="card-title">{{ $trip->title }}</h5>
                            <div class="city-badge">
                                <i class="fas fa-map-marker-alt"></i> {{ $trip->city }}
                            </div>
                            <p class="card-text">{{ Str::limit($trip->description, 100) }}</p>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-users text-primary"></i>
                                    <span class="ms-1">{{ $trip->buddies_needed }} buddies needed</span>
                                </div>
                                <a href="{{ route('trips.show', $trip) }}" class="btn btn-outline-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        No trip announcements found. Be the first to <a href="{{ route('trips.create') }}">post a trip</a>!
                    </div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $trips->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>