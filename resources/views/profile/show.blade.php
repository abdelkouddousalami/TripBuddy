<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }}'s Profile - TripBuddy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <style>
        :root {
            --primary-color: #386641;
            --secondary-color: #6A994E;
            --accent-color: #A7C957;
            --light-color: #F2E8CF;
            --dark-accent: #BC4749;
            --transition: all 0.3s ease;
        }

        body {
            background-color: #f8f9fa;
            padding-top: 70px;
        }

        .navbar {
            height: 70px !important;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            transition: var(--transition);
            padding: 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand img {
            height: 45px;
            transition: var(--transition);
        }

        .nav-link {
            color: var(--primary-color) !important;
            font-weight: 600;
            padding: 0.5rem 1rem;
            transition: var(--transition);
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--dark-accent);
            transition: var(--transition);
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-radius: 12px;
        }

        .dropdown-item {
            padding: 0.7rem 1.5rem;
            transition: var(--transition);
        }

        .dropdown-item:hover {
            background: rgba(56, 102, 65, 0.1);
            color: var(--primary-color);
        }

        .profile-header {
            background: linear-gradient(rgba(56, 102, 65, 0.9), rgba(56, 102, 65, 0.8)), url("{{ asset('img/hero.jpg') }}") center/cover;
            padding: 4rem 0;
            color: white;
            margin-bottom: 3rem;
            border-radius: 0 0 30px 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .profile-header h1 {
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .profile-header .lead {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .profile-stats {
            margin-top: -60px;
            margin-bottom: 3rem;
        }

        .stat-box {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: var(--transition);
        }

        .stat-box:hover {
            transform: translateY(-5px);
        }

        .stat-box i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .stat-box h3 {
            color: var(--dark-accent);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .user-info {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }

        .user-info h4 {
            color: var (--primary-color);
            margin-bottom: 1.5rem;
            font-weight: 700;
        }

        .user-info p {
            margin-bottom: 1rem;
            color: #666;
        }

        .user-info i {
            margin-right: 0.5rem;
            width: 20px;
        }

        .trip-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: var(--transition);
        }

        .trip-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .trip-image {
            height: 200px;
            object-fit: cover;
        }

        .trip-card .card-body {
            padding: 1.5rem;
        }

        .trip-card .card-title {
            color: var(--primary-color);
            font-weight: 700;
        }

        .trip-card p i {
            width: 20px;
            color: var(--secondary-color);
        }

        .btn {
            padding: 0.6rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(56, 102, 65, 0.2);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(56, 102, 65, 0.2);
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(10px);
                padding: 1rem;
                border-radius: 0 0 15px 15px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            }

            .nav-link {
                padding: 0.8rem 1.5rem;
                border-radius: 8px;
            }

            .nav-link:hover {
                background: rgba(56, 102, 65, 0.1);
            }
        }

        @media (max-width: 767.98px) {
            .profile-header {
                padding: 3rem 0;
                text-align: center;
            }

            .stat-box {
                margin-bottom: 1rem;
            }

            .user-info {
                padding: 1.5rem;
            }
        }

        @media (max-width: 575.98px) {
            body {
                padding-top: 60px;
            }

            .navbar {
                height: 60px !important;
            }

            .navbar-brand img {
                height: 35px;
            }

            .profile-header h1 {
                font-size: 2rem;
            }

            .profile-stats {
                margin-top: -40px;
            }

            .stat-box {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top" data-aos="fade-down">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/logo.png') }}" alt="TripBuddy Logo">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('trips.index') }}">Find Buddy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#destinations">Destinations</a>
                    </li>
                </ul>
                
                <div class="auth-buttons">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Sign In</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
                    @else
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                                <li><a class="dropdown-item" href="{{ route('profile.show') }}">My Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('trips.create') }}">Post a Trip</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <div class="profile-header text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h1 class="display-4">{{ $user->name }}</h1>
                    <p class="lead"><i class="fas fa-map-marker-alt"></i> {{ $user->city }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('success'))
                    <div class="alert alert-success mt-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="profile-stats mb-4" data-aos="fade-up">
                    <div class="row text-center">
                        <div class="col">
                            <div class="stat-box">
                                <i class="fas fa-map-marked-alt"></i>
                                <h3>{{ $trips->count() }}</h3>
                                <p class="text-muted mb-0">Trips Posted</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="stat-box">
                                <i class="fas fa-calendar-alt"></i>
                                <h3>{{ $user->created_at->format('M Y') }}</h3>
                                <p class="text-muted mb-0">Joined</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="stat-box">
                                <i class="fas fa-user-edit"></i>
                                <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                                    Edit Profile
                                </a>
                            </div>
                        </div>
                        @if($user->role === 'owner')
                        <div class="col">
                            <div class="stat-box">
                                <i class="fas fa-hotel"></i>
                                <a href="{{ route('hotels.owner-dashboard') }}" class="btn btn-primary">
                                    Hotel Dashboard
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                @if($user->role === 'owner')
                <div class="alert alert-success mb-4" data-aos="fade-up">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-crown fs-4 me-3"></i>
                        <div>
                            <h5 class="mb-1">Hotel Owner Status</h5>
                            <p class="mb-0">You are a verified hotel owner. Access your hotel dashboard to manage your properties.</p>
                        </div>
                        <a href="{{ route('hotels.owner-dashboard') }}" class="btn btn-outline-success ms-auto">
                            Go to Dashboard <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
                @endif

                <div class="user-info mb-4" data-aos="fade-up" data-aos-delay="200">
                    <h4>About Me</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <p><i class="fas fa-envelope text-primary"></i> {{ $user->email }}</p>
                            <p><i class="fas fa-map-marker-alt text-primary"></i> {{ $user->city }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><i class="fas fa-calendar text-primary"></i> Member since {{ $user->created_at->format('F j, Y') }}</p>
                            <p><i class="fas fa-plane text-primary"></i> {{ $trips->count() }} trips planned</p>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3" data-aos="fade-up" data-aos-delay="300">
                        <h2>My Trip Announcements</h2>
                        <a href="{{ route('trips.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> New Trip
                        </a>
                    </div>

                    @if($trips->isEmpty())
                        <div class="alert alert-info" data-aos="fade-up" data-aos-delay="400">
                            You haven't posted any trips yet. Start by creating your first trip!
                        </div>
                    @else
                        <div class="row g-4">
                            @foreach($trips as $trip)
                                <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 + 400 }}">
                                    <div class="card trip-card">
                                        @if($trip->photo1)
                                            <img src="{{ asset('storage/' . $trip->photo1) }}" class="card-img-top trip-image" alt="{{ $trip->title }}">
                                        @endif
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $trip->title }}</h5>
                                            <p class="card-text">
                                                <i class="fas fa-map-marker-alt text-primary"></i> {{ $trip->city }}<br>
                                                <i class="fas fa-users text-primary"></i> Looking for {{ $trip->buddies_needed }} buddies<br>
                                                <i class="fas fa-calendar text-primary"></i> {{ $trip->start_date->format('M d, Y') }} - {{ $trip->end_date->format('M d, Y') }}
                                            </p>
                                            <div class="d-flex justify-content-between mt-auto">
                                                <a href="{{ route('trips.show', $trip) }}" class="btn btn-outline-primary">View Details</a>
                                                <a href="{{ route('trips.edit', $trip) }}" class="btn btn-outline-secondary">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                @if($user->role === 'tripper' && !$user->ownerRequests()->where('status', 'pending')->exists())
                    <div class="card mb-4 shadow-sm" data-aos="fade-up" data-aos-delay="300">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0"><i class="fas fa-hotel me-2"></i>Become an Owner</h4>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Submit a request to become an owner and unlock additional features for managing your hotel or hostel.
                            </div>

                            <form action="{{ route('owner-requests.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                @csrf
                                
                                <div class="mb-4">
                                    <label for="reason" class="form-label fw-bold">Why do you want to be an owner?</label>
                                    <textarea class="form-control @error('reason') is-invalid @enderror" 
                                            id="reason" name="reason" rows="3" required
                                            placeholder="Explain why you want to become an owner and your experience in property management..."></textarea>
                                    @error('reason')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="card mb-4 bg-light">
                                    <div class="card-header">
                                        <h5 class="mb-0"><i class="fas fa-building me-2"></i>Property Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="hotel_name" class="form-label fw-bold">Property Name</label>
                                                <input type="text" class="form-control @error('hotel_name') is-invalid @enderror" 
                                                       id="hotel_name" name="hotel_name" required
                                                       placeholder="Enter your property name">
                                                @error('hotel_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="hotel_type" class="form-label fw-bold">Property Type</label>
                                                <select class="form-select @error('hotel_type') is-invalid @enderror" 
                                                        id="hotel_type" name="hotel_type" required>
                                                    <option value="">Select type...</option>
                                                    <option value="hotel">Hotel</option>
                                                    <option value="hostel">Hostel</option>
                                                </select>
                                                @error('hotel_type')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-12">
                                                <label for="description" class="form-label fw-bold">Property Description</label>
                                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                                         id="description" name="description" rows="4" required
                                                         placeholder="Describe your property, its amenities, and what makes it unique..."></textarea>
                                                @error('description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-8">
                                                <label for="address" class="form-label fw-bold">Address</label>
                                                <input type="text" class="form-control @error('address') is-invalid @enderror" 
                                                       id="address" name="address" required
                                                       placeholder="Full property address">
                                                @error('address')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-4">
                                                <label for="city" class="form-label fw-bold">City</label>
                                                <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                                       id="city" name="city" required
                                                       placeholder="City name">
                                                @error('city')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-4 bg-light">
                                    <div class="card-header">
                                        <h5 class="mb-0"><i class="fas fa-images me-2"></i>Property Photos</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label for="photo1" class="form-label fw-bold">
                                                    Main Photo <span class="text-danger">*</span>
                                                </label>
                                                <input type="file" class="form-control @error('photo1') is-invalid @enderror" 
                                                       id="photo1" name="photo1" accept="image/*" required
                                                       onchange="previewImage(this, 'preview1')">
                                                <div id="preview1" class="mt-2 d-none">
                                                    <img src="" alt="Preview" class="img-thumbnail" style="max-height: 200px">
                                                </div>
                                                @error('photo1')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="photo2" class="form-label fw-bold">Additional Photo</label>
                                                <input type="file" class="form-control @error('photo2') is-invalid @enderror" 
                                                       id="photo2" name="photo2" accept="image/*"
                                                       onchange="previewImage(this, 'preview2')">
                                                <div id="preview2" class="mt-2 d-none">
                                                    <img src="" alt="Preview" class="img-thumbnail" style="max-height: 200px">
                                                </div>
                                                @error('photo2')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="photo3" class="form-label fw-bold">Additional Photo</label>
                                                <input type="file" class="form-control @error('photo3') is-invalid @enderror" 
                                                       id="photo3" name="photo3" accept="image/*"
                                                       onchange="previewImage(this, 'preview3')">
                                                <div id="preview3" class="mt-2 d-none">
                                                    <img src="" alt="Preview" class="img-thumbnail" style="max-height: 200px">
                                                </div>
                                                @error('photo3')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-4 bg-light">
                                    <div class="card-header">
                                        <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Ownership Documentation</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            Please provide official documentation that proves your ownership of the property.
                                        </div>
                                        <div class="mb-3">
                                            <label for="proof_document" class="form-label fw-bold">
                                                Proof of Ownership <span class="text-danger">*</span>
                                            </label>
                                            <input type="file" class="form-control @error('proof_document') is-invalid @enderror" 
                                                   id="proof_document" name="proof_document" 
                                                   accept=".pdf,.jpg,.jpeg,.png" required>
                                            <div class="form-text">
                                                Accepted formats: PDF, JPG, JPEG, PNG (Max size: 2MB)
                                            </div>
                                            @error('proof_document')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-paper-plane me-2"></i> Submit Owner Request
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @elseif($user->ownerRequests()->where('status', 'pending')->exists())
                    <div class="alert alert-info" data-aos="fade-up" data-aos-delay="300">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle fs-4 me-3"></i>
                            <div>
                                <h5 class="mb-1">Request Pending</h5>
                                <p class="mb-0">Your owner request is currently under review. We'll notify you once it's processed.</p>
                            </div>
                        </div>
                    </div>
                @endif

                <script>
                    function previewImage(input, previewId) {
                        const preview = document.getElementById(previewId);
                        const image = preview.querySelector('img');
                        
                        if (input.files && input.files[0]) {
                            const reader = new FileReader();
                            
                            reader.onload = function(e) {
                                image.src = e.target.result;
                                preview.classList.remove('d-none');
                            }
                            
                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                    (function () {
                        'use strict'

                        const forms = document.querySelectorAll('.needs-validation')

                        Array.from(forms).forEach(form => {
                            form.addEventListener('submit', event => {
                                if (!form.checkValidity()) {
                                    event.preventDefault()
                                    event.stopPropagation()
                                }

                                form.classList.add('was-validated')
                            }, false)
                        })
                    })()
                </script>

                <div class="mb-4">
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
    </script>
</body>
</html>