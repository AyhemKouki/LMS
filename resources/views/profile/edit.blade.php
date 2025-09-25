@extends('users.user.layout.layout')
@section('profile')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Profile Header -->
                <div class="text-center mb-5">
                    <div class="header-decoration mx-auto mb-3"></div>
                    <h1 class="display-5 fw-bold text-dark mb-2">Account Settings</h1>
                    <p class="text-muted fs-6 mb-0">Manage your personal information and preferences</p>
                </div>

                <!-- Profile Information Card -->
                <div class="card mb-4 shadow-lg border-0 rounded-5 overflow-hidden profile-card glass-effect">
                    <div class="card-header bg-gradient-primary py-4 border-0 position-relative">
                        <div class="header-pattern"></div>
                        <div class="position-relative z-2">
                            <h2 class="h5 mb-1 fw-bold text-white">
                                <i class="bi bi-person-gear me-2"></i>Personal Information
                            </h2>
                            <p class="text-white-50 mb-0 small">Update your account details and contact information</p>
                        </div>
                    </div>

                    <!-- Profile Image & Basic Info Card -->
                        <div class="card-body p-5">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-12 text-center mb-4 mb-md-0">
                                <div class="profile-image-container position-relative mx-auto">
                                        <div class="profile-ring"></div>
                                    @if(auth()->user()->profile_image !== "/images/avatar.jpg")
                                        <img src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&size=150&background=667eea&color=ffffff&bold=true' }}"
                                             alt="Profile Picture"
                                             class="profile-image shadow-lg"
                                             id="profileImagePreview">
                                    @else
                                        <img src="{{ "/images/avatar.jpg" }}"
                                             alt="Profile Picture"
                                             class="profile-image shadow-lg"
                                             id="profileImagePreview">
                                    @endif
                                        <div class="profile-badge">
                                            <i class="bi bi-camera-fill"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="card-body p-5">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Password Update Card -->
                <div class="card mb-4 shadow-lg border-0 rounded-5 overflow-hidden profile-card glass-effect">
                    <div class="card-header bg-gradient-success py-4 border-0 position-relative">
                        <div class="header-pattern"></div>
                        <div class="position-relative z-2">
                            <h2 class="h5 mb-1 fw-bold text-white">
                                <i class="bi bi-shield-lock me-2"></i>Security Settings
                            </h2>
                            <p class="text-white-50 mb-0 small">Keep your account secure with a strong password</p>
                        </div>
                    </div>
                    <div class="card-body p-5">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete Account Card -->
                <div class="card mb-4 shadow-lg border-0 rounded-5 overflow-hidden profile-card glass-effect danger-card">
                    <div class="card-header bg-gradient-danger py-4 border-0 position-relative">
                        <div class="header-pattern"></div>
                        <div class="position-relative z-2">
                            <h2 class="h5 mb-1 fw-bold text-white">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>Danger Zone
                            </h2>
                            <p class="text-white-50 mb-0 small">Permanently delete your account and all associated data</p>
                        </div>
                    </div>
                    <div class="card-body p-5 bg-danger-subtle bg-opacity-10">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            background: #ffffff;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            line-height: 1.6;
        }

        .header-decoration {
            width: 60px;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50px;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .profile-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: all 0.6s;
            z-index: 1;
        }

        .profile-card:hover::before {
            left: 100%;
        }

        .profile-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .rounded-5 {
            border-radius: 1.5rem !important;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .bg-gradient-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }

        .bg-gradient-warning {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        }

        .bg-gradient-danger {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
        }

        .header-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        }

        .profile-image-container {
            width: 150px;
            height: 150px;
            position: relative;
        }

        .profile-ring {
            position: absolute;
            top: -8px;
            left: -8px;
            right: -8px;
            bottom: -8px;
            border: 3px solid transparent;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-clip: border-box;
            animation: rotate 8s linear infinite;
        }

        .profile-ring::before {
            content: '';
            position: absolute;
            top: 3px;
            left: 3px;
            right: 3px;
            bottom: 3px;
            background: white;
            border-radius: 50%;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            position: relative;
            z-index: 2;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 4px solid white;
        }

        .profile-badge {
            position: absolute;
            bottom: 8px;
            right: 8px;
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
            border: 3px solid white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            z-index: 3;
            animation: pulse 2s infinite;
        }

        .upload-area {
            border: 2px dashed #e0e6ed;
            border-radius: 1rem;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            position: relative;
            overflow: hidden;
        }

        .upload-area::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
            transition: all 0.6s;
        }

        .upload-area:hover::before {
            left: 100%;
        }

        .upload-area:hover {
            border-color: #667eea;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .upload-icon {
            font-size: 2rem;
            color: #667eea;
            transition: all 0.3s ease;
        }

        .upload-area:hover .upload-icon {
            color: white;
            transform: scale(1.1);
        }

        .upload-title {
            color: #495057;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .upload-area:hover .upload-title {
            color: white;
        }

        .upload-subtitle {
            color: #6c757d;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .upload-area:hover .upload-subtitle {
            color: rgba(255, 255, 255, 0.8);
        }

        .btn-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            border-radius: 1rem;
            padding: 1rem 2rem;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-gradient-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: all 0.6s;
        }

        .btn-gradient-primary:hover::before {
            left: 100%;
        }

        .btn-gradient-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 1rem;
            padding: 1rem 1.25rem;
            font-size: 0.95rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.15);
            transform: translateY(-2px);
            background: white;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.75rem;
        }

        .danger-card {
            position: relative;
        }

        .danger-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 2px solid rgba(255, 107, 107, 0.1);
            border-radius: 1.5rem;
            pointer-events: none;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .profile-image-container,
            .profile-ring,
            .profile-image {
                width: 120px;
                height: 120px;
            }

            .profile-ring {
                top: -6px;
                left: -6px;
                right: -6px;
                bottom: -6px;
            }

            .card-body {
                padding: 2rem !important;
            }

            .upload-area {
                padding: 1.5rem;
            }

            .profile-card:hover {
                transform: translateY(-4px) scale(1.01);
            }
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4c93 100%);
        }

    </style>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const preview = document.getElementById('profileImagePreview');
                    preview.src = e.target.result;

                    // Add a subtle animation when image changes
                    preview.style.transform = 'scale(0.8)';
                    preview.style.opacity = '0.5';

                    setTimeout(() => {
                        preview.style.transform = 'scale(1)';
                        preview.style.opacity = '1';
                    }, 200);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Add loading state to upload area when file is selected
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('profile_image');
            const uploadArea = document.querySelector('.upload-area');

            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    uploadArea.style.borderColor = '#28a745';
                    uploadArea.querySelector('.upload-title').textContent = 'Image selected: ' + this.files[0].name;
                    uploadArea.querySelector('.upload-subtitle').textContent = 'Click update button to save changes';
                }
            });
        });
    </script>
@endsection
