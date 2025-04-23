<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TripBuddy - Find Your Travel Companion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #386641;
            --secondary-color: #6A994E;
            --accent-color: #A7C957;
            --light-color: #F2E8CF;
            --dark-accent: #BC4749;
        }

        .navbar {
            height: 90px !important;
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
            width: 110px !important;
            height: auto !important;
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

        /* Enhanced Navbar Styles */
        .navbar {
            height: 70px !important;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            transition: var(--transition);
            padding: 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;
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

        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(10px);
                padding: 1rem;
                border-radius: 0 0 15px 15px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
                position: fixed;
                top: 70px;
                left: 0;
                right: 0;
                max-height: calc(100vh - 70px);
                overflow-y: auto;
            }

            .nav-link {
                padding: 0.8rem 1.5rem;
                border-radius: 8px;
            }

            .nav-link:hover {
                background: rgba(56, 102, 65, 0.1);
            }

            .auth-buttons {
                flex-direction: column;
                width: 100%;
                gap: 0.5rem;
                padding: 1rem 0;
            }

            .auth-buttons .btn {
                width: 100%;
            }
        }

        @media (max-width: 575.98px) {
            .navbar {
                height: 60px !important;
            }

            .navbar-brand img {
                height: 35px;
            }

            .navbar-collapse {
                top: 60px;
                max-height: calc(100vh - 60px);
            }
        }

        .navbar-brand {
            padding: 0;
            margin-right: 2rem;
        }

        .navbar-brand img {
            height: 70px;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            height: 70px !important;
            box-shadow: 0 3px 20px rgba(0,0,0,0.1);
            background: var(--light-color);
        }

        .navbar.scrolled .navbar-brand img {
            height: 60px;
        }

        .nav-link {
            position: relative;
            font-weight: 600;
            font-size: 1.05rem;
            color: var(--primary-color) !important;
            padding: 0.5rem 1.2rem !important;
            margin: 0 0.3rem;
            transition: all 0.3s ease;
            border-radius: 25px;
        }

        .nav-link:hover {
            color: var(--dark-accent) !important;
            background: rgba(56, 102, 65, 0.08);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--dark-accent);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 50%;
        }

        /* Enhanced Auth Buttons */
        .auth-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .auth-buttons .btn {
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            border-radius: 25px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
        }

        .auth-buttons .btn-outline-primary {
            border-width: 2px;
            background: transparent;
        }

        .auth-buttons .btn-outline-primary:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(56, 102, 65, 0.2);
        }

        .auth-buttons .btn-primary {
            background: var(--primary-color);
            border: none;
            box-shadow: 0 5px 15px rgba(56, 102, 65, 0.2);
        }

        .auth-buttons .btn-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(56, 102, 65, 0.3);
        }

        /* Enhanced Dropdown Styles */
        .dropdown-menu {
            border: none;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            border-radius: 15px;
            padding: 1rem 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
        }

        .dropdown-item {
            padding: 0.7rem 1.5rem;
            font-weight: 500;
            color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: rgba(56, 102, 65, 0.08);
            color: var(--dark-accent);
            transform: translateX(5px);
        }

        /* Responsive Navbar Styles */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(15px);
                padding: 1rem;
                border-radius: 15px;
                margin-top: 1rem;
                box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            }

            .nav-link {
                padding: 0.8rem 1.5rem !important;
                margin: 0.3rem 0;
            }

            .auth-buttons {
                flex-direction: column;
                width: 100%;
                padding: 1rem 0;
            }

            .auth-buttons .btn {
                width: 100%;
                margin: 0.5rem 0;
            }

            .dropdown-menu {
                border: none;
                box-shadow: none;
                padding: 0;
                margin: 0;
            }

            .dropdown-item {
                padding: 0.8rem 2rem;
            }
        }

        @media (max-width: 767.98px) {
            .navbar {
                height: 70px !important;
            }

            .navbar-brand img {
                height: 60px;
            }
        }

        /* Hamburger Menu Enhancement */
        .navbar-toggler {
            border: none;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .navbar-toggler:focus {
            box-shadow: none;
            background: rgba(56, 102, 65, 0.08);
        }

        .navbar-toggler-icon {
            width: 1.5em;
            height: 1.5em;
        }

        /* Hero Section Enhanced Styles */
        .hero {
            min-height: 100vh;
            background: linear-gradient(rgba(45, 90, 39, 0.7), rgba(74, 120, 86, 0.7)), url("{{ asset('img/hero.jpg') }}") no-repeat center center;
            background-size: cover;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
            opacity: 0.1;
            animation: backgroundMove 30s linear infinite;
        }

        @keyframes backgroundMove {
            from { background-position: 0 0; }
            to { background-position: 100% 100%; }
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 150px;
            background: linear-gradient(0deg, var(--light-color) 0%, transparent 100%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: left;
            color: white;
            padding: 2rem;
            max-width: 800px;
        }

        .hero-title {
            font-size: 4.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            animation: fadeInDown 1.2s ease;
            line-height: 1.2;
            background: linear-gradient(45deg, #fff, #f2e8cf);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-subtitle {
            font-size: 1.8rem;
            margin-bottom: 2.5rem;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
            animation: fadeInUp 1.2s ease 0.3s;
            animation-fill-mode: both;
            opacity: 0.9;
        }

        .hero-buttons {
            animation: fadeInUp 1.2s ease 0.6s;
            animation-fill-mode: both;
        }

        .hero-buttons .btn {
            padding: 1rem 2.5rem;
            font-size: 1.2rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .hero-buttons .btn-danger {
            background: var(--dark-accent);
            border: none;
            box-shadow: 0 4px 15px rgba(188, 71, 73, 0.4);
        }

        .hero-buttons .btn-outline-light {
            border-width: 2px;
            backdrop-filter: blur(5px);
        }

        .hero-buttons .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .hero-stats {
            position: absolute;
            bottom: 180px;
            left: 0;
            right: 0;
            z-index: 2;
        }

        .hero-stat-item {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hero-stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: linear-gradient(45deg, #fff, #f2e8cf);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-stat-label {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            font-weight: 500;
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

        /* Featured Destinations */
        .destinations-section {
            background: var(--light-color);
            padding: 6rem 0;
            position: relative;
        }

        .section-title {
            color: var(--primary-color);
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
            text-shadow: var(--text-shadow);
        }

        .destination-card {
            background: var(--glass-bg);
            backdrop-filter: var(--glass-blur);
            border: var(--glass-border);
            border-radius: 20px;
            overflow: hidden;
            transition: var(--smooth-transition);
        }

        .destination-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--hover-shadow);
        }

        .destination-image {
            height: 300px;
            object-fit: cover;
            transition: var(--smooth-transition);
        }

        .destination-card:hover .destination-image {
            transform: scale(1.1);
        }

        .destination-content {
            padding: 2rem;
            background: rgba(255, 255, 255, 0.9);
        }

        /* How It Works Section */
        .how-it-works {
            background: white;
            padding: 6rem 0;
        }

        .step-card {
            text-align: center;
            padding: 2rem;
            background: var(--glass-bg);
            backdrop-filter: var(--glass-blur);
            border: var(--glass-border);
            border-radius: 20px;
            transition: var(--smooth-transition);
        }

        .step-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }

        .step-icon {
            width: 80px;
            height: 80px;
            background: var(--nature-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 2rem;
            box-shadow: var (--card-shadow);
        }

        /* Search Section */
        .search-section {
            background: var(--nature-gradient);
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
        }

        .search-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("{{ asset('img/pattern.png') }}") repeat;
            opacity: 0.1;
        }

        .search-container {
            background: var(--glass-bg);
            backdrop-filter: var(--glass-blur);
            border: var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: var(--card-shadow);
            position: relative;
            z-index: 1;
        }

        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Stats Section */
        .stats-section {
            background: white;
            padding: 4rem 0;
        }

        .stat-card {
            text-align: center;
            padding: 2rem;
            background: var(--glass-bg);
            backdrop-filter: var (--glass-blur);
            border: var(--glass-border);
            border-radius: 15px;
            transition: var(--smooth-transition);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--secondary-color);
            font-size: 1.1rem;
            font-weight: 500;
        }

        /* Global Variables */
        :root {
            --section-spacing: 8rem;
            --section-padding: 6rem;
            --card-spacing: 2rem;
            --transition-speed: 0.3s;
            --hover-lift: translateY(-5px);
            --card-shadow: 0 10px 30px rgba(0,0,0,0.1);
            --hover-shadow: 0 15px 40px rgba(0,0,0,0.15);
            --glass-blur: blur(10px);
            --border-radius: 20px;
            --z-index-base: 1;
            --z-index-header: 1030;
            --z-index-dropdown: 1000;
            --z-index-modal: 1050;
        }

        /* Enhanced Section Spacing */
        .section {
            padding: var(--section-spacing) 0;
            position: relative;
            overflow: hidden;
        }

        .section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100px;
            background: linear-gradient(to bottom, rgba(242, 232, 207, 0.1), transparent);
            pointer-events: none;
        }

        /* Enhanced Card Styles */
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            transition: all var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: var(--glass-blur);
        }

        .card:hover {
            transform: var(--hover-lift);
            box-shadow: var(--hover-shadow);
        }

        .card-img-top {
            height: 280px;
            object-fit: cover;
            border-top-left-radius: var(--border-radius);
            border-top-right-radius: var(--border-radius);
            transition: transform var(--transition-speed);
        }

        .card:hover .card-img-top {
            transform: scale(1.05);
        }

        /* Enhanced Section Titles */
        .section-title {
            margin-bottom: 4rem;
            position: relative;
            text-align: center;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--dark-accent);
            border-radius: 3px;
        }

        /* Enhanced Grid Spacing */
        .row {
            --bs-gutter-x: var(--card-spacing);
            --bs-gutter-y: var(--card-spacing);
        }

        /* Enhanced Button Styles */
        .btn {
            padding: 0.8rem 2rem;
            border-radius: 50px;
            transition: all var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 600;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        /* Enhanced Form Controls */
        .form-control {
            border-radius: 10px;
            padding: 1rem;
            border: 2px solid rgba(106, 153, 78, 0.2);
            transition: all var(--transition-speed);
        }

        .form-control:focus {
            box-shadow: 0 5px 15px rgba(106, 153, 78, 0.2);
            transform: translateY(-2px);
            border-color: var(--secondary-color);
        }

        /* Enhanced Stats Design */
        .hero-stats {
            bottom: 200px;
        }

        .hero-stat-item {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: var(--glass-blur);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--border-radius);
            padding: 2rem;
            transform: translateY(0);
            transition: all var(--transition-speed);
        }

        .hero-stat-item:hover {
            transform: var(--hover-lift);
            background: rgba(255, 255, 255, 0.15);
        }

        /* Enhanced Footer Design */
        .footer {
            position: relative;
            overflow: hidden;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100px;
            background: linear-gradient(to bottom, var(--light-color), transparent);
            opacity: 0.1;
        }

        .social-icon {
            width: 45px;
            height: 45px;
            margin: 0 10px;
            transition: all var(--transition-speed);
        }

        .social-icon:hover {
            transform: var(--hover-lift) scale(1.1);
        }

        /* Enhanced Animations */
        [data-aos] {
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }

        .section [data-aos] {
            transition-delay: calc(var(--delay, 0) * 100ms);
        }

        /* Fixed Positioning Issues */
        body {
            overflow-x: hidden;
            position: relative;
        }

        /* Enhanced Section Layout */
        .section {
            position: relative;
            padding: var(--section-padding) 0;
            margin: 0;
            overflow: hidden;
            z-index: var(--z-index-base);
        }

        .section > .container {
            position: relative;
            z-index: calc(var(--z-index-base) + 2);
        }

        /* Fixed Hero Section */
        .hero {
            position: relative;
            margin-top: -105px; /* Adjust for navbar height */
            padding-top: 105px;
            min-height: 100vh;
            z-index: var(--z-index-base);
        }

        .hero-content {
            position: relative;
            z-index: calc(var(--z-index-base) + 3);
            padding: 4rem 2rem;
        }

        .hero-stats {
            position: relative;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 2rem 0;
            margin-top: -150px;
            z-index: calc(var(--z-index-base) + 2);
        }

        /* Fixed Card Layouts */
        .card {
            position: relative;
            height: 100%;
            margin-bottom: 2rem;
            z-index: calc(var(--z-index-base) + 1);
        }

        .card-body {
            position: relative;
            z-index: calc(var(--z-index-base) + 1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        /* Fixed Booking Section */
        #booking {
            position: relative;
            z-index: calc(var(--z-index-base) + 1);
            padding-top: 8rem;
            padding-bottom: 8rem;
        }

        #booking .card {
            height: auto;
            min-height: 450px;
        }

        /* Fixed Buddy Section */
        #buddy {
            position: relative;
            z-index: calc(var(--z-index-base) + 1);
            padding-top: 8rem;
            padding-bottom: 8rem;
            background: #fff;
        }

        #buddy .card {
            height: 100%;
            min-height: 500px;
        }

        /* Fixed Destinations Section */
        #destinations {
            position: relative;
            z-index: calc(var(--z-index-base) + 1);
            padding-top: 8rem;
            padding-bottom: 8rem;
        }

        #destinations .card {
            height: 100%;
            min-height: 450px;
        }

        /* Enhanced Grid System */
        .row {
            --bs-gutter-x: 2rem;
            --bs-gutter-y: 2rem;
            margin-right: calc(var(--bs-gutter-x) * -0.5);
            margin-left: calc(var(--bs-gutter-x) * -0.5);
        }

        .row > * {
            padding-right: calc(var(--bs-gutter-x) * 0.5);
            padding-left: calc(var(--bs-gutter-x) * 0.5);
            margin-top: var(--bs-gutter-y);
        }

        /* Fixed Navbar */
        .navbar {
            position: relative;
            z-index: var(--z-index-header);
        }

        .navbar-collapse {
            z-index: calc(var(--z-index-header) + 1);
        }

        /* Enhanced Card Images */
        .card-img-top {
            height: 250px;
            object-fit: cover;
            width: 100%;
        }

        /* Enhanced Button Positioning */
        .card .btn {
            margin-top: auto;
            position: relative;
            z-index: calc(var(--z-index-base) + 2);
        }

        /* Fixed Footer */
        .footer {
            position: relative;
            z-index: calc(var(--z-index-base) + 1);
            padding: 6rem 0 3rem;
        }

        /* Media Queries for Responsive Layout */
        @media (max-width: 991.98px) {
            .hero-content {
                padding: 3rem 1rem;
            }

            .hero-stats {
                margin-top: -100px;
                padding: 1rem 0;
            }

            .section {
                padding: 4rem 0;
            }

            #booking .card,
            #buddy .card,
            #destinations .card {
                min-height: auto;
            }
        }

        @media (max-width: 767.98px) {
            .hero-title {
                font-size: 3rem;
            }

            .hero-subtitle {
                font-size: 1.4rem;
            }

            .hero-stats {
                margin-top: 2rem;
                position: relative;
            }

            .card {
                margin-bottom: 1rem;
            }
        }

        /* Enhanced Mobile Navbar Styles */
        @media (max-width: 991.98px) {
            .navbar {
                height: 70px !important;
                padding: 0.5rem 1rem;
            }

            .navbar-brand {
                padding: 0;
            }

            .navbar-brand img {
                height: 50px;
                max-width: 140px;
                object-fit: contain;
            }

            .navbar-toggler {
                padding: 0.4rem;
                border: none;
                background: rgba(56, 102, 65, 0.1);
                border-radius: 8px;
            }

            .navbar-toggler:focus {
                box-shadow: none;
                outline: none;
            }

            .navbar-collapse {
                position: fixed;
                top: 70px;
                left: 0;
                right: 0;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(10px);
                padding: 1rem;
                max-height: calc(100vh - 70px);
                overflow-y: auto;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                transform: translateY(-100%);
                transition: transform 0.3s ease-in-out;
            }

            .navbar-collapse.show {
                transform: translateY(0);
            }

            .navbar-nav {
                padding: 1rem 0;
            }

            .nav-item {
                margin: 0.5rem 0;
            }

            .nav-link {
                padding: 0.8rem 1.5rem !important;
                border-radius: 8px;
                background: rgba(56, 102, 65, 0.05);
            }

            .auth-buttons {
                flex-direction: column;
                width: 100%;
                gap: 0.5rem;
                padding: 1rem 0;
            }

            .auth-buttons .btn {
                width: 100%;
                margin: 0;
            }

            .dropdown-menu {
                border: none;
                background: rgba(255, 255, 255, 0.95);
                box-shadow: none;
                padding: 0;
                margin: 0.5rem 0;
            }

            .dropdown-item {
                padding: 0.8rem 1.5rem;
                border-radius: 8px;
            }
        }

        @media (max-width: 575.98px) {
            .navbar {
                height: 60px !important;
            }

            .navbar-brand img {
                height: 45px;
            }

            .navbar-collapse {
                top: 60px;
                max-height: calc(100vh - 60px);
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .hero-buttons .btn {
                width: 100%;
                margin: 0.5rem 0;
            }
        }

        /* Enhanced Mobile and Responsive Styles */
        @media (max-width: 991.98px) {
            .navbar {
                height: 60px !important;
                padding: 0.5rem 1rem;
            }

            .navbar-brand {
                padding: 0;
                margin-right: 1rem;
            }

            .navbar-brand img {
                height: 40px;
                max-width: 120px;
                object-fit: contain;
            }

            .navbar-toggler {
                padding: 0.25rem;
                border: none;
                background: transparent;
            }

            .navbar-collapse {
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(10px);
                position: fixed;
                top: 60px;
                left: 0;
                right: 0;
                padding: 1rem;
                border-radius: 0 0 15px 15px;
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
                max-height: calc(100vh - 60px);
                overflow-y: auto;
            }

            .navbar-nav {
                margin: 1rem 0;
            }

            .nav-item {
                margin: 0.5rem 0;
            }

            .nav-link {
                padding: 0.75rem 1rem !important;
                border-radius: 8px;
                background: rgba(56, 102, 65, 0.05);
                text-align: left;
                font-size: 1rem;
            }

            .auth-buttons {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
                padding: 1rem 0;
                width: 100%;
            }

            .auth-buttons .btn {
                width: 100%;
                margin: 0;
                padding: 0.75rem;
            }

            /* Hero Section Mobile Adjustments */
            .hero {
                min-height: calc(100vh - 60px);
                margin-top: 60px;
                padding: 2rem 0;
            }

            .hero-content {
                text-align: center;
                padding: 2rem 1rem;
            }

            .hero-title {
                font-size: 2rem;
                margin-bottom: 1rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
                margin-bottom: 2rem;
            }

            .hero-buttons {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .hero-buttons .btn {
                width: 100%;
                margin: 0;
            }

            .hero-stats {
                position: relative;
                margin-top: 2rem;
                padding: 0 1rem;
            }

            .hero-stat-item {
                padding: 1.5rem;
                margin-bottom: 1rem;
            }

            /* Section Adjustments */
            .section {
                padding: 3rem 0;
            }

            .section-title {
                font-size: 2rem;
                margin-bottom: 2rem;
            }

            .card {
                margin-bottom: 1.5rem;
            }

            .card-img-top {
                height: 200px;
            }
        }

        /* Small Mobile Devices */
        @media (max-width: 575.98px) {
            .navbar-brand img {
                height: 35px;
            }

            .hero-title {
                font-size: 1.75rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .hero-stat-number {
                font-size: 1.75rem;
            }

            .hero-stat-label {
                font-size: 0.9rem;
            }

            .section {
                padding: 2rem 0;
            }

            .card-img-top {
                height: 180px;
            }

            .footer {
                text-align: center;
            }

            .social-icon {
                width: 35px;
                height: 35px;
                font-size: 0.9rem;
            }
        }

        /* General Responsive Improvements */
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
            max-width: 100%;
        }

        @media (min-width: 992px) {
            .container {
                padding-left: 2rem;
                padding-right: 2rem;
            }
        }

        .row {
            margin-left: -0.75rem;
            margin-right: -0.75rem;
        }

        .row > * {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }

        /* Card Grid System */
        .card {
            height: 100%;
            display: flex;
            flex-direction: column;
            margin-bottom: 1.5rem;
        }

        .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .card-text {
            flex-grow: 1;
            margin-bottom: 1rem;
        }

        .card .btn {
            align-self: stretch;
        }

        /* Navigation Enhancements */
        .nav-link {
            white-space: nowrap;
            transition: all 0.3s ease;
        }

        /* Form Responsiveness */
        .form-control {
            font-size: 1rem;
            padding: 0.75rem 1rem;
        }

        /* Button Responsiveness */
        .btn {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            white-space: nowrap;
        }

        /* Footer Responsive Design */
        .footer {
            padding: 3rem 0 2rem;
        }

        @media (max-width: 767.98px) {
            .footer h4 {
                margin-top: 1.5rem;
            }

            .footer .col-lg-4:first-child h4 {
                margin-top: 0;
            }
        }

        /* Enhanced Utility Classes */
        .text-truncate-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .object-fit-cover {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

        /* Navbar Styles */
        .navbar {
            position: fixed;
            width: 100%;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            z-index: 1030;
        }

        .navbar.scrolled {
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            padding: 0;
        }

        .navbar-brand img {
            height: 50px;
            transition: height 0.3s ease;
        }

        .nav-link {
            color: var(--primary-color);
            font-weight: 600;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: var(--secondary-color);
        }

        .auth-buttons {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        /* Mobile Navigation */
        @media (max-width: 991.98px) {
            .navbar {
                padding: 0.5rem;
            }

            .navbar-collapse {
                position: fixed;
                top: 70px;
                left: 0;
                right: 0;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(10px);
                padding: 1rem;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                max-height: calc(100vh - 70px);
                overflow-y: auto;
                transform: translateY(-100%);
                transition: transform 0.3s ease-in-out;
                opacity: 0;
                visibility: hidden;
            }

            .navbar-collapse.show {
                transform: translateY(0);
                opacity: 1;
                visibility: visible;
            }

            .navbar-nav {
                margin: 1rem 0;
            }

            .nav-item {
                margin: 0.5rem 0;
            }

            .nav-link {
                padding: 0.75rem 1rem;
                background: rgba(56, 102, 65, 0.05);
                border-radius: 8px;
                display: block;
                text-align: left;
            }

            .auth-buttons {
                flex-direction: column;
                width: 100%;
            }

            .auth-buttons .btn {
                width: 100%;
                margin: 0.25rem 0;
            }

            .navbar-toggler {
                padding: 0.25rem;
                border: none;
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: transparent;
            }

            .navbar-toggler:focus {
                box-shadow: none;
                outline: none;
            }
        }

        /* Small Mobile Devices */
        @media (max-width: 575.98px) {
            .navbar-brand img {
                height: 40px;
            }

            .navbar-collapse {
                top: 60px;
                max-height: calc(100vh - 60px);
            }

            .nav-link {
                font-size: 0.95rem;
            }

            .auth-buttons .btn {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }
        }

        /* Dropdown Menu */
        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 0.5rem;
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: rgba(56, 102, 65, 0.05);
            transform: translateX(5px);
        }

        /* Base navbar fixes */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 70px !important;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            z-index: 1030;
            padding: 0 !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Container positioning */
        .navbar .container {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            position: relative;
        }

        /* Brand positioning */
        .navbar-brand {
            display: flex;
            align-items: center;
            padding: 0;
            margin: 0;
            height: 100%;
        }

        .navbar-brand img {
            height: 45px;
            width: auto;
            transition: all 0.3s ease;
        }

        /* Navigation menu positioning */
        .navbar-collapse {
            flex-grow: 1;
            display: flex;
            align-items: center;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            margin: 0 auto;
            padding: 0;
            gap: 1rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
        }

        .nav-link {
            padding: 0.5rem 1rem !important;
            color: var(--primary-color) !important;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            align-items: center;
        }

        /* Auth buttons positioning */
        .auth-buttons {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-left: auto;
        }

        .auth-buttons .btn {
            padding: 0.5rem 1.25rem;
            font-weight: 600;
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            white-space: nowrap;
        }

        /* Mobile navigation fixes */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                position: fixed;
                top: 70px;
                left: 0;
                right: 0;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(10px);
                padding: 1rem;
                height: calc(100vh - 70px);
                overflow-y: auto;
                display: none;
            }

            .navbar-collapse.show {
                display: block;
                animation: slideDown 0.3s ease-out forwards;
            }

            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .navbar-nav {
                flex-direction: column;
                width: 100%;
                gap: 0.5rem;
                margin: 1rem 0;
            }

            .nav-item {
                width: 100%;
            }

            .nav-link {
                padding: 0.75rem 1rem !important;
                width: 100%;
                background: rgba(56, 102, 65, 0.05);
                border-radius: 8px;
                justify-content: flex-start;
            }

            .auth-buttons {
                flex-direction: column;
                width: 100%;
                gap: 0.5rem;
                margin-top: 1rem;
            }

            .auth-buttons .btn {
                width: 100%;
                justify-content: center;
            }
        }

        /* Small mobile adjustments */
        @media (max-width: 575.98px) {
            .navbar {
                height: 60px !important;
            }

            .navbar .container {
                padding: 0 1rem;
            }

            .navbar-brand img {
                height: 35px;
            }

            .navbar-collapse {
                top: 60px;
                height: calc(100vh - 60px);
            }

            .navbar-toggler {
                padding: 0.25rem;
            }
        }

        /* Hero section margin adjustment */
        .hero {
            padding-top: 70px;
        }

        @media (max-width: 575.98px) {
            .hero {
                padding-top: 60px;
            }
        }

        /* Final navbar positioning fixes */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 70px !important;
            padding: 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            z-index: 9999;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar > .container {
            max-width: 1320px;
            margin: 0 auto;
            height: 100%;
            display: flex;
            align-items: center;
            padding: 0 1rem;
        }

        .navbar-nav {
            flex: 1;
            justify-content: center;
            margin: 0 2rem;
        }

        .navbar-collapse {
            display: flex;
            flex-basis: auto;
            flex-grow: 1;
            align-items: center;
            height: 100%;
        }

        .nav-item {
            height: 100%;
            display: flex;
            align-items: center;
        }

        .nav-link {
            height: 100%;
            display: flex;
            align-items: center;
            padding: 0 1.5rem !important;
            position: relative;
        }

        .auth-buttons {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                position: fixed;
                top: 70px;
                left: 0;
                right: 0;
                height: auto;
                max-height: calc(100vh - 70px);
                background: rgba(255, 255, 255, 0.98);
                padding: 1rem;
                overflow-y: auto;
                display: none;
            }

            .navbar-collapse.show {
                display: block;
            }

            .navbar-nav {
                flex-direction: column;
                margin: 0;
                padding: 1rem 0;
            }

            .nav-item, .nav-link {
                height: auto;
                width: 100%;
            }

            .auth-buttons {
                margin: 1rem 0 0 0;
                flex-direction: column;
                width: 100%;
            }

            .auth-buttons .btn {
                width: 100%;
            }
        }

        /* Fixed Navbar Core */
        .navbar {
            position: fixed !important;
            top: 0;
            left: 0;
            right: 0;
            height: 70px !important;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            z-index: 9999;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0 !important;
        }

        .navbar .container {
            max-width: 1320px;
            height: 100%;
            display: flex !important;
            align-items: center;
            justify-content: space-between;
            padding: 0 1rem;
        }

        /* Fixed Navigation */
        .navbar-collapse {
            flex: 1;
            display: flex;
            align-items: center;
            margin: 0 2rem;
        }

        .navbar-nav {
            margin: 0 auto !important;
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-item {
            margin: 0;
            padding: 0;
        }

        .nav-link {
            padding: 0.5rem 1rem !important;
            font-weight: 600;
            color: var(--primary-color) !important;
        }

        /* Fixed Auth Buttons */
        .auth-buttons {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .auth-buttons .btn {
            padding: 0.5rem 1.25rem;
            border-radius: 25px;
            font-weight: 600;
            min-width: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Mobile Adjustments */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                position: fixed;
                top: 70px;
                left: 0;
                right: 0;
                margin: 0;
                padding: 1rem;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(10px);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                display: none;
            }

            .navbar-collapse.show {
                display: block;
            }

            .navbar-nav {
                flex-direction: column;
                gap: 0.5rem;
                margin: 0 0 1rem 0 !important;
            }

            .nav-item {
                width: 100%;
            }

            .nav-link {
                width: 100%;
                text-align: center;
                padding: 0.75rem !important;
                background: rgba(56, 102, 65, 0.05);
                border-radius: 8px;
            }

            .auth-buttons {
                width: 100%;
                flex-direction: column;
                gap: 0.5rem;
                margin: 0;
            }

            .auth-buttons .btn,
            .auth-buttons .d-flex {
                width: 100%;
            }

            .auth-buttons .d-flex {
                flex-direction: column;
                gap: 0.5rem;
            }
        }

        /* Small Screen Adjustments */
        @media (max-width: 575.98px) {
            .navbar {
                height: 60px !important;
            }

            .navbar-brand img {
                height: 35px;
            }

            .navbar-collapse {
                top: 60px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('img/logo.png') }}" alt="TripBuddy Logo">
            </a>

            <!-- Mobile toggle button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation content -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Navigation links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('trips.index') }}">Find Buddy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#destinations">Destinations</a>
                    </li>
                </ul>
                
                <!-- Authentication buttons -->
                <div class="auth-buttons">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Sign In</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
                    @else
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.show') }}">My Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('trips.create') }}">Post a Trip</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
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

    <style>
        /* Core navbar styles */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 70px;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            z-index: 9999;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0;
        }

        .navbar .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100%;
            padding: 0 1rem;
        }

        /* Brand styles */
        .navbar-brand {
            display: flex;
            align-items: center;
            padding: 0;
            margin-right: 1rem;
        }

        .navbar-brand img {
            height: 45px;
            width: auto;
        }

        /* Navigation menu */
        .navbar-collapse {
            display: flex;
            align-items: center;
            height: 100%;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .nav-item {
            height: 100%;
            display: flex;
            align-items: center;
            margin: 0 0.5rem;
        }

        .nav-link {
            height: 100%;
            display: flex;
            align-items: center;
            padding: 0 1rem;
            color: var(--primary-color);
            font-weight: 600;
            transition: all 0.3s ease;
        }

        /* Auth buttons */
        .auth-buttons {
            display: flex;
            align-items: center;
            margin-left: 1rem;
        }

        .auth-buttons .btn {
            padding: 0.5rem 1.25rem;
            font-weight: 600;
            border-radius: 25px;
        }

        /* Mobile navigation */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                position: fixed;
                top: 70px;
                left: 0;
                right: 0;
                height: auto;
                background: rgba(255, 255, 255, 0.98);
                padding: 1rem;
                display: none;
                overflow-y: auto;
                max-height: calc(100vh - 70px);
            }

            .navbar-collapse.show {
                display: block;
            }

            .navbar-nav {
                flex-direction: column;
                height: auto;
                width: 100%;
                gap: 0.5rem;
            }

            .nav-item {
                width: 100%;
                height: auto;
                margin: 0;
            }

            .nav-link {
                width: 100%;
                padding: 0.75rem 1rem;
                justify-content: center;
                background: rgba(56, 102, 65, 0.05);
                border-radius: 8px;
            }

            .auth-buttons {
                margin: 1rem 0 0 0;
                width: 100%;
            }

            .auth-buttons .d-flex {
                width: 100%;
                flex-direction: column;
            }

            .auth-buttons .btn {
                width: 100%;
                margin: 0.25rem 0;
            }
        }

        /* Small screens */
        @media (max-width: 575.98px) {
            .navbar {
                height: 60px;
            }

            .navbar-brand img {
                height: 35px;
            }

            .navbar-collapse {
                top: 60px;
                max-height: calc(100vh - 60px);
            }
        }
    </style>

    <!-- Add margin-top to hero section to account for fixed navbar -->
    <section id="home" class="hero" style="margin-top: 70px;">
        <div class="container position-relative">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-8" data-aos="fade-right">
                    <div class="hero-content">
                        <h1 class="hero-title">Explore the World with New Friends</h1>
                        <p class="hero-subtitle">Connect with fellow travelers, share adventures, and create unforgettable memories together</p>
                        <div class="hero-buttons">
                            @auth
                                <a href="{{ route('trips.create') }}" class="btn btn-danger me-3">
                                    <i class="fas fa-plane-departure me-2"></i>Post a Trip
                                </a>
                                <a href="{{ route('trips.index') }}" class="btn btn-outline-light">
                                    <i class="fas fa-search me-2"></i>Find Trips
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-danger me-3">
                                    <i class="fas fa-sign-in-alt me-2"></i>Start Your Journey
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-outline-light">
                                    <i class="fas fa-user-plus me-2"></i>Join Our Community
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-stats">
                <div class="row g-4">
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="hero-stat-item">
                            <div class="hero-stat-number">10,000+</div>
                            <div class="hero-stat-label">Happy Travelers</div>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="hero-stat-item">
                            <div class="hero-stat-number">150+</</div>
                            <div class="hero-stat-label">Destinations</div>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="hero-stat-item">
                            <div class="hero-stat-number">5,000+</</div>
                            <div class="hero-stat-label">Active Trips</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Section -->
    <section id="booking" class="section bg-light">
        <div class="container">
            <h2 class="text-center mb-5" data-aos="fade-up">Find Your Perfect Stay</h2>
            <div class="row g-4">
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Hotels</h3>
                            <p class="card-text">Discover luxury hotels and resorts worldwide.</p>
                            <form>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Where do you want to go?">
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="date" class="form-control" placeholder="Check-in">
                                    </div>
                                    <div class="col">
                                        <input type="date" class="form-control" placeholder="Check-out">
                                    </div>
                                </div>
                                <button class="btn btn-primary w-100">Search Hotels</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Hostels</h3>
                            <p class="card-text">Find budget-friendly hostels and meet fellow travelers.</p>
                            <form>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Destination">
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="date" class="form-control" placeholder="Check-in">
                                    </div>
                                    <div class="col">
                                        <input type="date" class="form-control" placeholder="Check-out">
                                    </div>
                                </div>
                                <button class="btn btn-primary w-100">Search Hostels</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Find Buddy Section -->
    <section id="buddy" class="section">
        <div class="container">
            <h2 class="text-center mb-5" data-aos="fade-up">Find Your Travel Buddy</h2>
            <div class="row g-4">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                        <img src="{{ asset('img/paris.jpg') }}" class="card-img-top" alt="Traveler">
                        <div class="card-body">
                            <h5 class="card-title">Connect with Travelers</h5>
                            <p class="card-text">Find like-minded travelers heading to your destination.</p>
                            <a href="#" class="btn btn-outline-primary">Browse Travelers</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card">
                        <img src="{{ asset('img/tokyo.jpg') }}" class="card-img-top" alt="Adventure">
                        <div class="card-body">
                            <h5 class="card-title">Join Group Adventures</h5>
                            <p class="card-text">Participate in exciting group trips and activities.</p>
                            <a href="#" class="btn btn-outline-primary">Find Groups</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card">
                        <img src="{{ asset('img/bali.jpg') }}" class="card-img-top" alt="Friends">
                        <div class="card-body">
                            <h5 class="card-title">Create Your Trip</h5>
                            <p class="card-text">Plan your own trip and invite others to join.</p>
                            <a href="#" class="btn btn-outline-primary">Start Planning</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Destinations Section -->
    <section id="destinations" class="section bg-light">
        <div class="container">
            <h2 class="text-center mb-5" data-aos="fade-up">Popular Destinations</h2>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                        <img src="{{ asset('img/paris.jpg') }}" class="card-img-top" alt="Paris">
                        <div class="card-body">
                            <h5 class="card-title">Paris, France</h5>
                            <p class="card-text">The city of love and lights awaits you.</p>
                            <a href="#" class="btn btn-outline-primary">Explore</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card">
                        <img src="{{ asset('img/tokyo.jpg') }}" class="card-img-top" alt="Tokyo">
                        <div class="card-body">
                            <h5 class="card-title">Tokyo, Japan</h5>
                            <p class="card-text">Experience the perfect blend of tradition and future.</p>
                            <a href="#" class="btn btn-outline-primary">Explore</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card">
                        <img src="{{ asset('img/bali.jpg') }}" class="card-img-top" alt="Bali">
                        <div class="card-body">
                            <h5 class="card-title">Bali, Indonesia</h5>
                            <p class="card-text">Paradise island with rich culture and beauty.</p>
                            <a href="#" class="btn btn-outline-primary">Explore</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h4>TripBuddy</h4>
                    <p>Your ultimate travel companion for discovering new places and meeting amazing people.</p>
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h4>Quick Links</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none">About Us</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Contact</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Privacy Policy</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Terms of Service</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h4>Connect With Us</h4>
                    <div class="mt-3">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-4 bg-light">
            <div class="text-center">
                <p class="mb-0">&copy; 2025 TripBuddy. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true
        });

        // Enhanced Navbar functionality
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.querySelector('.navbar');
            const navbarCollapse = document.querySelector('.navbar-collapse');
            const navLinks = document.querySelectorAll('.nav-link');
            const navbarToggler = document.querySelector('.navbar-toggler');
            let isMenuOpen = false;

            // Navbar scroll effect
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // Toggle menu with animation
            navbarToggler.addEventListener('click', function() {
                isMenuOpen = !isMenuOpen;
                if (isMenuOpen) {
                    navbarCollapse.style.display = 'block';
                    // Trigger reflow
                    navbarCollapse.offsetHeight;
                    navbarCollapse.classList.add('show');
                    document.body.style.overflow = 'hidden';
                } else {
                    navbarCollapse.classList.remove('show');
                    document.body.style.overflow = 'auto';
                    // Wait for transition to finish before hiding
                    setTimeout(() => {
                        if (!isMenuOpen) {
                            navbarCollapse.style.display = 'none';
                        }
                    }, 300);
                }
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!navbar.contains(e.target) && isMenuOpen) {
                    navbarToggler.click();
                }
            });

            // Close mobile menu when clicking nav links
            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 992 && isMenuOpen) {
                        navbarToggler.click();
                    }
                });
            });

            // Reset menu state on resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 992) {
                    navbarCollapse.style.display = '';
                    navbarCollapse.classList.remove('show');
                    document.body.style.overflow = 'auto';
                    isMenuOpen = false;
                }
            });

            // Handle dropdown menus on mobile
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                const toggle = dropdown.querySelector('.dropdown-toggle');
                const menu = dropdown.querySelector('.dropdown-menu');
                
                toggle.addEventListener('click', (e) => {
                    if (window.innerWidth < 992) {
                        e.preventDefault();
                        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
                    }
                });
            });
        });
    </script>
</body>
</html>