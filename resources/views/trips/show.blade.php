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

        body {
            background-color: var(--light-color);
            min-height: 100vh;
            padding-top: 80px;
        }

        .trip-container {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .carousel-item img {
            height: 400px;
            object-fit: cover;
            border-radius: 15px;
        }

        .city-badge {
            background-color: var(--accent-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 1rem;
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
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 1rem;
        }

        .trip-details {
            background-color: var(--light-color);
            padding: 1rem;
            border-radius: 10px;
            margin: 1rem 0;
        }

        .trip-details i {
            color: var(--primary-color);
            width: 25px;
        }
    </style>
</head>
<body>
    @include('layouts.navigation')

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
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>