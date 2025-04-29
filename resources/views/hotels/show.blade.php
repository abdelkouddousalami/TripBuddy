@extends('layouts.app')

@section('content')
<link href="{{ asset('css/show.css') }}" rel="stylesheet">
<div class="hotel-details">
    <div class="hotel-header">
        <div id="hotelPhotos" class="carousel slide" data-bs-ride="false">
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
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#hotelPhotos" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
        
        <div class="header-content">
            <div class="container">
                <span class="property-badge">{{ ucfirst($hotel->type) }}</span>
                <div class="hotel-title-section">
                    <h1>{{ $hotel->name }}</h1>
                    <div class="hotel-meta">
                        <div class="location">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            {{ $hotel->city }}
                        </div>
                        <div class="rating">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= 4 ? 'active' : '' }}"></i>
                            @endfor
                            <span class="ms-2">(4.0)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container position-relative">
        <div class="quick-info-grid">
            <div class="info-card" data-aos="fade-up" data-aos-delay="100">
                <i class="fas fa-wifi"></i>
                <h4>Free WiFi</h4>
                <p>High-speed internet access</p>
            </div>
            <div class="info-card" data-aos="fade-up" data-aos-delay="200">
                <i class="fas fa-swimming-pool"></i>
                <h4>Swimming Pool</h4>
                <p>Outdoor pool available</p>
            </div>
            <div class="info-card" data-aos="fade-up" data-aos-delay="300">
                <i class="fas fa-concierge-bell"></i>
                <h4>Room Service</h4>
                <p>24/7 available</p>
            </div>
            <div class="info-card" data-aos="fade-up" data-aos-delay="400">
                <i class="fas fa-parking"></i>
                <h4>Free Parking</h4>
                <p>On-site parking</p>
            </div>
        </div>

        <div class="row g-4 mt-4">
            <div class="col-lg-8">
                <div class="content-section mb-4" data-aos="fade-up">
                    <h2>About This Property</h2>
                    <div class="description-content">
                        {{ $hotel->description }}
                    </div>
                </div>

                <div class="content-section mb-4" data-aos="fade-up">
                    <h2>Featured Amenities</h2>
                    <div class="amenities-grid">
                        <div class="amenity-item">
                            <i class="fas fa-wifi"></i>
                            <span>High-Speed WiFi</span>
                        </div>
                        <div class="amenity-item">
                            <i class="fas fa-swimming-pool"></i>
                            <span>Swimming Pool</span>
                        </div>
                        <div class="amenity-item">
                            <i class="fas fa-parking"></i>
                            <span>Free Parking</span>
                        </div>
                        <div class="amenity-item">
                            <i class="fas fa-utensils"></i>
                            <span>Restaurant</span>
                        </div>
                        <div class="amenity-item">
                            <i class="fas fa-dumbbell"></i>
                            <span>Fitness Center</span>
                        </div>
                        <div class="amenity-item">
                            <i class="fas fa-spa"></i>
                            <span>Spa Services</span>
                        </div>
                    </div>
                </div>

                <div class="content-section mb-4" data-aos="fade-up">
                    <h2>Location</h2>
                    <div class="location-details">
                        <div class="address-bar">
                            <i class="fas fa-map-marker-alt"></i>
                            <p>{{ $hotel->address }}</p>
                        </div>
                        <div class="map-container">
                            <div class="map-placeholder">
                                <i class="fas fa-map-marked-alt"></i>
                                <p>Interactive map coming soon</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sidebar-card host-card" data-aos="fade-left">
                    <div class="host-header">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($hotel->user->name) }}&background=random" 
                             alt="{{ $hotel->user->name }}" class="host-avatar">
                        <div class="host-info">
                            <h3>{{ $hotel->user->name }}</h3>
                            <span class="host-title">Property Owner</span>
                        </div>
                    </div>
                    <div class="host-stats">
                        <div class="stat-item">
                            <i class="fas fa-shield-alt"></i>
                            <span>Identity verified</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-clock"></i>
                            <span>Fast response time</span>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-contact-host" data-bs-toggle="modal" data-bs-target="#contactHostModal">
                        <i class="fas fa-envelope me-2"></i>Contact Host
                    </button>
                </div>

                <div class="sidebar-card booking-widget" data-aos="fade-left" data-aos-delay="200">
                    <h3>Book Your Stay</h3>
                    <form class="booking-form">
                        <div class="form-group">
                            <label>Check-in - Check-out</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-calendar"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Select dates">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Guests</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                                <select class="form-select">
                                    <option>1 guest</option>
                                    <option>2 guests</option>
                                    <option>3 guests</option>
                                    <option>4+ guests</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-book-now">
                            <i class="fas fa-check-circle me-2"></i>Check Availability
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="contactHostModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Contact {{ $hotel->user->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('hotels.contact', $hotel) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-2"></i>Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });
});
</script>
@endsection