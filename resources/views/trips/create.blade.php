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

        body {
            background-color: var(--light-color);
            min-height: 100vh;
            overflow-x: hidden;
            padding-top: 76px; /* Added to account for fixed navbar */
        }

        .navbar {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-brand img {
            height: 40px;
        }

        .nav-link {
            color: var(--primary-color) !important;
            font-weight: 500;
        }

        .nav-link:hover {
            color: var(--accent-color) !important;
        }

        .profile-header {
            background: linear-gradient(rgba(56, 102, 65, 0.9), rgba(56, 102, 65, 0.9)), url("{{ asset('img/hero.jpg') }}") no-repeat center center;
            background-size: cover;
            color: white;
            padding: 100px 0 50px;
            margin-top: 60px;
            position: relative;
            overflow: hidden;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at center, transparent 0%, rgba(0,0,0,0.3) 100%);
            z-index: 1;
        }

        .profile-header .container {
            position: relative;
            z-index: 2;
        }

        .profile-header h1 {
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            transform: translateY(20px);
            opacity: 0;
            animation: fadeInUp 0.6s ease forwards;
        }

        .profile-header p {
            transform: translateY(20px);
            opacity: 0;
            animation: fadeInUp 0.6s ease 0.2s forwards;
        }

        @keyframes fadeInUp {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .profile-stats {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-top: -50px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transform: translateY(30px);
            opacity: 0;
            animation: slideUp 0.6s ease 0.4s forwards;
        }

        @keyframes slideUp {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .user-info {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .user-info:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: -100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .btn-primary:hover::after {
            left: 100%;
        }

        .trip-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            height: 100%;
            transform: scale(0.98);
            opacity: 0.9;
        }

        .trip-card:hover {
            transform: scale(1) translateY(-10px);
            opacity: 1;
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        .trip-image {
            height: 200px;
            object-fit: cover;
            transition: all 0.4s ease;
        }

        .trip-card:hover .trip-image {
            transform: scale(1.05);
        }

        .stat-box {
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            background: var(--light-color);
            margin-bottom: 10px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .stat-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.8), transparent);
            transform: translateX(-100%);
            transition: 0.6s;
        }

        .stat-box:hover::before {
            transform: translateX(100%);
        }

        .stat-box i {
            font-size: 24px;
            color: var(--primary-color);
            margin-bottom: 10px;
            transition: transform 0.3s ease;
        }

        .stat-box:hover i {
            transform: scale(1.2);
        }

        .stat-box h3 {
            color: var(--dark-accent);
            font-weight: bold;
            margin: 10px 0;
        }

        .alert {
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .user-info i {
            transition: transform 0.3s ease;
        }

        .user-info:hover i {
            transform: scale(1.2) rotate(360deg);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('img/logo.png') }}" alt="TripBuddy Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('trips.index') }}">Trips</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('profile.show') }}">Profile</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
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

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="photo1" class="form-label">Main Photo (Required)</label>
                                <input type="file" class="form-control @error('photo1') is-invalid @enderror" 
                                       id="photo1" name="photo1" accept="image/*" required>
                                <div id="preview1" class="image-preview-container mt-2"></div>
                            </div>
                            <div class="col-md-4">
                                <label for="photo2" class="form-label">Additional Photo</label>
                                <input type="file" class="form-control @error('photo2') is-invalid @enderror" 
                                       id="photo2" name="photo2" accept="image/*">
                                <div id="preview2" class="image-preview-container mt-2"></div>
                            </div>
                            <div class="col-md-4">
                                <label for="photo3" class="form-label">Additional Photo</label>
                                <input type="file" class="form-control @error('photo3') is-invalid @enderror" 
                                       id="photo3" name="photo3" accept="image/*">
                                <div id="preview3" class="image-preview-container mt-2"></div>
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
</body>
</html>