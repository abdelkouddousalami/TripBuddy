@extends('layouts.app')

@section('content')
<div class="create-hotel-section py-5">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('hotels.owner-dashboard') }}">Owner Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add New Property</li>
            </ol>
        </nav>

        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="card-title mb-4">Add New Property</h1>

                <form action="{{ route('hotels.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Property Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="type" class="form-label">Property Type</label>
                                <select class="form-select @error('type') is-invalid @enderror" 
                                        id="type" name="type" required>
                                    <option value="">Select type...</option>
                                    <option value="hotel" {{ old('type') == 'hotel' ? 'selected' : '' }}>Hotel</option>
                                    <option value="hostel" {{ old('type') == 'hostel' ? 'selected' : '' }}>Hostel</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                       id="city" name="city" value="{{ old('city') }}" required>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Full Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" 
                                       id="address" name="address" value="{{ old('address') }}" required>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="photo1" class="form-label">Main Photo (Required)</label>
                                <input type="file" class="form-control @error('photo1') is-invalid @enderror" 
                                       id="photo1" name="photo1" accept="image/*" required>
                                @error('photo1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="photo2" class="form-label">Additional Photo</label>
                                <input type="file" class="form-control @error('photo2') is-invalid @enderror" 
                                       id="photo2" name="photo2" accept="image/*">
                                @error('photo2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="photo3" class="form-label">Additional Photo</label>
                                <input type="file" class="form-control @error('photo3') is-invalid @enderror" 
                                       id="photo3" name="photo3" accept="image/*">
                                @error('photo3')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('hotels.owner-dashboard') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Property
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.create-hotel-section {
    background-color: #f8f9fa;
    min-height: 100vh;
}

.form-label {
    font-weight: 500;
}
</style>
@endsection