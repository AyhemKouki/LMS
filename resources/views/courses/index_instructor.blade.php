@extends('users.user.layout.layout')

@section('title', 'Courses')

@section('course_content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
            <h5 class="mb-0">Course Management</h5>
            <a href="{{route("courses.create")}}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Add Course
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Course</th>
                        <th>Instructor</th>
                        <th>Category</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>Created</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td class="ps-4">{{ $course->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($course->thumbnail)
                                        <img src="{{ asset('storage/' . $course->thumbnail) }}"
                                             class="rounded me-2" width="100" height="50"
                                             alt="{{ $course->title }}">
                                    @endif
                                    <div>
                                        <span class="fw-medium d-block">{{ $course->title }}</span>
                                        <small class="text-muted">{{ $course->duration_hours }} hours</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-primary">
                                    @if($course->admin_id)
                                        {{ $course->admin->name ?? 'N/A' }} <span class="badge bg-dark bg-opacity-10 text-dark">Admin</span>
                                    @elseif($course->user_id)
                                        {{ $course->user->name ?? 'N/A' }} <span class="badge bg-primary bg-opacity-10 text-primary">Instructor</span>
                                    @else
                                        N/A
                                    @endif
                                </span>
                            </td>
                            <td>
                                @if($course->category)
                                    <span class="badge bg-info bg-opacity-10 text-info">{{ $course->category->name }}</span>
                                @else
                                    <span class="text-muted">None</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge
                                    @if($course->level == 'beginner') bg-primary bg-opacity-10 text-primary
                                    @elseif($course->level == 'intermediate') bg-warning bg-opacity-10 text-warning
                                    @else bg-danger bg-opacity-10 text-danger @endif">
                                    {{ ucfirst($course->level) }}
                                </span>
                            </td>
                            <td>
                                @if($course->status == 'published')
                                    <span class="badge bg-success bg-opacity-10 text-success">Published</span>
                                @elseif($course->status == 'draft')
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary">Draft</span>
                                @else
                                    <span class="badge bg-dark bg-opacity-10 text-dark">Archived</span>
                                @endif

                                @if($course->is_approved === 'approved')
                                    <span class="badge bg-success bg-opacity-10 text-success mt-1 d-block">Approved</span>
                                @elseif($course->is_approved === 'pending')
                                    <span class="badge bg-warning bg-opacity-10 text-warning mt-1 d-block">Pending</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger mt-1 d-block">Rejected</span>
                                @endif
                            </td>
                            <td>
                                @if($course->sale_price)
                                    <span class="text-decoration-line-through text-muted">${{ number_format($course->price, 2) }}</span>
                                    <span class="fw-bold text-danger">${{ number_format($course->sale_price, 2) }}</span>
                                @else
                                    <span class="fw-bold">${{ number_format($course->price, 2) }}</span>
                                @endif
                            </td>
                            <td>{{ $course->created_at->format('d M Y') }}</td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end">

                                    <a href="{{route('courses.edit2' , $course->id)}}"
                                       class="btn btn-sm btn-outline-light border text-secondary rounded-circle me-1"
                                       data-bs-toggle="tooltip" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-light border text-danger rounded-circle"
                                                data-bs-toggle="tooltip" title="Delete"
                                                onclick="return confirm('Are you sure you want to delete {{ $course->title }}?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            @if($courses->hasPages())
                <div class="card-footer bg-white border-top py-3">
                    <nav aria-label="Pagination">
                        <ul class="pagination justify-content-center mb-0">
                            <li class="page-item {{ $courses->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $courses->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            @foreach(range(1, $courses->lastPage()) as $i)
                                <li class="page-item {{ $courses->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $courses->url($i) }}">{{ $i }}</a>
                                </li>
                            @endforeach
                            <li class="page-item {{ !$courses->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $courses->nextPageUrl() }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
@endpush

@push('styles')
    <style>
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
        .btn-outline-light.border {
            border-color: #dee2e6 !important;
        }
        .btn-outline-light:hover {
            background-color: #f8f9fa;
        }
        form.d-inline {
            display: inline-block !important;
        }
        .badge {
            font-weight: 500;
        }
    </style>
@endpush
