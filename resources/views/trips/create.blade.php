<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Trip - TripBuddy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #386641;
            --secondary-color: #6A994E;
            --accent-color: #A7C957;
            --light-color: #F2E8CF;
            --dark-accent: #BC4749;
        }

        /* Navbar Styles */
        .navbar {
            height: 105px !important;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            padding: 1rem 0;
            
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
        }

        .navbar-brand img {
            height: 80px;
        }

        .navbar.scrolled {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            background: var(--light-color);
        }

        .nav-link {
            position: relative;
            overflow: hidden;
            color: var(--primary-color) !important;
            font-weight: 500;
            margin: 0 0.5rem;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: -100%;
            width: 100%;
            height: 2px;
            background: var(--dark-accent);
            transition: 0.3s ease;
        }

        .nav-link:hover::after {
            left: 0;
        }

        .auth-buttons .btn {
            margin-left: 0.5rem;
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(56, 102, 65, 0.7), rgba(56, 102, 65, 0.7)), url("{{ asset('img/hero.jpg') }}") no-repeat center center;
            background-size: cover;
            color: var(--light-color);
        }

        /* Button Styles */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var (--secondary-color);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: var(--light-color);
        }

        .btn-danger {
            background-color: var(--dark-accent);
            border-color: var(--dark-accent);
        }

        /* Section Styles */
        .section {
            padding: 100px 0;
        }

        .section.bg-light {
            background-color: var(--light-color) !important;
        }

        .card {
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            background-color: white;
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
            object-position: center;
        }

        .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 1.5rem;
        }

        .card-text {
            flex: 1;
            margin-bottom: 1rem;
        }

        /* Section specific card styles */
        #booking .card {
            min-height: 400px;
        }

        #buddy .card, #destinations .card {
            min-height: 450px;
        }

        /* Form styles in booking section */
        #booking form {
            margin-top: auto;
        }

        /* Make all buttons align at bottom */
        .card .btn {
            margin-top: auto;
        }

        /* Section padding consistency */
        .section {
            padding: 100px 0;
        }

        .row.g-4 {
            --bs-gutter-y: 2rem;
        }

        /* Footer */
        .footer {
            background: var(--primary-color);
            color: var(--light-color);
            padding: 60px 0;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--secondary-color);
            margin: 0 10px;
            transition: 0.3s ease;
            color: var(--light-color);
        }

        .social-icon:hover {
            background: var(--dark-accent);
            transform: translateY(-5px);
            color: var(--light-color);
        }

        .image-upload-container {
            position: relative;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .image-upload-container:hover {
            transform: translateY(-2px);
        }

        .image-preview-container {
            margin-top: 10px;
            position: relative;
            width: 100%;
            min-height: 200px;
            background: #f8f9fa;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .image-preview-container:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .image-preview-container img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 12px;
            transition: all 0.5s ease;
        }

        .image-preview-container img:hover {
            transform: scale(1.05);
        }

        .remove-image {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            opacity: 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .image-preview-container:hover .remove-image {
            opacity: 1;
        }

        .remove-image:hover {
            background: #fff;
            transform: scale(1.1);
        }

        .form-control[type="file"] {
            padding: 0.75rem;
            border-radius: 8px;
            border: 2px dashed var(--accent-color);
            background: rgba(167, 201, 87, 0.1);
            transition: all 0.3s ease;
        }

        .form-control[type="file"]:hover {
            border-color: var(--secondary-color);
            background: rgba(167, 201, 87, 0.2);
        }

        .carousel {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .carousel-item img {
            height: 400px;
            object-fit: cover;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 10%;
            background: linear-gradient(90deg, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .carousel-control-next {
            background: linear-gradient(-90deg, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0) 100%);
        }

        .carousel:hover .carousel-control-prev,
        .carousel:hover .carousel-control-next {
            opacity: 1;
        }

        .form-container {
            background: var(--glass-bg);
            backdrop-filter: var(--glass-blur);
            border: var(--glass-border);
            border-radius: 20px;
            padding: 2.5rem;
            margin-top: 8rem;
            box-shadow: var(--card-shadow);
        }

        .form-container h2 {
            color: var(--primary-color);
            text-align: center;
            font-size: 2.2rem;
            font-weight: 600;
            margin-bottom: 2rem;
            text-shadow: var(--text-shadow);
        }

        .form-label {
            color: var(--secondary-color);
            font-weight: 500;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-label i {
            color: var(--accent-color);
        }

        .form-control {
            border: 2px solid var(--sage-green);
            border-radius: 12px;
            padding: 0.8rem 1rem;
            font-size: 1rem;
            transition: var(--smooth-transition);
        }

        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 5px 15px rgba(136, 176, 106, 0.2);
            transform: translateY(-2px);
        }

        .image-upload-container {
            position: relative;
            margin-bottom: 1.5rem;
            transition: var(--smooth-transition);
        }

        .image-upload-container:hover {
            transform: translateY(-2px);
        }

        .image-preview-container {
            margin-top: 10px;
            position: relative;
            width: 100%;
            min-height: 200px;
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: var(--glass-blur);
            border: var(--glass-border);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }

        .image-preview-container img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: var(--smooth-transition);
        }

        .image-preview-container:hover img {
            transform: scale(1.05);
        }

        .remove-image {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 30px;
            height: 30px;
            background: var(--glass-bg);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
            opacity: 0;
            transition: var(--smooth-transition);
            backdrop-filter: var(--glass-blur);
            box-shadow: var(--card-shadow);
        }

        .image-preview-container:hover .remove-image {
            opacity: 1;
        }

        .remove-image:hover {
            background: white;
            transform: scale(1.1);
        }

        .form-text {
            color: var(--secondary-color);
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .btn-lg {
            padding: 1rem 2rem;
            font-size: 1.1rem;
            border-radius: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: var(--smooth-transition);
        }

        .btn-lg:hover {
            transform: translateY(-3px);
            box-shadow: var(--hover-shadow);
        }

        .invalid-feedback {
            color: var(--error-red);
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top" data-aos="fade-down">
        <div class="container">
            <!-- Logo on the left -->
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/logo.png') }}" alt="TripBuddy Logo">
            </a>
            
            <!-- Hamburger menu for mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation items in the middle -->
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
                
                <!-- Auth buttons on the right -->
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-container">
                    <h2 class="text-center mb-4">Create New Trip Announcement</h2>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('trips.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Trip Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                       id="city" name="city" value="{{ old('city') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="buddies_needed" class="form-label">Number of Buddies Needed</label>
                                <input type="number" class="form-control @error('buddies_needed') is-invalid @enderror" 
                                       id="buddies_needed" name="buddies_needed" value="{{ old('buddies_needed') }}" min="1" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                       id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                       id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Photos</label>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="image-upload-container">
                                        <input type="file" class="form-control @error('photo1') is-invalid @enderror" 
                                               id="photo1" name="photo1" accept="image/png">
                                        <div id="preview1" class="image-preview-container"></div>
                                        @error('photo1')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="image-upload-container">
                                        <input type="file" class="form-control @error('photo2') is-invalid @enderror" 
                                               id="photo2" name="photo2" accept="image/png">
                                        <div id="preview2" class="image-preview-container"></div>
                                        @error('photo2')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="image-upload-container">
                                        <input type="file" class="form-control @error('photo3') is-invalid @enderror" 
                                               id="photo3" name="photo3" accept="image/png">
                                        <div id="preview3" class="image-preview-container"></div>
                                        @error('photo3')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <small class="text-muted">You can upload up to 3 photos (optional). Only PNG format is supported. Max size: 2MB each.</small>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Create Trip</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Image preview functionality
        function handleImagePreview(input, previewId) {
            const preview = document.getElementById(previewId);
            input.addEventListener('change', function() {
                preview.innerHTML = '';
                if (this.files && this.files[0]) {
                    const img = document.createElement('img');
                    img.className = 'image-preview';
                    img.src = URL.createObjectURL(this.files[0]);
                    const removeBtn = document.createElement('button');
                    removeBtn.className = 'remove-image';
                    removeBtn.innerHTML = '×';
                    removeBtn.onclick = function(e) {
                        e.preventDefault();
                        input.value = '';
                        preview.innerHTML = '';
                    };
                    preview.appendChild(img);
                    preview.appendChild(removeBtn);
                }
            });
        }

        handleImagePreview(document.getElementById('photo1'), 'preview1');
        handleImagePreview(document.getElementById('photo2'), 'preview2');
        handleImagePreview(document.getElementById('photo3'), 'preview3');
    </script>
    <script>
        function handleImagePreview(input, previewId) {
            const preview = document.getElementById(previewId);
            
            input.addEventListener('change', function() {
                preview.innerHTML = '';
                
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    const img = document.createElement('img');
                    const removeBtn = document.createElement('button');
                    
                    reader.onload = function(e) {
                        img.src = e.target.result;
                        img.classList.add('preview-image');
                        
                        removeBtn.className = 'remove-image';
                        removeBtn.innerHTML = '×';
                        removeBtn.onclick = function(e) {
                            e.preventDefault();
                            input.value = '';
                            preview.innerHTML = '';
                        };
                        
                        preview.appendChild(img);
                        preview.appendChild(removeBtn);
                    }
                    
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            handleImagePreview(document.getElementById('photo1'), 'preview1');
            handleImagePreview(document.getElementById('photo2'), 'preview2');
            handleImagePreview(document.getElementById('photo3'), 'preview3');
        });
    </script>
</body>
</html>