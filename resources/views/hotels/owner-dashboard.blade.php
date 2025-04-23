@extends('layouts.app')

@section('content')
<div class="owner-dashboard-section py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-8">
                <h1 class="mb-0">Owner Dashboard</h1>
                <p class="text-muted">Manage your property listings</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('hotels.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-2"></i>Add Property
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($hotels->count() > 0)
            @foreach($hotels as $hotel)
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ Storage::url($hotel->photo1) }}" alt="{{ $hotel->name }}" 
                                     class="img-fluid rounded mb-3">
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <h2 class="mb-1">{{ $hotel->name }}</h2>
                                        <p class="text-muted mb-0">
                                            <i class="fas fa-map-marker-alt me-2"></i>
                                            {{ $hotel->city }}
                                        </p>
                                    </div>
                                    <span class="badge bg-primary">{{ ucfirst($hotel->type) }}</span>
                                </div>

                                <p class="mb-4">{{ Str::limit($hotel->description, 200) }}</p>

                                <div class="d-flex gap-2">
                                    <a href="{{ route('hotels.edit', $hotel) }}" class="btn btn-primary">
                                        <i class="fas fa-edit me-2"></i>Edit Property
                                    </a>
                                    <a href="{{ route('hotels.show', $hotel) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-eye me-2"></i>View Property
                                    </a>
                                    <form action="{{ route('hotels.destroy', $hotel) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" 
                                                onclick="return confirm('Are you sure you want to delete this property?')">
                                            <i class="fas fa-trash-alt me-2"></i>Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon bg-primary-subtle">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $hotels->count() }}</h3>
                            <p>Total Properties</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon bg-success-subtle">
                            <i class="fas fa-comment"></i>
                        </div>
                        <div class="stat-content">
                            <h3>0</h3>
                            <p>Total Reviews</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon bg-info-subtle">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="stat-content">
                            <h3>0</h3>
                            <p>New Messages</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-hotel fa-4x text-muted"></i>
                </div>
                <h3>No Properties Yet</h3>
                <p class="text-muted mb-4">Get started by adding your first property listing</p>
                <a href="{{ route('hotels.create') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus-circle me-2"></i>Add Your First Property
                </a>
            </div>
        @endif
    </div>
</div>

<style>
.owner-dashboard-section {
    background-color: #f8f9fa;
    min-height: 100vh;
}

.stat-card {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
}

.stat-icon i {
    font-size: 1.5rem;
    color: var(--primary-color);
}

.stat-content h3 {
    font-size: 1.75rem;
    margin-bottom: 0.25rem;
}

.stat-content p {
    color: #6c757d;
    margin-bottom: 0;
}

.bg-primary-subtle {
    background-color: rgba(var(--primary-color-rgb), 0.1);
}

.bg-success-subtle {
    background-color: rgba(var(--success-color-rgb), 0.1);
}

.bg-info-subtle {
    background-color: rgba(var(--info-color-rgb), 0.1);
}
</style>
@endsection