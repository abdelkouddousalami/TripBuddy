<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Request Details - TripBuddy Admin</title>
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
            background-color: #f8f9fa;
            padding-top: 2rem;
        }

        .navbar {
            background: var(--primary-color);
            padding: 1rem 0;
            margin-bottom: 2rem;
        }

        .navbar-brand {
            color: white !important;
            font-weight: 600;
        }

        .navbar .btn-outline-light:hover {
            background-color: var(--light-color);
            color: var(--primary-color);
        }

        .detail-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .detail-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem;
            position: relative;
        }

        .status-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
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

        .info-section {
            padding: 2rem;
            border-bottom: 1px solid #eee;
        }

        .info-section:last-child {
            border-bottom: none;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin: 1rem 0;
        }

        .info-item {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            border-left: 4px solid var(--primary-color);
        }

        .section-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 0.75rem;
            font-size: 1.2rem;
        }

        .photo-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1rem;
            margin: 1rem 0;
        }

        .photo-item {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .photo-item img {
            width: 100%;
            height: 250px;
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
            text-align: center;
        }

        .description-box {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            margin-top: 1rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .action-buttons .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 500;
        }

        .document-section {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 8px;
            text-align: center;
        }

        .document-section i {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-chart-line me-2"></i>Admin Dashboard
            </a>
            <div class="d-flex">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light">
                    <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- Request Details -->
        <div class="detail-card">
            <div class="detail-header">
                <h1 class="h3 mb-0">Owner Request Details</h1>
                <p class="mb-0 mt-2">Submitted {{ $ownerRequest->created_at->format('M d, Y \a\t h:i A') }}</p>
                <span class="status-badge status-{{ $ownerRequest->status }}">
                    {{ ucfirst($ownerRequest->status) }}
                </span>
            </div>

            <!-- User Information -->
            <div class="info-section">
                <h2 class="section-title">
                    <i class="fas fa-user"></i>User Information
                </h2>
                <div class="info-grid">
                    <div class="info-item">
                        <strong class="d-block text-muted mb-1">Name</strong>
                        <span>{{ $ownerRequest->user->name }}</span>
                    </div>
                    <div class="info-item">
                        <strong class="d-block text-muted mb-1">Email</strong>
                        <span>{{ $ownerRequest->user->email }}</span>
                    </div>
                    <div class="info-item">
                        <strong class="d-block text-muted mb-1">Member Since</strong>
                        <span>{{ $ownerRequest->user->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="info-item">
                        <strong class="d-block text-muted mb-1">City</strong>
                        <span>{{ $ownerRequest->user->city }}</span>
                    </div>
                </div>

                <h3 class="h5 mt-4 mb-3">Request Reason</h3>
                <div class="description-box">
                    {{ $ownerRequest->reason }}
                </div>
            </div>

            <!-- Property Information -->
            <div class="info-section">
                <h2 class="section-title">
                    <i class="fas fa-building"></i>Property Information
                </h2>
                <div class="info-grid">
                    <div class="info-item">
                        <strong class="d-block text-muted mb-1">Name</strong>
                        <span>{{ $ownerRequest->hotel->name }}</span>
                    </div>
                    <div class="info-item">
                        <strong class="d-block text-muted mb-1">Type</strong>
                        <span>{{ ucfirst($ownerRequest->hotel->type) }}</span>
                    </div>
                    <div class="info-item">
                        <strong class="d-block text-muted mb-1">City</strong>
                        <span>{{ $ownerRequest->hotel->city }}</span>
                    </div>
                    <div class="info-item">
                        <strong class="d-block text-muted mb-1">Address</strong>
                        <span>{{ $ownerRequest->hotel->address }}</span>
                    </div>
                </div>

                <h3 class="h5 mt-4 mb-3">Property Description</h3>
                <div class="description-box">
                    {{ $ownerRequest->hotel->description }}
                </div>
            </div>

            <!-- Property Photos -->
            <div class="info-section">
                <h2 class="section-title">
                    <i class="fas fa-images"></i>Property Photos
                </h2>
                <div class="photo-gallery">
                    <div class="photo-item">
                        <img src="{{ asset('storage/' . $ownerRequest->hotel->photo1) }}" 
                             alt="Main Photo" class="img-fluid"
                             onclick="openPhotoViewer(this.src)">
                        <div class="photo-label">Main Photo</div>
                    </div>
                    @if($ownerRequest->hotel->photo2)
                        <div class="photo-item">
                            <img src="{{ asset('storage/' . $ownerRequest->hotel->photo2) }}" 
                                 alt="Additional Photo" class="img-fluid"
                                 onclick="openPhotoViewer(this.src)">
                            <div class="photo-label">Additional Photo</div>
                        </div>
                    @endif
                    @if($ownerRequest->hotel->photo3)
                        <div class="photo-item">
                            <img src="{{ asset('storage/' . $ownerRequest->hotel->photo3) }}" 
                                 alt="Additional Photo" class="img-fluid"
                                 onclick="openPhotoViewer(this.src)">
                            <div class="photo-label">Additional Photo</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Ownership Documentation -->
            <div class="info-section">
                <h2 class="section-title">
                    <i class="fas fa-file-alt"></i>Ownership Documentation
                </h2>
                <div class="document-section">
                    <i class="fas fa-file-pdf"></i>
                    <h4 class="mb-3">Proof of Ownership Document</h4>
                    <a href="{{ asset('storage/' . $ownerRequest->hotel->proof_document) }}" 
                       class="btn btn-outline-primary" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i>View Document in New Tab
                    </a>
                </div>
            </div>

            <!-- Action Buttons -->
            @if($ownerRequest->status === 'pending')
                <div class="info-section">
                    <h2 class="section-title">
                        <i class="fas fa-tasks"></i>Actions
                    </h2>
                    <div class="action-buttons">
                        <form action="{{ route('owner-requests.approve', $ownerRequest) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to approve this request?')">
                                <i class="fas fa-check me-2"></i>Approve Request
                            </button>
                        </form>
                        <form action="{{ route('owner-requests.reject', $ownerRequest) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to reject this request? This action cannot be undone.')">
                                <i class="fas fa-times me-2"></i>Reject Request
                            </button>
                        </form>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Photo Viewer Modal -->
    <div class="modal fade" id="photoViewer" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3 bg-white" data-bs-dismiss="modal"></button>
                    <img src="" alt="Property Photo" class="img-fluid w-100">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openPhotoViewer(imageUrl) {
            const modal = document.getElementById('photoViewer');
            const modalImg = modal.querySelector('img');
            modalImg.src = imageUrl;
            const photoModal = new bootstrap.Modal(modal);
            photoModal.show();
        }
    </script>
</body>
</html>