<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - TripBuddy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary-color: #386641;
            --secondary-color: #6A994E;
            --accent-color: #A7C957;
            --light-color: #F2E8CF;
            --dark-accent: #BC4749;
        }

        .dashboard-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .stat-card {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        .table-container {
            max-height: 400px;
            overflow-y: auto;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-chart-line me-2"></i>Admin Dashboard
            </a>
            <div class="d-flex">
                <a href="{{ route('home') }}" class="btn btn-outline-light me-2">
                    <i class="fas fa-home"></i> Site Home
                </a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <!-- Stats Overview -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="dashboard-card stat-card">
                    <h3 class="h5"><i class="fas fa-users"></i> Total Users</h3>
                    <h2 class="display-4">{{ $stats['total_users'] }}</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-card stat-card">
                    <h3 class="h5"><i class="fas fa-plane"></i> Total Trips</h3>
                    <h2 class="display-4">{{ $stats['total_trips'] }}</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-card stat-card">
                    <h3 class="h5"><i class="fas fa-comments"></i> Total Comments</h3>
                    <h2 class="display-4">{{ $stats['total_comments'] }}</h2>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="dashboard-card">
                    <h3>User Roles Distribution</h3>
                    <div class="chart-container">
                        <canvas id="userRolesChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="dashboard-card">
                    <h3>Trips by Month ({{ date('Y') }})</h3>
                    <div class="chart-container">
                        <canvas id="tripsByMonthChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="row">
            <div class="col-md-6">
                <div class="dashboard-card">
                    <h3>Recent Users</h3>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stats['recent_users'] as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'success' }}">{{ $user->role }}</span></td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="dashboard-card">
                    <h3>Recent Trips</h3>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>User</th>
                                    <th>City</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stats['recent_trips'] as $trip)
                                <tr>
                                    <td>{{ $trip->title }}</td>
                                    <td>{{ $trip->user->name }}</td>
                                    <td>{{ $trip->city }}</td>
                                    <td>{{ $trip->created_at->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // User Roles Chart
        const userRolesCtx = document.getElementById('userRolesChart').getContext('2d');
        new Chart(userRolesCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($stats['users_by_role']->pluck('role')) !!},
                datasets: [{
                    data: {!! json_encode($stats['users_by_role']->pluck('count')) !!},
                    backgroundColor: [
                        '#386641',
                        '#BC4749',
                    ],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });

        // Trips by Month Chart
        const tripsByMonthCtx = document.getElementById('tripsByMonthChart').getContext('2d');
        const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const monthData = new Array(12).fill(0);
        
        {!! json_encode($stats['trips_by_month']) !!}.forEach(item => {
            monthData[item.month - 1] = item.count;
        });

        new Chart(tripsByMonthCtx, {
            type: 'bar',
            data: {
                labels: monthNames,
                datasets: [{
                    label: 'Number of Trips',
                    data: monthData,
                    backgroundColor: '#6A994E',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>