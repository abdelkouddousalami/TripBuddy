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
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
   
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
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

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

        <div class="row">
            <div class="col-md-6">
                <div class="dashboard-card">
                    <h3>Manage Users</h3>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
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
                                    <td>
                                        <div class="action-buttons">
                                            <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.suspendUser', $user->id) }}" method="POST" class="d-inline suspend-form">
                                                @csrf
                                                <button type="submit" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-ban"></i> Suspend
                                                </button>
                                            </form>
                                        </div>
                                    </td>
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
        document.querySelectorAll('[data-filter]').forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.dataset.filter;
                const rows = document.querySelectorAll('.request-row');

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

        function prepareModal(modalId) {
            const modal = document.getElementById(modalId);
            const loader = modal.querySelector('.modal-loader');
            const content = modal.querySelector('.modal-body-content');
            
            loader.classList.add('active');
            content.style.display = 'none';
            
            setTimeout(() => {
                loader.classList.remove('active');
                content.style.display = 'block';
                
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

        document.querySelectorAll('.detail-modal').forEach(modal => {
            modal.addEventListener('hidden.bs.modal', function () {
                const content = this.querySelector('.modal-body-content');
                const loader = this.querySelector('.modal-loader');
                content.style.display = 'none';
                loader.classList.remove('active');
            });

            modal.querySelector('.modal-content').addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });

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

        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Delete User?',
                    text: "This action cannot be undone",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });

        document.querySelectorAll('.suspend-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Suspend User?',
                    text: "This will temporarily disable the user",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#ffc107',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, suspend'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    </script>
</body>
</html>