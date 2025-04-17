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