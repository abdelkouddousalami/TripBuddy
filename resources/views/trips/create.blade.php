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

<style>
.create-trip-section {
    background-color: #f8f9fa;
    min-height: 100vh;
    padding: 2rem 0;
}

.form-container {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    padding: 3rem;
}

.section-title {
    color: var(--primary-color);
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
}

.form-section {
    position: relative;
}

.form-section .card {
    border: none;
    border-radius: 15px;
    transition: transform 0.3s ease;
}

.form-section .card:hover {
    transform: translateY(-5px);
}

.form-label {
    font-weight: 500;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.input-group-text {
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    color: var(--primary-color);
}

.form-control {
    border: 1px solid #ced4da;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.25rem rgba(56, 102, 65, 0.25);
}

.upload-container {
    position: relative;
}

.upload-box {
    position: relative;
    background: #f8f9fa;
    border: 2px dashed #ced4da;
    border-radius: 12px;
    padding: 1rem;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
}

.upload-box:hover {
    border-color: var(--primary-color);
    background: #fff;
}

.preview-container {
    min-height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 1rem;
}

.preview-container img {
    max-width: 100%;
    max-height: 200px;
    border-radius: 8px;
    object-fit: cover;
}

.upload-placeholder {
    color: #6c757d;
}

.upload-placeholder i {
    font-size: 2rem;
    margin-bottom: 0.5rem;
    color: var(--primary-color);
}

.upload-placeholder span {
    display: block;
    font-size: 0.9rem;
}

.form-control[type="file"] {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.btn-lg {
    padding: 1rem 2rem;
    font-size: 1.1rem;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-lg:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(56, 102, 65, 0.3);
}

@media (max-width: 768px) {
    .form-container {
        padding: 1.5rem;
    }

    .form-section {
        margin-bottom: 2rem;
    }
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle image previews
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

    // Initialize date constraints
    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');
    
    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    startDate.min = today;
    
    startDate.addEventListener('change', function() {
        endDate.min = this.value;
        if (endDate.value && endDate.value < this.value) {
            endDate.value = this.value;
        }
    });

    // Initialize image previews
    handleImagePreview(document.getElementById('photo1'), 'preview1');
    handleImagePreview(document.getElementById('photo2'), 'preview2');
    handleImagePreview(document.getElementById('photo3'), 'preview3');

    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });

    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true,
        offset: 50
    });
});
</script>
@endpush
@endsection