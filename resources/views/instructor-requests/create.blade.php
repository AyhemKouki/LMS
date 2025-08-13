@extends('users.user.layout.layout')

@section('content2')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow rounded-4 border-0">
                    <div class="card-header bg-white border-bottom-0 rounded-top-4 pb-0">
                        <h3 class="fw-bold text-primary">
                            <i class="bi bi-person-plus me-2"></i>Instructor Application
                        </h3>
                        <p class="text-muted small mt-2">Submit your CV and our team will get back to you shortly.</p>
                    </div>
                    <div class="card-body px-4 py-4">
                        <div class="alert alert-info d-flex align-items-start gap-2 rounded-3 shadow-sm small">
                            <i class="bi bi-info-circle-fill fs-5 mt-1"></i>
                            <div>
                                <strong>Note:</strong> Only PDF, DOC, or DOCX formats are accepted (Max size: 2MB).
                            </div>
                        </div>

                        <form action="{{ route('instructor.request.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                            @csrf

                            <div class="mb-4">
                                <label for="cv" class="form-label fw-semibold">Upload your CV <span class="text-danger">*</span></label>
                                <input
                                    type="file"
                                    class="form-control shadow-sm @error('cv') is-invalid @enderror"
                                    id="cv"
                                    name="cv"
                                    accept=".pdf,.doc,.docx"
                                    required>
                                @error('cv')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-primary py-2 shadow-sm fw-semibold">
                                    <i class="bi bi-send-fill me-2"></i>Submit Application
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-label {
            font-size: 0.95rem;
        }

        .form-control {
            border-radius: 0.5rem;
        }

        .alert-info {
            background-color: #eef8fd;
            color: #055160;
            border-color: #b6effb;
        }

        .card-header h3 {
            margin-bottom: 0;
        }
    </style>
@endsection
