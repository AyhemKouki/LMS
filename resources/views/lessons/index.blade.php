@extends('users.user.layout.layout')

@section('title', 'Lessons')

@section('content2')
    <div class="container-fluid py-4">
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            {{-- Card Header --}}
            <div class="card-header bg-white border-bottom px-4 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0 fw-semibold">Lesson Management</h5>
                        <p class="text-muted mb-0 small">Manage all your course lessons in one place</p>
                    </div>
                    <div>
                        @can('create lesson')
                            <a href="{{ route('lesson.create') }}" class="btn btn-primary rounded-pill px-4">
                                <i class="bi bi-plus-lg me-2"></i> Create Lesson
                            </a>
                        @endcan
                    </div>
                </div>
            </div>

            {{-- Filters --}}
            <div class="px-4 pt-3 bg-light">
                <div class="row g-3">
                    <div class="col-md-3">
                        <select class="form-select form-select-sm rounded-pill">
                            <option>All Courses</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select form-select-sm rounded-pill">
                            <option>All Statuses</option>
                            <option>Published</option>
                            <option>Draft</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control rounded-pill" placeholder="Search lessons...">
                            <button class="btn btn-outline-secondary rounded-pill" type="button">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card Body --}}
            <div class="card-body p-0">
                @if($lessons->isEmpty())
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="bi bi-journal-text text-muted" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="fw-medium">No lessons found</h5>
                        <p class="text-muted">Create your first lesson to get started</p>
                        @can('create lesson')
                            <a href="{{ route('lesson.create') }}" class="btn btn-primary rounded-pill px-4 mt-2">
                                <i class="bi bi-plus-lg me-2"></i> Create Lesson
                            </a>
                        @endcan
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                            <tr>
                                <th class="ps-4 py-3">ORDER</th>
                                <th class="py-3">LESSON</th>
                                <th class="py-3">CONTENT</th>
                                <th class="py-3">COURSE</th>
                                <th class="text-end pe-4 py-3">ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lessons as $lesson)
                                <tr class="border-bottom">
                                    <td class="ps-4">
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-1">
                                            #{{ $lesson->lesson_order }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <i class="bi bi-play-circle text-primary"></i>
                                            </div>
                                            <div>
                                                <span class="fw-medium d-block">{{ $lesson->title }}</span>
                                                <small class="text-muted">Duration: 15 min</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-muted">{{ Str::limit($lesson->content, 80) }}</p>
                                    </td>
                                    <td>
                                        <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-1">
                                            {{ $lesson->course->title }}
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="d-flex justify-content-end gap-2">
                                            @can('view lesson')
                                                <a href="{{ route('lesson.show', $lesson->id) }}"
                                                   class="btn btn-sm btn-light rounded-circle p-2"
                                                   data-bs-toggle="tooltip" title="Preview">
                                                    <i class="bi bi-eye text-primary"></i>
                                                </a>
                                            @endcan

                                            @can('edit lesson')
                                                <a href="{{ route('lesson.edit', $lesson->id) }}"
                                                   class="btn btn-sm btn-light rounded-circle p-2"
                                                   data-bs-toggle="tooltip" title="Edit">
                                                    <i class="bi bi-pencil text-secondary"></i>
                                                </a>
                                            @endcan

                                            @can('destroy lesson')
                                                <form action="{{ route('lesson.destroy', $lesson->id) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-sm btn-light rounded-circle p-2"
                                                            data-bs-toggle="tooltip"
                                                            title="Delete"
                                                            onclick="return confirm('Are you sure you want to delete this lesson?')">
                                                        <i class="bi bi-trash text-danger"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl, {
                    trigger: 'hover focus'
                });
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        .card {
            border: none;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.03);
        }

        .table {
            --bs-table-striped-bg: rgba(248, 249, 250, 0.5);
        }

        .table th {
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            color: #6c757d;
            border-bottom-width: 1px;
        }

        .table td {
            vertical-align: middle;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.03) !important;
        }

        .badge {
            font-weight: 400;
            letter-spacing: 0.3px;
        }

        .btn-light {
            background-color: rgba(248, 249, 250, 0.7);
            border-color: rgba(222, 226, 230, 0.5);
            transition: all 0.2s;
        }

        .btn-light:hover {
            background-color: rgba(248, 249, 250, 1);
            border-color: rgba(222, 226, 230, 0.8);
            transform: translateY(-1px);
        }

        .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .page-link {
            color: #495057;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endpush
