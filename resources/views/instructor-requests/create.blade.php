
@extends('users.user.layout.layout')

@section('content2')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Request to Become an Instructor</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <h6><i class="bi bi-info-circle"></i> Information</h6>
                            <p class="mb-0">Submit your CV to apply for an instructor position. Our team will review
                                your application and respond as soon as possible.</p>
                        </div>

                        <form action="{{ route('instructor.request.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="cv" class="form-label">CV (Required) <span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('cv') is-invalid @enderror"
                                       id="cv" name="cv" accept=".pdf,.doc,.docx" required>
                                <div class="form-text">Accepted formats: PDF, DOC, DOCX (Max size: 2MB)</div>
                                @error('cv')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send"></i> Submit Request
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
