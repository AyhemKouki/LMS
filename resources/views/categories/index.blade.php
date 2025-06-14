@extends('users.admin.layout.layout')

@section('title', 'Categories')

@section('content')
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        .main-container {
            padding: 2rem;
            min-height: 100vh;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .card-header {
            background: rgba(255, 255, 255, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px 20px 0 0 !important;
            padding: 1.5rem;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: white;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-modern {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
            color: white;
        }

        .table-modern {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 0 0 20px 20px;
            overflow: hidden;
        }

        .table thead th {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: none;
            color: #495057;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            padding: 1rem;
        }

        .table tbody tr {
            border: none;
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            transform: scale(1.01);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .table tbody td {
            border: none;
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .category-image {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
        }

        .category-image:hover {
            transform: scale(1.1);
        }

        .badge-modern {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-success {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(79, 172, 254, 0.4);
        }

        .badge-danger {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(250, 112, 154, 0.4);
        }

        .action-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: 2px solid rgba(0, 0, 0, 0.1);
            background: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            margin: 0 0.25rem;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .action-btn.view {
            color: #6f42c1;
            border-color: #6f42c1;
        }

        .action-btn.view:hover {
            background: #6f42c1;
            color: white;
        }

        .action-btn.edit {
            color: #fd7e14;
            border-color: #fd7e14;
        }

        .action-btn.edit:hover {
            background: #fd7e14;
            color: white;
        }

        .action-btn.delete {
            color: #dc3545;
            border-color: #dc3545;
        }

        .action-btn.delete:hover {
            background: #dc3545;
            color: white;
        }

        .pagination-modern {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 0 0 20px 20px;
            padding: 1.5rem;
        }

        .pagination .page-link {
            border: none;
            border-radius: 10px;
            margin: 0 0.25rem;
            background: rgba(255, 255, 255, 0.8);
            color: #495057;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .pagination .page-link:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .category-name {
            font-weight: 600;
            color: #2d3436;
        }

        .category-slug {
            color: #636e72;
            font-family: 'Monaco', 'Menlo', monospace;
            font-size: 0.85rem;
            background: rgba(108, 117, 125, 0.1);
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
        }

        .parent-category {
            color: #6f42c1;
            font-weight: 500;
        }

        .no-parent {
            color: #6c757d;
            font-style: italic;
        }

        .created-date {
            color: #495057;
            font-weight: 500;
        }

        .floating-add-btn {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            font-size: 1.5rem;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
            transition: all 0.3s ease;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .floating-add-btn:hover {
            transform: scale(1.1) rotate(90deg);
            box-shadow: 0 12px 35px rgba(102, 126, 234, 0.8);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeInUp 0.6s ease forwards;
        }

        .stats-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .stats-label {
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.85rem;
        }
    </style>
    <div class="main-container">
        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="stats-card animate-fade-in">
                    <div class="stats-number">{{$totalCategories}}</div>
                    <div class="stats-label">Total Categories</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card animate-fade-in" style="animation-delay: 0.1s;">
                    <div class="stats-number">{{$activeCategories}}</div>
                    <div class="stats-label">Active</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card animate-fade-in" style="animation-delay: 0.2s;">
                    <div class="stats-number">{{$inactiveCategories}}</div>
                    <div class="stats-label">Inactive</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card animate-fade-in" style="animation-delay: 0.3s;">
                    <div class="stats-number">{{$parentCategories}}</div>
                    <div class="stats-label">Parent Categories</div>
                </div>
            </div>
        </div>

        <!-- Main Card -->
        <div class="glass-card animate-fade-in" style="animation-delay: 0.4s;">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="page-title">
                        <i class="bi bi-grid-3x3-gap me-3"></i>
                        Category Management
                    </h1>
                    <a href="{{ route('admin.category.create') }}" class="btn btn-modern">
                        <i class="bi bi-plus-circle me-2"></i>
                        Add Category
                    </a>
                </div>
            </div>

            <div class="table-modern">
                <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Slug</th>
                        <th>Parent</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td><strong>{{ $category->id }}</strong></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" class="category-image me-3" alt="{{ $category->name }}">
                                    @endif

                                    <span class="category-name">{{ $category->name }}</span>
                                </div>
                            </td>
                            <td><span class="category-slug">{{ $category->slug }}</span></td>
                            <td>
                                @if($category->parent)
                                    <span class="parent-category">{{ $category->parent->name }}</span>
                                @else
                                    <span class="no-parent">None</span>
                                @endif
                            </td>

                            <td>
                                @if($category->is_active)
                                    <span class="badge badge-modern badge-success">Active</span>
                                @else
                                    <span class="badge badge-modern badge-danger">Inactive</span>
                                @endif

                            </td>
                            <td><span class="created-date">{{ $category->created_at->format('d M Y') }}</span></td>

                            <td class="text-center">
                                <a href="{{route('admin.category.show', $category->id)}}" class="action-btn view" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{route('admin.category.edit', $category->id)}}" class="action-btn edit" title="Edit">
                                    <i class="fas fa-pencil"></i>
                                </a>
                                <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST"
                                      class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="action-btn delete" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>


                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            <!-- Pagination -->
            <div class="pagination-modern">
                {{ $categories->links('pagination::bootstrap-5') }}
            </div>


        </div>
    </div>



    <!-- Floating Add Button -->
    <a href="{{route('admin.category.create')}}" class="floating-add-btn" title="Add New Category">
        <i class="bi bi-plus"></i>
    </a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Add click handlers for category deletion
        document.querySelectorAll('.action-btn.delete').forEach(btn => {
            btn.addEventListener('click', function () {
                if (confirm('Are you sure you want to delete this category?')) {
                    this.closest('form.delete-form').submit();
                }
            });
        });

        // Floating button click
        document.querySelector('.floating-add-btn').addEventListener('click', function() {
            // Add category logic here
            console.log('Add new category');
        });

        // Add hover effects
        document.querySelectorAll('.table tbody tr').forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(5px)';
            });

            row.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
        });
    </script>

@endsection
