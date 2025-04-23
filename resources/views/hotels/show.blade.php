@extends('layouts.app')

@section('content')
<div class="hotel-details-section py-5">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('hotels.index') }}">Hotels & Hostels</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $hotel->name }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-8">
                <!-- Main content -->
                <div class="card shadow-sm mb-4">
                    <div class="hotel-photos">
                        <div id="hotelPhotos" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#hotelPhotos" data-bs-slide-to="0" class="active"></button>
                                @if($hotel->photo2)
                                    <button type="button" data-bs-target="#hotelPhotos" data-bs-slide-to="1"></button>
                                @endif
                                @if($hotel->photo3)
                                    <button type="button" data-bs-target="#hotelPhotos" data-bs-slide-to="2"></button>
                                @endif
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ Storage::url($hotel->photo1) }}" class="d-block w-100" alt="{{ $hotel->name }}">
                                </div>
                                @if($hotel->photo2)
                                    <div class="carousel-item">
                                        <img src="{{ Storage::url($hotel->photo2) }}" class="d-block w-100" alt="{{ $hotel->name }}">
                                    </div>
                                @endif
                                @if($hotel->photo3)
                                    <div class="carousel-item">
                                        <img src="{{ Storage::url($hotel->photo3) }}" class="d-block w-100" alt="{{ $hotel->name }}">
                                    </div>
                                @endif
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#hotelPhotos" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#hotelPhotos" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h1 class="mb-2">{{ $hotel->name }}</h1>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    {{ $hotel->address }}, {{ $hotel->city }}
                                </p>
                            </div>
                            <span class="badge bg-primary">{{ ucfirst($hotel->type) }}</span>
                        </div>

                        <div class="description-section mb-4">
                            <h4 class="section-title">About This Property</h4>
                            <p class="text-muted">{{ $hotel->description }}</p>
                        </div>

                        <hr>

                        <div class="amenities-section mb-4">
                            <h4 class="section-title">Amenities</h4>
                            <div class="row g-3">
                                <div class="col-6 col-md-4">
                                    <div class="amenity-item">
                                        <i class="fas fa-wifi text-primary me-2"></i>
                                        Free WiFi
                                    </div>
                                </div>
                                <div class="col-6 col-md-4">
                                    <div class="amenity-item">
                                        <i class="fas fa-parking text-primary me-2"></i>
                                        Parking Available
                                    </div>
                                </div>
                                <div class="col-6 col-md-4">
                                    <div class="amenity-item">
                                        <i class="fas fa-utensils text-primary me-2"></i>
                                        Restaurant
                                    </div>
                                </div>
                                <!-- Add more amenities as needed -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews section -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="section-title mb-4">Reviews</h4>
                        <div class="text-center py-4">
                            <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                            <p>Reviews coming soon!</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Sidebar -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="owner-info mb-4">
                            <h4 class="section-title">Property Owner</h4>
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($hotel->user->name) }}&background=random" 
                                     class="avatar me-3" alt="{{ $hotel->user->name }}">
                                <div>
                                    <h5 class="mb-1">{{ $hotel->user->name }}</h5>
                                    <p class="text-muted mb-0">Member since {{ $hotel->user->created_at->format('M Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="contact-section">
                            <h4 class="section-title mb-3">Contact Property</h4>
                            <form class="needs-validation" novalidate>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" id="message" rows="4" required
                                              placeholder="Write your message..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="section-title mb-3">Location</h4>
                        <div class="map-placeholder rounded" style="background-color: #e9ecef; height: 200px;">
                            <div class="d-flex align-items-center justify-content-center h-100 text-muted">
                                <div class="text-center">
                                    <i class="fas fa-map-marked-alt fa-3x mb-2"></i>
                                    <p class="mb-0">Map coming soon!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hotel-details-section {
    background-color: #f8f9fa;
    min-height: 100vh;
}

.hotel-photos {
    position: relative;
    border-radius: 15px 15px 0 0;
    overflow: hidden;
}

.carousel-item img {
    height: 400px;
    object-fit: cover;
}

.section-title {
    color: var(--primary-color);
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.amenity-item {
    padding: 0.75rem;
    background-color: #f8f9fa;
    border-radius: 8px;
    font-size: 0.95rem;
}

.avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

.badge {
    padding: 0.5rem 1rem;
    font-weight: 500;
}

@media (max-width: 768px) {
    .carousel-item img {
        height: 300px;
    }
}
</style>
@endsection