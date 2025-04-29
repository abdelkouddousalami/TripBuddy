@extends('layouts.app')

@section('content')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">

<div class="hotels-list py-5">
    <div class="container">
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

        <div class="hotels-pagination mt-5">
            {{ $hotels->links() }}
        </div>
    </div>
</div>


@endsection