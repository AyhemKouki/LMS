@extends('users.admin.layout.layout')
@use('Illuminate\Support\Facades\Storage')

@section('content')
    <div class="container-fluid px-4">
        <!-- Animated Header Section -->
        <div class="row mb-4 fade-in-up">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                    <div class="header-content">
                        <nav aria-label="breadcrumb" class="mb-2">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.instructor-requests.index') }}" class=" text-dark text-decoration-none">
                                        <i class="bi bi-person-check me-1"></i>Instructor Requests
                                    </a>
                                </li>
                                <li class="breadcrumb-item active"> Request Details</li>
                            </ol>
                        </nav>
                        <h1 class="h3 fw-bold text-dark mb-1 slide-in-left">
                            <i class="bi bi-file-person-fill  me-2"></i>
                            Request Details
                        </h1>
                        <p class="text-muted mb-0">Review and process instructor application</p>
                    </div>
                    <div class="header-actions slide-in-right">
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.instructor-requests.index') }}"
                               class="btn btn-outline-light rounded-pill px-4 hover-lift">
                            <i class="bi bi-arrow-left me-2"></i>Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Main Details Card -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden fade-in-up" style="animation-delay: 0.1s;">
                    <!-- User Profile Header -->
                    <div class="card-header bg-gradient-primary text-white border-0 py-4">
                        <div class="d-flex align-items-center">
                            <div class="position-relative">
                                <div class="avatar-large bg-white bg-opacity-20 text-white rounded-circle d-flex align-items-center justify-content-center me-3 pulse-animation"
                                     style="width: 60px; height: 60px;">
                                    @if( $instructorRequest->user->profile_image != "/images/avatar.jpg")
                                        <img
                                            src="{{ asset("storage/".$instructorRequest->user->profile_image) }}"
                                            class="rounded-circle w-100 h-100 object-fit-cover"
                                            alt="{{ $instructorRequest->user->name }}">
                                    @else
                                        <img src="{{asset($instructorRequest->user->profile_image)}}"  class="rounded-circle w-100 h-100 object-fit-cover"
                                             alt="{{ $instructorRequest->user->name }} ">
                                    @endif
                                </div>
                                <div class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-3 border-white animate-ping-slow"
                                     style="width: 18px; height: 18px;"></div>
                            </div>
                            <div>
                                <h4 class="mb-1 fw-bold">{{ $instructorRequest->user->name }}</h4>
                                <p class="mb-0 opacity-75">
                                    <i class="bi bi-envelope me-2"></i>{{ $instructorRequest->user->email }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Request Details Body -->
                    <div class="card-body p-0">
                        <div class="p-4">
                            <h5 class="fw-semibold text-dark mb-4">
                                <i class="bi bi-info-circle-fill text-primary me-2"></i>
                                Application Information
                            </h5>

                            <div class="details-grid">
                                <!-- User Info -->
                                <div class="detail-item slide-in-left" style="animation-delay: 0.2s;">
                                    <div class="detail-label">
                                        <i class="bi bi-person text-primary me-2"></i>
                                        <strong>Applicant Name</strong>
                                    </div>
                                    <div class="detail-value">{{ $instructorRequest->user->name }}</div>
                                </div>

                                <!-- Email -->
                                <div class="detail-item slide-in-left" style="animation-delay: 0.3s;">
                                    <div class="detail-label">
                                        <i class="bi bi-envelope text-primary me-2"></i>
                                        <strong>Email Address</strong>
                                    </div>
                                    <div class="detail-value">
                                        <a href="mailto:{{ $instructorRequest->user->email }}"
                                           class="text-decoration-none fw-medium hover-underline">
                                            {{ $instructorRequest->user->email }}
                                        </a>
                                    </div>
                                </div>

                                <!-- Request Date -->
                                <div class="detail-item slide-in-left" style="animation-delay: 0.4s;">
                                    <div class="detail-label">
                                        <i class="bi bi-calendar text-primary me-2"></i>
                                        <strong>Application Date</strong>
                                    </div>
                                    <div class="detail-value">
                                        <span class="fw-medium">{{ $instructorRequest->created_at->format('M d, Y') }}</span>
                                        <small class="text-muted ms-2">at {{ $instructorRequest->created_at->format('H:i A') }}</small>
                                        <br>
                                        <small class="text-muted">{{ $instructorRequest->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>

                                <!-- CV File -->
                                @if($instructorRequest->cv_file && Storage::disk('public')->exists($instructorRequest->cv_file))
                                    <div class="detail-item slide-in-left" style="animation-delay: 0.5s;">
                                        <div class="detail-label">
                                            <i class="bi bi-file-earmark-pdf text-primary me-2"></i>
                                            <strong>Curriculum Vitae</strong>
                                        </div>
                                        <div class="detail-value">
                                            <a href="{{ asset('storage/' . $instructorRequest->cv_file) }}"
                                               target="_blank"
                                               class="btn btn-outline-primary btn-sm rounded-pill px-3 hover-lift">
                                                <i class="bi bi-download me-2"></i>Download CV
                                            </a>
                                            <small class="text-muted d-block mt-1">Click to view or download</small>
                                        </div>
                                    </div>
                                @endif

                                <!-- Status -->
                                <div class="detail-item slide-in-left" style="animation-delay: 0.6s;">
                                    <div class="detail-label">
                                        <i class="bi bi-flag text-primary me-2"></i>
                                        <strong>Current Status</strong>
                                    </div>
                                    <div class="detail-value">
                                        <span class="badge bg-{{ $instructorRequest->status_color }} bg-opacity-15 text-light border border-{{ $instructorRequest->status_color }} border-opacity-25 px-3 py-2 rounded-pill fw-medium status-badge">
                                            <i class="bi bi-circle-fill me-2" style="font-size: 0.5rem;"></i>
                                            {{ ucfirst($instructorRequest->status) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Admin Notes -->
                                @if($instructorRequest->admin_notes)
                                    <div class="detail-item slide-in-left" style="animation-delay: 0.7s;">
                                        <div class="detail-label">
                                            <i class="bi bi-chat-square-text text-primary me-2"></i>
                                            <strong>Admin Notes</strong>
                                        </div>
                                        <div class="detail-value">
                                            <div class="alert alert-light border rounded-3 mb-0">
                                                <p class="mb-0">{{ $instructorRequest->admin_notes }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Review Information -->
                                @if($instructorRequest->reviewed_at)
                                    <div class="detail-item slide-in-left" style="animation-delay: 0.8s;">
                                        <div class="detail-label">
                                            <i class="bi bi-clock-history text-primary me-2"></i>
                                            <strong>Review Date</strong>
                                        </div>
                                        <div class="detail-value">
                                            <span class="fw-medium">{{ $instructorRequest->reviewed_at->format('M d, Y') }}</span>
                                            <small class="text-muted ms-2">at {{ $instructorRequest->reviewed_at->format('H:i A') }}</small>
                                        </div>
                                    </div>
                                @endif

                                @if($instructorRequest->reviewer)
                                    <div class="detail-item slide-in-left" style="animation-delay: 0.9s;">
                                        <div class="detail-label">
                                            <i class="bi bi-person-check text-primary me-2"></i>
                                            <strong>Reviewed By</strong>
                                        </div>
                                        <div class="detail-value">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-2"
                                                     style="width: 32px; height: 32px;">
                                                    <i class="bi bi-person-fill"></i>
                                                </div>
                                                <div>
                                                    <span class="fw-medium">{{ $instructorRequest->reviewer->name }}</span>
                                                    <span class="badge bg-primary ms-2">Admin</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Panel -->
            <div class="col-lg-4">
                @if($instructorRequest->status === 'pending')
                    <!-- Process Request Card -->
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden fade-in-up" style="animation-delay: 0.2s;">
                        <div class="card-header bg-gradient-warning text-dark border-0 py-3">
                            <h5 class="mb-0 fw-semibold">
                                <i class="bi bi-gear-fill me-2"></i>Process Request
                            </h5>
                            <small class="opacity-75">Make your decision below</small>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('admin.instructor-requests.update-status', $instructorRequest) }}"
                                  method="POST" id="statusForm" class="animate-form">
                                @csrf
                                @method('PATCH')

                                <div class="mb-4">
                                    <label for="status" class="form-label fw-semibold">
                                        Decision <span class="text-danger">*</span>
                                    </label>
                                    <select name="status" id="status" class="form-select form-select-lg rounded-3 status-select" required>
                                        <option value="">Choose your decision...</option>
                                        <option value="approved" class="text-success">
                                            ✓ Approve Application
                                        </option>
                                        <option value="rejected" class="text-danger">
                                            ✗ Reject Application
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="admin_notes" class="form-label fw-semibold">
                                        Additional Notes
                                        <small class="text-muted">(Optional)</small>
                                    </label>
                                    <textarea name="admin_notes" id="admin_notes"
                                              class="form-control rounded-3" rows="4"
                                              placeholder="Add feedback or comments for the applicant..."></textarea>
                                    <small class="text-muted">These notes will be visible to the applicant</small>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg rounded-pill hover-lift submit-btn" disabled>
                                        <i class="bi bi-check-circle-fill me-2"></i>
                                        <span class="btn-text">Process Application</span>
                                        <div class="btn-spinner spinner-border spinner-border-sm ms-2 d-none" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </button>
                                    <small class="text-muted text-center">
                                        <i class="bi bi-info-circle me-1"></i>
                                        This action cannot be undone
                                    </small>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Status Display Card -->
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden fade-in-up" style="animation-delay: 0.2s;">
                        <div class="card-header bg-light border-0 py-3">
                            <h5 class="mb-0 fw-semibold text-dark">
                                <i class="bi bi-info-circle-fill text-primary me-2"></i>Application Status
                            </h5>
                        </div>
                        <div class="card-body text-center p-5">
                            <div class="status-display">
                                <div class="status-icon bg-{{ $instructorRequest->status_color }} bg-opacity-15 text-{{ $instructorRequest->status_color }} rounded-circle d-inline-flex align-items-center justify-content-center mb-3 pulse-animation"
                                     style="width: 80px; height: 80px;">
                                    @if($instructorRequest->status === 'approved')
                                        <i class="bi bi-check-circle-fill fs-1"></i>
                                    @elseif($instructorRequest->status === 'rejected')
                                        <i class="bi bi-x-circle-fill fs-1"></i>
                                    @else
                                        <i class="bi bi-clock-fill fs-1"></i>
                                    @endif
                                </div>
                                <h4 class="fw-bold text-{{ $instructorRequest->status_color }} mb-2">
                                    {{ ucfirst($instructorRequest->status) }}
                                </h4>
                                <p class="text-muted mb-0">
                                    This application has been processed and the decision has been communicated to the applicant.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Custom Styles and Animations -->
    <style>
        /* Animation Keyframes */
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

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        @keyframes ping {
            0% { transform: scale(1); opacity: 1; }
            75%, 100% { transform: scale(1.5); opacity: 0; }
        }

        /* Animation Classes */
        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .slide-in-left {
            animation: slideInLeft 0.6s ease-out forwards;
        }

        .slide-in-right {
            animation: slideInRight 0.6s ease-out forwards;
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        .animate-ping-slow {
            animation: ping 3s infinite;
        }

        /* Hover Effects */
        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .hover-underline {
            position: relative;
            transition: color 0.3s ease;
        }

        .hover-underline:hover {
            color:  #0d6efd !important;
        }

        .hover-underline::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background:  #0d6efd;
            transition: width 0.3s ease;
        }

        .hover-underline:hover::after {
            width: 100%;
        }

        /* Custom Styles */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .bg-gradient-warning {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
        }

        .details-grid {
            display: grid;
            gap: 1.5rem;
        }

        .detail-item {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 1rem;
            padding: 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .detail-item:hover {
            background: rgba(0,0,0,0.02);
            transform: translateX(5px);
        }

        .detail-label {
            display: flex;
            align-items: flex-start;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .detail-value {
            color: #495057;
            font-weight: 500;
        }

        .status-badge {
            animation: fadeInUp 0.5s ease-out;
        }

        .status-select {
            transition: all 0.3s ease;
        }

        .status-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            transform: scale(1.02);
        }

        .submit-btn {
            transition: all 0.3s ease;
            position: relative;
        }

        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .submit-btn:not(:disabled):hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .breadcrumb {
            background: none;
            padding: 0;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
            color: #6c757d;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            animation: fadeInUp 0.3s ease-out;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .detail-item {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }

            .header-content, .header-actions {
                text-align: center;
            }
        }
    </style>

    <!-- JavaScript for Interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('status');
            const submitBtn = document.querySelector('.submit-btn');
            const btnText = document.querySelector('.btn-text');
            const btnSpinner = document.querySelector('.btn-spinner');
            const form = document.getElementById('statusForm');

            // Enable/disable submit button based on selection
            if (statusSelect && submitBtn) {
                statusSelect.addEventListener('change', function() {
                    if (this.value) {
                        submitBtn.disabled = false;
                        submitBtn.classList.add('animate-bounce');
                        setTimeout(() => {
                            submitBtn.classList.remove('animate-bounce');
                        }, 600);
                    } else {
                        submitBtn.disabled = true;
                    }
                });
            }

            // Form submission animation
            if (form) {
                form.addEventListener('submit', function(e) {
                    if (submitBtn && btnText && btnSpinner) {
                        submitBtn.disabled = true;
                        btnText.textContent = 'Processing...';
                        btnSpinner.classList.remove('d-none');
                        submitBtn.classList.add('processing');
                    }
                });
            }

            // Add smooth scrolling to any anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Add bounce animation class
            const style = document.createElement('style');
            style.textContent = `
                @keyframes bounce {
                    0%, 20%, 53%, 80%, 100% { transform: translate3d(0,0,0); }
                    40%, 43% { transform: translate3d(0,-5px,0); }
                    70% { transform: translate3d(0,-3px,0); }
                    90% { transform: translate3d(0,-1px,0); }
                }
                .animate-bounce {
                    animation: bounce 0.6s ease-out;
                }
                .processing {
                    background: linear-gradient(45deg, #667eea, #764ba2, #667eea, #764ba2);
                    background-size: 300% 300%;
                    animation: gradientShift 1.5s ease-in-out infinite;
                }
                @keyframes gradientShift {
                    0%, 100% { background-position: 0% 50%; }
                    50% { background-position: 100% 50%; }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
@endsection
