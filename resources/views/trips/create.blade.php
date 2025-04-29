@extends('layouts.app')

@section('content')
<div class="create-trip-section">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-container" data-aos="fade-up">
                    <div class="form-header text-center mb-5">
                        <h1 class="display-5 fw-bold text-primary">Create Your Trip</h1>
                        <p class="text-muted lead">Share your travel plans and find the perfect travel buddies</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger" data-aos="fade-up">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('trips.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        
                        <div class="form-section mb-5" data-aos="fade-up">
                            <h3 class="section-title"><i class="fas fa-info-circle me-2"></i>Basic Information</h3>
                            <div class="card shadow-sm">
                                <div class="card-body p-4">
                                    <div class="mb-4">
                                        <label for="title" class="form-label">Trip Title</label>
                                        <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                               id="title" name="title" value="{{ old('title') }}" required
                                               placeholder="Give your trip a catchy title">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="description" class="form-label">Trip Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  id="description" name="description" rows="5" required
                                                  placeholder="Describe your trip plans, activities, and what kind of travel buddies you're looking for">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-section mb-5" data-aos="fade-up" data-aos-delay="100">
                            <h3 class="section-title"><i class="fas fa-map-marker-alt me-2"></i>Location & Details</h3>
                            <div class="card shadow-sm">
                                <div class="card-body p-4">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label for="city" class="form-label">Destination City</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-city"></i></span>
                                                <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                                       id="city" name="city" value="{{ old('city') }}" required
                                                       placeholder="Enter city name">
                                            </div>
                                            @error('city')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="buddies_needed" class="form-label">Number of Travel Buddies</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-users"></i></span>
                                                <input type="number" class="form-control @error('buddies_needed') is-invalid @enderror" 
                                                       id="buddies_needed" name="buddies_needed" value="{{ old('buddies_needed') }}" 
                                                       min="1" required placeholder="How many buddies?">
                                            </div>
                                            @error('buddies_needed')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label for="budget" class="form-label">Estimated Budget per Person</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                <input type="number" step="0.01" class="form-control @error('budget') is-invalid @enderror" 
                                                       id="budget" name="budget" value="{{ old('budget') }}" min="0" required
                                                       placeholder="Enter estimated budget in USD">
                                            </div>
                                            @error('budget')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">Enter the estimated cost per person for the entire trip duration</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-section mb-5" data-aos="fade-up" data-aos-delay="200">
                            <h3 class="section-title"><i class="fas fa-calendar-alt me-2"></i>Trip Dates</h3>
                            <div class="card shadow-sm">
                                <div class="card-body p-4">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label for="start_date" class="form-label">Start Date</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-plane-departure"></i></span>
                                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                                       id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                                            </div>
                                            @error('start_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="end_date" class="form-label">End Date</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-plane-arrival"></i></span>
                                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                                       id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                                            </div>
                                            @error('end_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-section mb-5" data-aos="fade-up" data-aos-delay="300">
                            <h3 class="section-title"><i class="fas fa-images me-2"></i>Trip Photos</h3>
                            <div class="card shadow-sm">
                                <div class="card-body p-4">
                                    <div class="row g-4">
                                        <div class="col-md-4">
                                            <div class="upload-container">
                                                <label for="photo1" class="form-label">Main Photo</label>
                                                <div class="upload-box">
                                                    <input type="file" class="form-control @error('photo1') is-invalid @enderror" 
                                                           id="photo1" name="photo1" accept="image/*">
                                                    <div id="preview1" class="preview-container">
                                                        <div class="upload-placeholder">
                                                            <i class="fas fa-cloud-upload-alt"></i>
                                                            <span>Click to upload</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @error('photo1')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="upload-container">
                                                <label for="photo2" class="form-label">Additional Photo</label>
                                                <div class="upload-box">
                                                    <input type="file" class="form-control @error('photo2') is-invalid @enderror" 
                                                           id="photo2" name="photo2" accept="image/*">
                                                    <div id="preview2" class="preview-container">
                                                        <div class="upload-placeholder">
                                                            <i class="fas fa-cloud-upload-alt"></i>
                                                            <span>Click to upload</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @error('photo2')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="upload-container">
                                                <label for="photo3" class="form-label">Additional Photo</label>
                                                <div class="upload-box">
                                                    <input type="file" class="form-control @error('photo3') is-invalid @enderror" 
                                                           id="photo3" name="photo3" accept="image/*">
                                                    <div id="preview3" class="preview-container">
                                                        <div class="upload-placeholder">
                                                            <i class="fas fa-cloud-upload-alt"></i>
                                                            <span>Click to upload</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @error('photo3')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="alert alert-info">
                                                <i class="fas fa-info-circle me-2"></i>
                                                You can upload up to 3 photos (JPG, PNG, GIF, or WebP format). Max size: 2MB each.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions text-center" data-aos="fade-up" data-aos-delay="400">
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="fas fa-paper-plane me-2"></i>Create Trip
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link href="{{ asset('css/create.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    function handleImagePreview(input, previewId) {
        const preview = document.getElementById(previewId);
        
        input.addEventListener('change', function() {
            const placeholder = preview.querySelector('.upload-placeholder');
            const existingImg = preview.querySelector('img');
            
            if (existingImg) {
                existingImg.remove();
            }
            
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    placeholder.style.display = 'none';
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'preview-image';
                    preview.appendChild(img);
                }
                reader.readAsDataURL(this.files[0]);
            } else {
                placeholder.style.display = 'block';
            }
        });
    }

    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');
    
    const today = new Date().toISOString().split('T')[0];
    startDate.min = today;
    
    startDate.addEventListener('change', function() {
        endDate.min = this.value;
        if (endDate.value && endDate.value < this.value) {
            endDate.value = this.value;
        }
    });

    handleImagePreview(document.getElementById('photo1'), 'preview1');
    handleImagePreview(document.getElementById('photo2'), 'preview2');
    handleImagePreview(document.getElementById('photo3'), 'preview3');

    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });

    AOS.init({
        duration: 800,
        once: true,
        offset: 50
    });
});
</script>
@endpush
@endsection