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
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top" data-aos="fade-down">
        <div class="container">
            <!-- Logo on the left -->
            <a class="navbar-brand" href="{{ route('home') }}">
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
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('trips.index') }}">All Trips</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('trips.create') }}">Post a Trip</a>
                        </li>
                    @endauth
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
                                @if(Auth::user()->role === 'admin')
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                                @endif
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
</body>
</html>