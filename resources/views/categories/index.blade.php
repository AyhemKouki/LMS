@extends('users.admin.layout.layout')

@section('title' , 'Categories')

@section('Categories')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">All Categories</h5>
        <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Add New
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Parent</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="rounded-circle me-2" width="32" height="32">
                                @else
                                    <div class="bg-light rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                        <i class="bi bi-collection text-muted"></i>
                                    </div>
                                @endif
                                <strong>{{ $category->name }}</strong>
                            </div>
                        </td>
                        <td><code>{{ $category->slug }}</code></td>
                        <td>
                            @if($category->parent)
                                <span class="badge bg-light text-dark">{{ $category->parent->name }}</span>
                            @else
                                <span class="text-muted">None</span>
                            @endif
                        </td>
                        <td>
                            <div class="mb-3">
                                <input type="hidden" name="is_active" value="{{ $category->is_active ? 1 : 0 }}">

                                <div class="status-badge-container" >
                                    @if($category->is_active)
                                        <span class="badge bg-success status-badge" data-status="1">Active</span>
                                    @else
                                        <span class="badge bg-danger status-badge" data-status="0">Inactive</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>{{ $category->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('admin.category.show', $category->id) }}" class="btn btn-light" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-light" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-light text-danger" title="Delete" onclick="return confirm('Are you sure?')">
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

        <!-- Pagination -->
        @if($categories->hasPages())
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    @if($categories->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $categories->previousPageUrl() }}">Previous</a>
                        </li>
                    @endif

                    @foreach(range(1, $categories->lastPage()) as $i)
                        <li class="page-item {{ $categories->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $categories->url($i) }}">{{ $i }}</a>
                        </li>
                    @endforeach

                    @if($categories->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $categories->nextPageUrl() }}">Next</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Next</a>
                        </li>
                    @endif
                </ul>
            </nav>
        @endif
    </div>
</div>

@push('scripts')
    <script>
        document.querySelectorAll('.status-toggle').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const categoryId = this.dataset.id;
                const isActive = this.checked ? 1 : 0;

                fetch(`/categories/${categoryId}/status`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ is_active: isActive })
                })
                    .then(response => {
                        if (!response.ok) {
                            this.checked = !this.checked;
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    </script>
@endpush
@endsection
