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
            text-decoration: none;
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
            color: #000000;
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
            color: #000000;
            font-style: italic;
        }

        .created-date {
            color: #000000;
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

    <div class="glass-card animate-fade-in">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="page-title">{{ $category->name }}</h2>

                <a href="{{ route('admin.category.index') }}" class="btn-modern">
                    <i class="fas fa-arrow-left"></i>
                    Back to Categories
                </a>

            </div>

        <div class="p-4">
            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    <img src="{{ asset('storage/'.$category->image) }}"
                         alt="{{ $category->name }}"
                         class="category-image" style="width: 100px; height: 100px;">
                </div>
                <div class="col-md-8">
                    <div class="mb-3">
                        <h5 class="text-white">Category Details</h5>
                        <p class="mb-2"><strong>Slug:</strong> <span class="category-slug">{{ $category->slug }}</span>
                        </p>
                        <p class="mb-2"><strong>Parent Category:</strong>
                            @if($category->parent)
                                <span class="parent-category">{{ $category->parent->name }}</span>
                            @else
                                <span class="no-parent">No parent</span>
                            @endif
                        </p>
                        <p class="mb-2"><strong>Status:</strong>
                            <span
                                class="badge badge-modern {{ $category->is_active ? 'badge-success' : 'badge-danger' }}">
                                    {{ $category->is_active ? 'Active' : 'Inactive' }}
                                </span>
                        </p>
                        <p class="mb-2"><strong>Created At:</strong> <span
                                class="created-date">{{ $category->created_at->format('M d, Y') }}</span></p>
                        <p class="mb-2">
                            <strong>Description:</strong> {{ $category->description ?? 'No description available' }}</p>
                    </div>

                </div>
            </div>
        </div>

    </div>

    </div>
@endsection


