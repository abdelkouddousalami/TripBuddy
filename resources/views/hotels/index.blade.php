@extends('layouts.app')

@section('content')
<div class="hotels-section py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-8">
                <h1 class="mb-0">Hotels & Hostels</h1>
                <p class="text-muted">Find the perfect place for your stay</p>
            </div>
            @if(Auth::check() && Auth::user()->isOwner())
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('hotels.owner-dashboard') }}" class="btn btn-primary">
                        <i class="fas fa-th-large me-2"></i>Owner Dashboard
                    </a>
                </div>
            @endif
        </div>

        <div class="row g-4">
            @forelse($hotels as $hotel)
                <div class="col-md-6 col-lg-4">
                    <div class="hotel-card">
                        <div class="hotel-image">
                            <img src="{{ Storage::url($hotel->photo1) }}" alt="{{ $hotel->name }}">
                            <div class="hotel-type">
                                <span class="badge bg-primary">{{ ucfirst($hotel->type) }}</span>
                            </div>
                        </div>
                        <div class="hotel-content">
                            <h3 class="hotel-title">{{ $hotel->name }}</h3>
                            <p class="hotel-location">
                                <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                {{ $hotel->city }}
                            </p>
                            <p class="hotel-description">{{ Str::limit($hotel->description, 100) }}</p>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="hotel-owner">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($hotel->user->name) }}&background=random" 
                                         class="avatar me-2" alt="{{ $hotel->user->name }}">
                                    <span class="text-muted">{{ $hotel->user->name }}</span>
                                </div>
                                <a href="{{ route('hotels.show', $hotel) }}" class="btn btn-outline-primary">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-hotel fa-3x text-muted mb-3"></i>
                        <h3>No Properties Found</h3>
                        <p class="text-muted">There are no hotels or hostels listed at the moment.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $hotels->links() }}
        </div>
    </div>
</div>

<style>
.hotels-section {
    background-color: #f8f9fa;
    min-height: 100vh;
}

.hotel-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.hotel-card:hover {
    transform: translateY(-5px);
}

.hotel-image {
    position: relative;
    height: 200px;
}

.hotel-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hotel-type {
    position: absolute;
    top: 15px;
    right: 15px;
}

.hotel-content {
    padding: 1.5rem;
}

.hotel-title {
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
}

.hotel-location {
    color: #6c757d;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.hotel-description {
    color: #495057;
    font-size: 0.95rem;
    margin-bottom: 1rem;
    line-height: 1.5;
}

.hotel-owner {
    display: flex;
    align-items: center;
}

.avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
}

.badge {
    padding: 0.5rem 1rem;
    font-weight: 500;
}

@media (max-width: 768px) {
    .hotel-image {
        height: 180px;
    }
}
</style>
@endsection