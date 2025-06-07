@extends('users.admin.layout.layout')

@section('title', 'Categories')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
            <h5 class="mb-0">Category Management</h5>
            <a href="{{ route('admin.category.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Add Category
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Category</th>
                        <th>Slug</th>
                        <th>Parent</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td class="ps-4">{{ $category->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}"
                                             class="rounded me-2" width="36" height="36"
                                             alt="{{ $category->name }}">
                                    @endif
                                    <span class="fw-medium">{{ $category->name }}</span>
                                </div>
                            </td>
                            <td><span class="text-muted">{{ $category->slug }}</span></td>
                            <td>
                                @if($category->parent)
                                    <span class="text-primary">{{ $category->parent->name }}</span>
                                @else
                                    <span class="text-muted">None</span>
                                @endif
                            </td>
                            <td>
                                @if($category->is_active)
                                    <span class="badge bg-success bg-opacity-10 text-success">Active</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $category->created_at->format('d M Y') }}</td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('admin.category.show', $category->id) }}"
                                       class="btn btn-sm btn-outline-light border text-primary rounded-circle me-1"
                                       data-bs-toggle="tooltip" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.category.edit', $category->id) }}"
                                       class="btn btn-sm btn-outline-light border text-secondary rounded-circle me-1"
                                       data-bs-toggle="tooltip" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-light border text-danger rounded-circle"
                                                data-bs-toggle="tooltip" title="Delete"
                                                onclick="return confirm('Are you sure you want to delete {{ $category->name }}?')">
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

            @if($categories->hasPages())
                <div class="card-footer bg-white border-top py-3">
                    <nav aria-label="Pagination">
                        <ul class="pagination justify-content-center mb-0">
                            <li class="page-item {{ $categories->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $categories->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            @foreach(range(1, $categories->lastPage()) as $i)
                                <li class="page-item {{ $categories->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $categories->url($i) }}">{{ $i }}</a>
                                </li>
                            @endforeach
                            <li class="page-item {{ !$categories->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $categories->nextPageUrl() }}" aria-label="Next">
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
    </style>
@endpush
