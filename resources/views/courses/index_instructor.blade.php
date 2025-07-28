@extends('users.user.layout.layout')

@section('title', 'Courses')

@section('course_content')
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="card-header d-flex justify-content-between align-items-center bg-white py-3 border-bottom">
            <div>
                <h5 class="mb-0 fw-semibold">Course Management</h5>
                <p class="text-muted mb-0 small">Manage your courses and content</p>
            </div>
            <a href="{{route('courses.create')}}" class="btn btn-primary rounded-pill px-4">
                <i class="bi bi-plus-lg me-2"></i> Create Course
            </a>
        </div>

        <!-- Filters Section -->
        <div class="px-4 pt-3 bg-light">
            <div class="row g-3">
                <div class="col-md-3">
                    <select class="form-select form-select-sm rounded-pill">
                        <option>All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select form-select-sm rounded-pill">
                        <option>All Levels</option>
                        <option value="beginner">Beginner</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="advanced">Advanced</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select form-select-sm rounded-pill">
                        <option>All Statuses</option>
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control rounded-pill" placeholder="Search courses...">
                        <button class="btn btn-outline-secondary rounded-pill" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                    <tr>
                        <th class="ps-4 py-3">COURSE</th>
                        <th class="py-3">CATEGORY</th>
                        <th class="py-3">LEVEL</th>
                        <th class="py-3">STATUS</th>
                        <th class="py-3">PRICE</th>
                        <th class="py-3">CREATED</th>
                        <th class="text-end pe-4 py-3">ACTIONS</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courses as $course)
                        <tr class="border-bottom">
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="position-relative me-3">
                                        @if($course->thumbnail)
                                            <img src="{{ asset('storage/' . $course->thumbnail) }}"
                                                 class="rounded-2" width="80" height="45"
                                                 alt="{{ $course->title }}"
                                                 style="object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded-2 d-flex align-items-center justify-content-center"
                                                 style="width: 80px; height: 45px;">
                                                <i class="bi bi-camera text-muted"></i>
                                            </div>
                                        @endif
                                        <span class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-1"></span>
                                    </div>
                                    <div>
                                        <span class="fw-medium d-block">{{ $course->title }}</span>
                                        <small class="text-muted">{{ $course->lessons_count }} lessons • {{ $course->duration_hours }}h</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($course->category)
                                    <span class="badge bg-light text-dark">{{ $course->category->name }}</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge py-1 px-2 rounded-pill
                                    @if($course->level == 'beginner') bg-primary bg-opacity-10 text-primary
                                    @elseif($course->level == 'intermediate') bg-warning bg-opacity-10 text-warning
                                    @else bg-danger bg-opacity-10 text-danger @endif">
                                    {{ ucfirst($course->level) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex flex-column gap-1">
                                    <span class="badge py-1 px-2 rounded-pill
                                        @if($course->status == 'published') bg-success bg-opacity-10 text-success
                                        @elseif($course->status == 'draft') bg-secondary bg-opacity-10 text-secondary
                                        @else bg-dark bg-opacity-10 text-dark @endif">
                                        {{ ucfirst($course->status) }}
                                    </span>


                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    @if($course->sale_price)
                                        <span class="text-decoration-line-through text-muted small">${{ number_format($course->price, 2) }}</span>
                                        <span class="fw-bold text-danger">${{ number_format($course->sale_price, 2) }}</span>
                                    @else
                                        <span class="fw-bold">${{ number_format($course->price, 2) }}</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="small">{{ $course->created_at->format('d M Y') }}</span>
                                    <span class="text-muted x-small">{{ $course->created_at->diffForHumans() }}</span>
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">

                                    <a href="{{ route('courses.edit2', $course->id) }}"
                                       class="btn btn-sm btn-light rounded-circle p-2"
                                       data-bs-toggle="tooltip" title="Edit">
                                        <i class="bi bi-pencil text-secondary"></i>
                                    </a>

                                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-light rounded-circle p-2"
                                                data-bs-toggle="tooltip"
                                                title="Delete"
                                                onclick="return confirm('Are you sure you want to delete {{ $course->title }}?')">
                                            <i class="bi bi-trash text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                @if($courses->isEmpty())
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="bi bi-book text-muted" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="fw-medium">No courses found</h5>
                        <p class="text-muted">Create your first course to get started</p>
                        <a href="{{ route('courses.create') }}" class="btn btn-primary rounded-pill px-4 mt-2">
                            <i class="bi bi-plus-lg me-2"></i> Create Course
                        </a>
                    </div>
                @endif
            </div>

            @if($courses->hasPages())
                <div class="card-footer bg-white border-top py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            Showing {{ $courses->firstItem() }} to {{ $courses->lastItem() }} of {{ $courses->total() }} entries
                        </div>
                        <nav aria-label="Pagination">
                            <ul class="pagination pagination-sm mb-0">
                                <li class="page-item {{ $courses->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link rounded-pill px-3" href="{{ $courses->previousPageUrl() }}" aria-label="Previous">
                                        <i class="bi bi-chevron-left"></i>
                                    </a>
                                </li>

                                @foreach(range(1, min(5, $courses->lastPage())) as $i)
                                    <li class="page-item {{ $courses->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link rounded-circle mx-1" href="{{ $courses->url($i) }}" style="width: 32px; height: 32px; text-align: center;">
                                            {{ $i }}
                                        </a>
                                    </li>
                                @endforeach

                                @if($courses->lastPage() > 5)
                                    <li class="page-item disabled">
                                        <span class="page-link rounded-circle mx-1" style="width: 32px; height: 32px; text-align: center;">
                                            ...
                                        </span>
                                    </li>
                                @endif

                                <li class="page-item {{ !$courses->hasMorePages() ? 'disabled' : '' }}">
                                    <a class="page-link rounded-pill px-3" href="{{ $courses->nextPageUrl() }}" aria-label="Next">
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            @endif
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
