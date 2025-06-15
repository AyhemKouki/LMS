@extends('users.admin.layout.layout')
@use('Illuminate\Support\Facades\Storage')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-person-check"></i> Instructor Request Details</h2>
            <a href="{{ route('admin.instructor-requests.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="bi bi-file-person"></i> Request details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-3"><strong>Utilisateur:</strong></div>
                            <div class="col-sm-9">{{ $instructorRequest->user->name }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3"><strong>Email:</strong></div>
                            <div class="col-sm-9">
                                <a href="mailto:{{ $instructorRequest->user->email }}">
                                    {{ $instructorRequest->user->email }}
                                </a>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3"><strong>Date de demande:</strong></div>
                            <div class="col-sm-9">{{ $instructorRequest->created_at->format('d/m/Y H:i') }}</div>
                        </div>

                        @if($instructorRequest->cv_file && Storage::disk('public')->exists($instructorRequest->cv_file))
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>CV:</strong></div>
                                <div class="col-sm-9">
                                    <a href="{{ asset('storage/' . $instructorRequest->cv_file) }}"
                                       target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-download"></i> Download CV
                                    </a>
                                </div>
                            </div>
                        @endif

                        <div class="row mb-3">
                            <div class="col-sm-3"><strong>Statut:</strong></div>
                            <div class="col-sm-9">
                            <span class="badge bg-{{ $instructorRequest->status_color }} fs-6">
                                {{ ucfirst($instructorRequest->status) }}
                            </span>
                            </div>
                        </div>

                        @if($instructorRequest->admin_notes)
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>Admin Notes:</strong></div>
                                <div class="col-sm-9">
                                    <div class="alert alert-light">
                                        {{ $instructorRequest->admin_notes }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($instructorRequest->reviewed_at)
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>Reviewed on:</strong></div>
                                <div class="col-sm-9">{{ $instructorRequest->reviewed_at->format('d/m/Y H:i') }}</div>
                            </div>
                        @endif

                        @if($instructorRequest->reviewer)
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>Reviewed by:</strong></div>
                                <div class="col-sm-9">{{ $instructorRequest->reviewer->name }} <span class="badge bg-primary">Admin</span></div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                @if($instructorRequest->status === 'pending')
                    <div class="card">
                        <div class="card-header bg-warning text-dark">
                            <h5><i class="bi bi-gear"></i> Process Request</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.instructor-requests.update-status', $instructorRequest) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <div class="mb-3">
                                    <label for="status" class="form-label">Decision <span
                                            class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-select" required>
                                        <option value="">Select...</option>
                                        <option value="approved" class="text-success">✓ Approve</option>
                                        <option value="rejected" class="text-danger">✗ Reject</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="admin_notes" class="form-label">Notes (optional)</label>
                                    <textarea name="admin_notes" id="admin_notes" class="form-control" rows="3"
                                              placeholder="Add comments for the user..."></textarea>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle"></i> Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5><i class="bi bi-info-circle"></i> Statut</h5>
                        </div>
                        <div class="card-body text-center">
                        <span class="badge bg-{{ $instructorRequest->status_color }} fs-5 p-3">
                            {{ ucfirst($instructorRequest->status) }}
                        </span>
                            <p class="mt-2 mb-0 text-muted">
                                This request has already been processed
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
