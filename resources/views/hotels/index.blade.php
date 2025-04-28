@extends('layouts.app')

@section('content')
<div class="hotels-list py-5">
    <div class="container">
        <!-- Hero Section -->
        <div class="hero-section mb-5 text-center">
            <h1 class="hero-title display-3 mb-3">Find Your Perfect Stay</h1>
            <p class="hero-subtitle lead text-muted mb-4">Discover amazing hotels and hostels around the world</p>
            <div class="search-bar mx-auto">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search text-primary"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" placeholder="Search by city or hotel name...">
                    <button class="btn btn-primary px-4">Search</button>
                </div>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="filters-section mb-4">
            <div class="row g-3">
                <div class="col-auto">
                    @if(auth()->user()?->role === 'owner')
                        <a href="{{ route('hotels.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add Property
                        </a>
                    @endif
                </div>
                <div class="col-auto ms-auto">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-primary active">
                            <i class="fas fa-th me-2"></i>Grid
                        </button>
                        <button type="button" class="btn btn-outline-primary">
                            <i class="fas fa-list me-2"></i>List
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hotels Grid -->
        <div class="hotels-grid">
            <div class="row g-4">
                @foreach($hotels as $hotel)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="hotel-card h-100">
                            <div class="hotel-image">
                                <img src="{{ Storage::url($hotel->photo1) }}" alt="{{ $hotel->name }}">
                                <div class="hotel-overlay">
                                    <a href="{{ route('hotels.show', $hotel) }}" class="btn btn-light rounded-circle">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                                <span class="hotel-type-badge">{{ ucfirst($hotel->type) }}</span>
                                @if($hotel->rating)
                                    <div class="hotel-rating">
                                        <i class="fas fa-star text-warning"></i>
                                        <span>{{ number_format($hotel->rating, 1) }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="hotel-content">
                                <h3 class="hotel-title">{{ $hotel->name }}</h3>
                                <p class="hotel-location">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    {{ $hotel->city }}
                                </p>
                                <div class="hotel-amenities mb-3">
                                    <span class="amenity-badge"><i class="fas fa-wifi"></i> WiFi</span>
                                    <span class="amenity-badge"><i class="fas fa-parking"></i> Parking</span>
                                    <span class="amenity-badge"><i class="fas fa-coffee"></i> Breakfast</span>
                                </div>
                                <p class="hotel-description">{{ Str::limit($hotel->description, 100) }}</p>
                                <div class="hotel-footer mt-auto">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="hotel-price">
                                            <span class="price-label">From</span>
                                            <span class="price-amount">${{ number_format($hotel->price ?? 100, 2) }}</span>
                                            <span class="price-period">/night</span>
                                        </div>
                                        <a href="{{ route('hotels.show', $hotel) }}" class="btn btn-outline-primary">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Pagination -->
        <div class="hotels-pagination mt-5">
            {{ $hotels->links() }}
        </div>
    </div>
</div>

<style>
.hotels-list {
    background-color: #f8f9fa;
    min-height: 100vh;
    position: relative;
}

/* Hero Section Styles */
.hero-section {
    max-width: 800px;
    margin: 0 auto 3rem;
}

.hero-title {
    color: #2c3e50;
    font-weight: 700;
    letter-spacing: -1px;
}

.hero-subtitle {
    font-size: 1.25rem;
}

.search-bar {
    max-width: 600px;
    margin: 0 auto;
}

.search-bar .form-control {
    padding: 0.75rem 1.5rem;
    font-size: 1.1rem;
    border-radius: 50px;
}

.search-bar .input-group {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border-radius: 50px;
    overflow: hidden;
}

.search-bar .input-group-text {
    border-radius: 50px 0 0 50px;
    padding-left: 1.5rem;
}

.search-bar .btn {
    border-radius: 50px;
    padding-left: 2rem;
    padding-right: 2rem;
}

/* Hotel Card Styles */
.hotel-card {
    background: #ffffff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.hotel-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
}

.hotel-image {
    position: relative;
    height: 240px;
    overflow: hidden;
}

.hotel-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.hotel-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
}

.hotel-card:hover .hotel-overlay {
    opacity: 1;
}

.hotel-overlay .btn {
    width: 50px;
    height: 50px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    transform: translateY(20px);
    transition: all 0.3s ease;
}

.hotel-card:hover .hotel-overlay .btn {
    transform: translateY(0);
}

.hotel-type-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: rgba(255, 255, 255, 0.95);
    color: var(--primary-color);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
    backdrop-filter: blur(4px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.hotel-rating {
    position: absolute;
    bottom: 1rem;
    left: 1rem;
    background: rgba(255, 255, 255, 0.95);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.hotel-content {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.hotel-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.5rem;
    transition: color 0.3s ease;
}

.hotel-card:hover .hotel-title {
    color: var(--primary-color);
}

.hotel-location {
    font-size: 0.95rem;
    color: #6c757d;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
}

.hotel-amenities {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.amenity-badge {
    background: #f8f9fa;
    color: #495057;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.hotel-description {
    color: #495057;
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.hotel-footer {
    border-top: 1px solid #dee2e6;
    padding-top: 1rem;
    margin-top: auto;
}

.hotel-price {
    display: flex;
    align-items: baseline;
    gap: 0.25rem;
}

.price-label {
    color: #6c757d;
    font-size: 0.875rem;
}

.price-amount {
    color: var(--primary-color);
    font-size: 1.5rem;
    font-weight: 700;
}

.price-period {
    color: #6c757d;
    font-size: 0.875rem;
}

.btn-outline-primary {
    border-width: 2px;
    font-weight: 600;
    padding: 0.5rem 1.25rem;
    border-radius: 50px;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(var(--primary-color-rgb), 0.2);
}

/* Pagination Styles */
.hotels-pagination {
    display: flex;
    justify-content: center;
}

.pagination {
    gap: 0.5rem;
}

.page-link {
    border-radius: 50% !important;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    border: 2px solid #dee2e6;
    transition: all 0.3s ease;
    margin: 0;
    padding: 0;
}

.page-link:hover {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
    transform: translateY(-2px);
}

.page-item.active .page-link {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(var(--primary-color-rgb), 0.2);
}

/* Responsive Adjustments */
@media (max-width: 991.98px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hotel-image {
        height: 220px;
    }
}

@media (max-width: 767.98px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .hotel-image {
        height: 200px;
    }
    
    .hotel-title {
        font-size: 1.25rem;
    }
}

@media (max-width: 575.98px) {
    .hero-section {
        margin-bottom: 2rem;
    }
    
    .search-bar .form-control {
        font-size: 1rem;
        padding: 0.625rem 1rem;
    }
    
    .hotel-image {
        height: 180px;
    }
    
    .hotel-content {
        padding: 1.25rem;
    }
    
    .amenity-badge {
        font-size: 0.8125rem;
        padding: 0.25rem 0.5rem;
    }
}
</style>
@endsection