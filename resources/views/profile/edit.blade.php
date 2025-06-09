@extends('users.user.layout.layout')
@section('profile')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Profile Information Card -->
                <div class="card mb-4 shadow-sm border-0 rounded-4 overflow-hidden">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h2 class="h5 mb-0 fw-semibold">
                            <i class="bi bi-person-gear me-2"></i>Profile Information
                        </h2>
                        <p class="text-muted mb-0 small">Update your account's profile information</p>
                    </div>
                    <div class="card-body p-4">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Password Update Card -->
                <div class="card mb-4 shadow-sm border-0 rounded-4 overflow-hidden">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h2 class="h5 mb-0 fw-semibold">
                            <i class="bi bi-shield-lock me-2"></i>Update Password
                        </h2>
                        <p class="text-muted mb-0 small">Change your account password</p>
                    </div>
                    <div class="card-body p-4">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete Account Card -->
                <div class="card mb-4 shadow-sm border-0 rounded-4 overflow-hidden border-danger border-2">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h2 class="h5 mb-0 fw-semibold text-danger">
                            <i class="bi bi-exclamation-triangle me-2"></i>Delete Account
                        </h2>
                        <p class="text-muted mb-0 small">Permanently delete your account</p>
                    </div>
                    <div class="card-body p-4">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1.25rem rgba(0, 0, 0, 0.1) !important;
        }
        .rounded-4 {
            border-radius: 1rem !important;
        }
        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
    </style>
@endsection
