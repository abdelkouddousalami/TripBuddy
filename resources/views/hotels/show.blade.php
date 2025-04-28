@extends('layouts.app')

@section('content')
<div class="hotel-details">
    <!-- Header Section with Hero Image -->
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
        <!-- Quick Info Cards -->
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

        <!-- Main Content Section -->
        <div class="row g-4 mt-4">
            <div class="col-lg-8">
                <!-- About Section -->
                <div class="content-section mb-4" data-aos="fade-up">
                    <h2>About This Property</h2>
                    <div class="description-content">
                        {{ $hotel->description }}
                    </div>
                </div>

                <!-- Amenities Section -->
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

                <!-- Location Section -->
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
                <!-- Host Information -->
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

                <!-- Booking Widget -->
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

<!-- Contact Host Modal -->
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

<style>
/* Base Styles */
:root {
    --primary-color: #2c5a27;
    --primary-color-rgb: 44, 90, 39;
    --secondary-color: #4a7856;
    --accent-color: #bc4749;
    --text-color: #2c3e50;
    --light-color: #f8f9fa;
    --border-radius: 15px;
}

.hotel-details {
    background-color: var(--light-color);
    min-height: 100vh;
}

/* Header Section */
.hotel-header {
    position: relative;
    height: 70vh;
    min-height: 500px;
    background: #000;
    overflow: hidden;
    margin-bottom: 4rem;
}

.carousel {
    height: 100%;
}

.carousel-inner {
    height: 100%;
}

.carousel-item {
    height: 100%;
}

.carousel-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.8;
    transition: opacity 0.3s ease;
}

.carousel-control-prev,
.carousel-control-next {
    width: 54px;
    height: 54px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
}

.header-content {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 4rem 0;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    color: white;
}

.property-badge {
    display: inline-block;
    background: var(--primary-color);
    color: white;
    padding: 0.5rem 1.5rem;
    border-radius: 30px;
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.hotel-title-section h1 {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.hotel-meta {
    display: flex;
    align-items: center;
    gap: 2rem;
    font-size: 1.1rem;
}

.rating {
    display: flex;
    align-items: center;
}

.rating .fa-star {
    color: #ffd700;
    margin-right: 2px;
}

.rating .fa-star:not(.active) {
    color: rgba(255,255,255,0.5);
}

/* Quick Info Section */
.quick-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-top: -50px;
    position: relative;
    z-index: 3;
}

.info-card {
    background: white;
    padding: 1.5rem;
    border-radius: var(--border-radius);
    text-align: center;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.info-card:hover {
    transform: translateY(-5px);
}

.info-card i {
    font-size: 2rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.info-card h4 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.info-card p {
    color: #6c757d;
    margin: 0;
}

/* Content Sections */
.content-section {
    background: white;
    border-radius: var(--border-radius);
    padding: 2rem;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
}

.content-section h2 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: var(--text-color);
    position: relative;
    padding-bottom: 0.5rem;
}

.content-section h2:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 3px;
    background: var(--primary-color);
    border-radius: 2px;
}

.description-content {
    line-height: 1.8;
    color: #495057;
}

/* Amenities Grid */
.amenities-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1rem;
}

.amenity-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: var(--light-color);
    border-radius: var(--border-radius);
    transition: all 0.3s ease;
}

.amenity-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    background: white;
}

.amenity-item i {
    font-size: 1.25rem;
    color: var(--primary-color);
    width: 24px;
    text-align: center;
}

/* Location Section */
.location-details {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.address-bar {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: var(--light-color);
    border-radius: var(--border-radius);
}

.address-bar i {
    color: var(--primary-color);
    font-size: 1.25rem;
}

.address-bar p {
    margin: 0;
    color: #495057;
}

.map-container {
    aspect-ratio: 16/9;
    border-radius: var(--border-radius);
    overflow: hidden;
}

.map-placeholder {
    height: 100%;
    background: var(--light-color);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #6c757d;
}

.map-placeholder i {
    font-size: 3rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
}

/* Sidebar Cards */
.sidebar-card {
    background: white;
    border-radius: var(--border-radius);
    padding: 2rem;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    margin-bottom: 2rem;
}

/* Host Card */
.host-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.host-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    border: 3px solid var(--primary-color);
    padding: 3px;
}

.host-info h3 {
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0;
}

.host-title {
    display: inline-block;
    background: #e9ecef;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.875rem;
    color: #495057;
    margin-top: 0.5rem;
}

.host-stats {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: #495057;
}

.stat-item i {
    color: var(--primary-color);
}

/* Booking Widget */
.booking-form .form-group {
    margin-bottom: 1.5rem;
}

.booking-form label {
    font-weight: 500;
    color: #495057;
    margin-bottom: 0.5rem;
}

.booking-form .input-group {
    border-radius: var(--border-radius);
    overflow: hidden;
}

.booking-form .input-group-text {
    background: transparent;
    border-right: none;
}

.booking-form .form-control,
.booking-form .form-select {
    border-left: none;
    padding: 0.75rem 1rem;
}

.btn-book-now,
.btn-contact-host {
    width: 100%;
    padding: 1rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    border-radius: var(--border-radius);
    transition: all 0.3s ease;
}

.btn-book-now:hover,
.btn-contact-host:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(var(--primary-color-rgb), 0.2);
}

/* Responsive Adjustments */
@media (max-width: 991.98px) {
    .hotel-header {
        height: 50vh;
    }
    
    .hotel-title-section h1 {
        font-size: 2.5rem;
    }
    
    .quick-info-grid {
        margin-top: 2rem;
    }
}

@media (max-width: 767.98px) {
    .hotel-header {
        height: 40vh;
        min-height: 300px;
    }
    
    .hotel-title-section h1 {
        font-size: 2rem;
    }
    
    .hotel-meta {
        flex-direction: column;
        gap: 1rem;
    }
    
    .content-section {
        padding: 1.5rem;
    }
    
    .amenities-grid {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    }
}

@media (max-width: 575.98px) {
    .hotel-header {
        height: 30vh;
    }
    
    .hotel-title-section h1 {
        font-size: 1.75rem;
    }
    
    .property-badge {
        font-size: 0.75rem;
    }
    
    .content-section {
        padding: 1.25rem;
    }
    
    .quick-info-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });
});
</script>
@endsection