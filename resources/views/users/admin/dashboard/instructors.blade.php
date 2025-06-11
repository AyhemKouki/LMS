@extends('users.admin.layout.layout')

@section('title', 'Instructors')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
            <h5 class="mb-0">Users Management</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Porfile image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($instructors as $instructor)
                        <tr>
                            <td class="ps-4">{{ $instructor->id }}</td>
                            <td>
                                @if($instructor->profile_image)
                                    <img src="{{ asset('storage/' . $instructor->profile_image) }}"
                                         class="rounded me-2" width="100" height="50"
                                         alt="image">
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <span class="fw-medium d-block">{{ $instructor->name }}</span>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <span class="fw-medium d-block">{{ $instructor->email }}</span>
                                    </div>
                                </div>

                            </td>


                            <td>{{ $instructor->created_at->format('d M Y') }}</td>

                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end">
                                    <a href="#"
                                       class="btn btn-sm btn-outline-light border text-primary rounded-circle me-1"
                                       data-bs-toggle="tooltip" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#"
                                       class="btn btn-sm btn-outline-light border text-secondary rounded-circle me-1"
                                       data-bs-toggle="tooltip" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{route('admin.instructor.destroy' , $instructor->id)}}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-light border text-danger rounded-circle"
                                                data-bs-toggle="tooltip" title="Delete"
                                                onclick="return confirm('Are you sure you want to delete {{ $instructor->name }}?')">
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

            @if($instructors->hasPages())
                <div class="card-footer bg-white border-top py-3">
                    <nav aria-label="Pagination">
                        <ul class="pagination justify-content-center mb-0">
                            <li class="page-item {{ $instructors->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $instructors->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            @foreach(range(1, $instructors->lastPage()) as $i)
                                <li class="page-item {{ $instructors->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $instructors->url($i) }}">{{ $i }}</a>
                                </li>
                            @endforeach
                            <li class="page-item {{ !$instructors->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $instructors->nextPageUrl() }}" aria-label="Next">
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
