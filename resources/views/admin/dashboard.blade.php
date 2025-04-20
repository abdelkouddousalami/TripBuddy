<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - TripBuddy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary-color: #386641;
            --secondary-color: #6A994E;
            --accent-color: #A7C957;
            --light-color: #F2E8CF;
            --dark-accent: #BC4749;
        }

        body {
            background-color: #f8f9fa;
        }

        .dashboard-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            border: none;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-card {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .stat-card .display-4 {
            font-weight: 600;
            margin-bottom: 0;
        }

        .chart-container {
            position: relative;
            height: 300px;
            margin-top: 1rem;
        }

        .table-container {
            max-height: 400px;
            overflow-y: auto;
            border-radius: 10px;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            background-color: #f8f9fa;
            border-top: none;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            color: #666;
        }

        .table td {
            vertical-align: middle;
        }

        .action-buttons .btn {
            margin: 0 0.25rem;
            padding: 0.375rem 0.75rem;
            border-radius: 50px;
        }

        .badge {
            padding: 0.5em 1em;
            border-radius: 50px;
            font-weight: 500;
        }

        .modal-content {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            border-bottom: 2px solid #f8f9fa;
            padding: 1.5rem;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            border-top: 2px solid #f8f9fa;
            padding: 1.5rem;
        }

        .info-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1.25rem;
            margin-bottom: 1rem;
        }

        .info-card h6 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .photo-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin: 1rem 0;
        }

        .photo-gallery img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .photo-gallery img:hover {
            transform: scale(1.05);
        }

        .document-preview {
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 10px;
            margin-top: 1rem;
        }

        .navbar {
            background: var(--primary-color);
            padding: 1rem 0;
        }

        .navbar-brand {
            color: white;
            font-weight: 600;
        }

        .navbar-brand i {
            margin-right: 0.5rem;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .nav-link:hover {
            color: white !important;
        }

        .status-badge {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-group-vertical .btn {
            text-align: left;
            padding: 0.75rem 1rem;
        }

        .progress {
            height: 8px;
            margin-top: 0.5rem;
        }

        .activity-item {
            padding: 1rem;
            border-left: 3px solid var(--primary-color);
            background: #fff;
            margin-bottom: 1rem;
            border-radius: 0 10px 10px 0;
        }

        /* Enhanced Modal Styles */
        .modal-xl {
            max-width: 1140px;
        }

        .detail-modal .modal-content {
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .detail-modal .modal-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 1.5rem;
        }

        .detail-modal .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .detail-modal .modal-body {
            padding: 2rem;
        }

        .info-section {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .info-section h6 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            font-size: 1.1rem;
        }

        .info-section h6 i {
            margin-right: 0.75rem;
            font-size: 1.2rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1rem;
        }

        .info-item {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            border-left: 4px solid var(--primary-color);
        }

        .info-item strong {
            display: block;
            color: #666;
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }

        .info-item p {
            margin: 0;
            color: #333;
            font-size: 1rem;
        }

        .photo-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin: 1rem 0;
        }

        .photo-gallery .photo-item {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .photo-gallery .photo-item:hover {
            transform: translateY(-5px);
        }

        .photo-gallery img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }

        .photo-label {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 0.5rem;
            background: rgba(0,0,0,0.7);
            color: white;
            font-size: 0.875rem;
            text-align: center;
        }

        .document-section {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            border: 2px dashed #dee2e6;
        }

        .document-section .btn {
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 500;
        }

        .document-section i {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .detail-modal .modal-footer {
            background: #f8f9fa;
            border-top: none;
            padding: 1.5rem;
            justify-content: space-between;
        }

        .detail-modal .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 500;
        }

        .property-description {
            background: white;
            border-radius: 8px;
            padding: 1.25rem;
            margin-top: 1rem;
            border-left: 4px solid var(--accent-color);
        }

        .status-indicator {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .status-indicator i {
            margin-right: 0.5rem;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-approved {
            background: #d4edda;
            color: #155724;
        }

        .status-rejected {
            background: #f8d7da;
            color: #721c24;
        }

        /* Modal Animation Styles */
        .modal.fade .modal-dialog {
            transition: transform 0.3s ease-out;
            transform: translateY(-100px) scale(0.95);
        }

        .modal.show .modal-dialog {
            transform: translateY(0) scale(1);
        }

        .modal-backdrop {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-backdrop.show {
            opacity: 0.5;
        }

        .detail-modal .modal-content {
            opacity: 0;
            transform: translateY(-20px);
            transition: all 0.3s ease;
        }

        .detail-modal.show .modal-content {
            opacity: 1;
            transform: translateY(0);
        }

        /* Modal Loading State */
        .modal-loader {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .modal-loader.active {
            display: block;
        }

        .loader-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Fix for modal scroll jump */
        .modal-open {
            padding-right: 0 !important;
            overflow: auto !important;
        }

        /* Prevent content shift when modal opens */
        body {
            overflow-y: scroll !important;
        }

        /* Smooth image loading */
        .photo-item img {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .photo-item img.loaded {
            opacity: 1;
        }

        /* Improved modal scrolling */
        .modal-dialog-scrollable .modal-content {
            max-height: 90vh;
        }

        .modal-dialog-scrollable .modal-body {
            overflow-y: auto;
            overscroll-behavior: contain;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-chart-line"></i>Admin Dashboard
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
        <!-- Quick Stats -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="dashboard-card stat-card">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="h5 mb-0">Total Users</h3>
                            <h2 class="display-4">{{ $stats['total_users'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-card stat-card">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-plane fa-2x"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="h5 mb-0">Total Trips</h3>
                            <h2 class="display-4">{{ $stats['total_trips'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-card stat-card">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-hotel fa-2x"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="h5 mb-0">Owner Requests</h3>
                            <h2 class="display-4">{{ $stats['owner_requests']->where('status', 'pending')->count() }}</h2>
                            <span class="small">Pending approval</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Owner Requests Section -->
        <div class="dashboard-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0">
                    <i class="fas fa-hotel text-primary me-2"></i>
                    Owner Requests
                </h3>
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-primary active" data-filter="all">
                        All <span class="badge bg-primary">{{ $stats['owner_requests']->count() }}</span>
                    </button>
                    <button type="button" class="btn btn-outline-warning" data-filter="pending">
                        Pending <span class="badge bg-warning text-dark">{{ $stats['owner_requests']->where('status', 'pending')->count() }}</span>
                    </button>
                    <button type="button" class="btn btn-outline-success" data-filter="approved">
                        Approved <span class="badge bg-success">{{ $stats['owner_requests']->where('status', 'approved')->count() }}</span>
                    </button>
                    <button type="button" class="btn btn-outline-danger" data-filter="rejected">
                        Rejected <span class="badge bg-danger">{{ $stats['owner_requests']->where('status', 'rejected')->count() }}</span>
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Property Name</th>
                            <th>Type</th>
                            <th>City</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stats['owner_requests'] as $request)
                        <tr class="request-row" data-status="{{ $request->status }}">
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="ms-2">
                                        <div class="fw-bold">{{ $request->user->name }}</div>
                                        <div class="small text-muted">{{ $request->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $request->hotel->name }}</td>
                            <td><span class="badge bg-secondary">{{ ucfirst($request->hotel->type) }}</span></td>
                            <td>{{ $request->hotel->city }}</td>
                            <td>
                                <span class="badge status-badge bg-{{ $request->status === 'pending' ? 'warning' : ($request->status === 'approved' ? 'success' : 'danger') }}">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </td>
                            <td>
                                <div>{{ $request->created_at->format('M d, Y') }}</div>
                                <div class="small text-muted">{{ $request->created_at->format('h:i A') }}</div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('owner-requests.show', $request) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>
                                    @if($request->status === 'pending')
                                        <form action="{{ route('owner-requests.approve', $request) }}" method="POST" class="d-inline approve-form">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-check"></i> Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('owner-requests.reject', $request) }}" method="POST" class="d-inline reject-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-times"></i> Reject
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <p class="mb-0">No owner requests found</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Other dashboard content -->
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
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stats['recent_users'] as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'owner' ? 'warning' : 'success') }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    <td>
                                        <form action="{{ route('admin.updateRole') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <select name="role" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                                <option value="tripper" {{ $user->role === 'tripper' ? 'selected' : '' }}>Tripper</option>
                                                <option value="owner" {{ $user->role === 'owner' ? 'selected' : '' }}>Owner</option>
                                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                            </select>
                                        </form>
                                    </td>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <script>
        // Filter owner requests
        document.querySelectorAll('[data-filter]').forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.dataset.filter;
                const rows = document.querySelectorAll('.request-row');

                // Update active state of filter buttons
                document.querySelectorAll('[data-filter]').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                rows.forEach(row => {
                    if (filter === 'all' || row.dataset.status === filter) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });

        // Confirm approve/reject actions
        document.querySelectorAll('.approve-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Approve Owner Request?',
                    text: "This will grant owner privileges to the user",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#198754',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, approve'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });

        document.querySelectorAll('.reject-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Reject Owner Request?',
                    text: "This action cannot be undone",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, reject'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });

        // Image preview modals
        const photoModals = document.querySelectorAll('[id^="photoModal"]');
        photoModals.forEach(modal => {
            modal.addEventListener('show.bs.modal', function (event) {
                const img = this.querySelector('img');
                img.style.maxHeight = '80vh';
                img.style.width = 'auto';
                img.style.margin = '0 auto';
                img.style.display = 'block';
            });
        });

        // Charts
        // User Roles Chart
        const userRolesData = {!! json_encode($stats['users_by_role']->pluck('role')) !!};
        const userRolesCounts = {!! json_encode($stats['users_by_role']->pluck('count')) !!};
        
        const userRolesCtx = document.getElementById('userRolesChart').getContext('2d');
        new Chart(userRolesCtx, {
            type: 'pie',
            data: {
                labels: userRolesData,
                datasets: [{
                    data: userRolesCounts,
                    backgroundColor: [
                        '#386641',
                        '#BC4749',
                    ],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Trips by Month Chart
        const tripsByMonthCtx = document.getElementById('tripsByMonthChart').getContext('2d');
        const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const monthData = new Array(12).fill(0);
        
        const tripsData = {!! json_encode($stats['trips_by_month']) !!};
        tripsData.forEach(item => {
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

        function openPhotoModal(imageUrl) {
            const modal = document.getElementById('photoModal');
            const modalImg = modal.querySelector('img');
            const loader = document.createElement('div');
            loader.className = 'loader-spinner';
            modal.querySelector('.modal-body').appendChild(loader);
            
            modalImg.style.opacity = '0';
            modalImg.src = imageUrl;
            
            modalImg.onload = function() {
                loader.remove();
                modalImg.style.opacity = '1';
            };
            
            const photoModal = new bootstrap.Modal(modal);
            photoModal.show();
        }

        // Enhanced modal functionality
        function prepareModal(modalId) {
            const modal = document.getElementById(modalId);
            const loader = modal.querySelector('.modal-loader');
            const content = modal.querySelector('.modal-body-content');
            
            // Show loader, hide content
            loader.classList.add('active');
            content.style.display = 'none';
            
            // Simulate loading (remove this in production if data is loaded dynamically)
            setTimeout(() => {
                loader.classList.remove('active');
                content.style.display = 'block';
                
                // Load images smoothly
                const images = content.querySelectorAll('img');
                images.forEach(img => {
                    if (img.complete) {
                        img.classList.add('loaded');
                    } else {
                        img.addEventListener('load', () => {
                            img.classList.add('loaded');
                        });
                    }
                });
            }, 500);
        }

        // Handle modal events
        document.querySelectorAll('.detail-modal').forEach(modal => {
            // Reset modal state when closed
            modal.addEventListener('hidden.bs.modal', function () {
                const content = this.querySelector('.modal-body-content');
                const loader = this.querySelector('.modal-loader');
                content.style.display = 'none';
                loader.classList.remove('active');
            });

            // Prevent modal from closing when clicking inside
            modal.querySelector('.modal-content').addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });

        // Prevent body scroll jump
        const originalPadding = window.getComputedStyle(document.body).paddingRight;
        
        document.querySelectorAll('.detail-modal').forEach(modal => {
            modal.addEventListener('show.bs.modal', function () {
                const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
                document.body.style.paddingRight = scrollbarWidth + 'px';
            });
            
            modal.addEventListener('hidden.bs.modal', function () {
                document.body.style.paddingRight = originalPadding;
            });
        });

        // Add smooth transitions for all modals
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('show.bs.modal', function() {
                    this.style.display = 'block';
                    setTimeout(() => this.classList.add('show'), 50);
                });

                modal.addEventListener('hide.bs.modal', function() {
                    this.classList.remove('show');
                    setTimeout(() => this.style.display = 'none', 300);
                });
            });
        });
    </script>
</body>
</html>