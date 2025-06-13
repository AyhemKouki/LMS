@extends('users.admin.layout.layout')

@section('title', 'Courses')

@section('content')

    <style>
        .container {
            max-width: 1400px;
            margin: 0 auto;
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

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .header h1 {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .add-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
            text-decoration: none !important;
        }

        .add-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(102, 126, 234, 0.4);
        }

        .main-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .table-container {
            overflow-x: auto;
        }

        .modern-table {
            width: 100%;
            border-collapse: collapse;
        }

        .modern-table thead {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .modern-table th {
            padding: 1.5rem 1rem;
            text-align: left;
            font-weight: 600;
            color: #475569;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 2px solid #e2e8f0;
        }

        .modern-table td {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .modern-table tbody tr {
            transition: all 0.3s ease;
        }

        .modern-table tbody tr:hover {
            background: linear-gradient(135deg, #fafbff 0%, #f0f4ff 100%);
            transform: scale(1.001);
        }

        .course-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .course-thumbnail {
            width: 80px;
            height: 60px;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .course-details h3 {
            font-size: 1rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .course-duration {
            font-size: 0.875rem;
            color: #64748b;
        }

        .instructor-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .instructor-name {
            font-weight: 500;
            color: #1e293b;
        }

        .badge {
            padding: 0.375rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .badge-admin {
            background: linear-gradient(135deg, #374151 0%, #1f2937 100%);
            color: white;
        }

        .badge-instructor {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .badge-category {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            color: white;
        }

        .badge-beginner {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: white;
        }

        .badge-intermediate {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: white;
        }

        .badge-advanced {
            background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%);
            color: white;
        }

        .badge-published {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .badge-draft {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
        }

        .badge-archived {
            background: linear-gradient(135deg, #374151 0%, #1f2937 100%);
            color: white;
        }

        .badge-approved {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .badge-pending {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .badge-rejected {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .status-column {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .price-info {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .original-price {
            text-decoration: line-through;
            color: #9ca3af;
            font-size: 0.875rem;
        }
        .sale-price {
            color: #ef4444;
            font-weight: 600;
        }

        .regular-price {
            font-weight: 600;
            color: #1e293b;
        }

        .actions {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .action-btn.view {
            color: #667eea;
            border-color: #667eea;
        }

        .action-btn.view:hover {
            background: #667eea;
            color: white;
        }

        .action-btn.edit {
            color: #f59e0b;
            border-color: #f59e0b;
        }

        .action-btn.edit:hover {
            background: #f59e0b;
            color: white;
        }

        .action-btn.delete {
            color: #ef4444;
            border-color: #ef4444;
        }

        .action-btn.delete:hover {
            background: #ef4444;
            color: white;
        }

        .pagination {
            padding: 2rem;
            display: flex;
            justify-content: center;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.3;
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


        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .header {
                padding: 1.5rem;
            }

            .header-content {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .modern-table th,
            .modern-table td {
                padding: 1rem 0.5rem;
            }

            .course-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .actions {
                flex-direction: column;
            }
        }
    </style>

    <div class="container">
        <div class="header ">
            <div class="header-content d-flex justify-content-between w-100">
                <h1>Course Management</h1>
                <a href="{{ route('admin.course.create') }}" class="add-btn">
                    <i class="fas fa-plus"></i>
                    Add Course
                </a>
            </div>
        </div>

        <div class="main-card">
            <div class="table-container">
                <table class="modern-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Course</th>
                        <th>Instructor</th>
                        <th>Category</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>Created</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td><strong>{{ $course->id }}</strong></td>
                            <td>
                                <div class="course-info">
                                    @if($course->thumbnail)
                                        <img src="{{ asset('storage/' . $course->thumbnail) }}"
                                             class="course-thumbnail"
                                             alt="{{ $course->title }}">
                                    @endif
                                    <div class="course-details">
                                        <h3>{{ $course->title }}</h3>
                                        <div class="course-duration">{{ $course->duration_hours }} hours</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="instructor-info">
                                    <div>
                                        <div class="instructor-name">
                                            @if($course->admin_id)
                                                {{ $course->admin->name ?? 'N/A' }}
                                            @elseif($course->user_id)
                                                {{ $course->user->name ?? 'N/A' }}
                                            @else
                                                N/A
                                            @endif</div>
                                        <span class="badge badge-instructor">
                                            @if($course->admin_id)
                                                Admin
                                            @elseif($course->user_id)
                                                Instructor
                                            @else
                                                N/A
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-category">
                                    @if($course->category)
                                        {{ $course->category->name }}
                                    @else
                                        None
                                    @endif
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-{{ $course->level }}">{{ ucfirst($course->level) }}</span>
                            </td>
                            <td>
                                <div class="status-column">
                                    @if($course->status == 'published')
                                        <span class="badge badge-published">Published</span>
                                    @elseif($course->status == 'draft')
                                        <span class="badge badge-draft">Draft</span>
                                    @else
                                        <span class="badge badge-archived">Archived</span>
                                    @endif

                                    @if($course->is_approved === 'approved')
                                        <span class="badge badge-approved">Approved</span>
                                    @elseif($course->is_approved === 'pending')
                                            <span class="badge badge-pending">Pending</span>
                                        @else
                                            <span class="badge badge-rejected">Rejected</span>
                                        @endif
                                </div>
                            </td>
                            <td>
                                <div class="price-info">
                                    <span class="regular-price">${{ number_format($course->price, 2) }}</span>
                                </div>
                            </td>
                            <td>{{ $course->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.course.show', $course->id) }}" class="action-btn view" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.course.edit', $course->id) }}" class="action-btn edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.course.destroy', $course->id) }}" method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete" title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this course?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination-modern">
                {{ $courses->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <!-- Floating Add Button -->
    <a href="{{route('admin.course.create')}}" class="floating-add-btn" title="Add New Course">
        <i class="bi bi-plus"></i>
    </a>

@endsection

@push('scripts')

    <script>
        function confirmDelete(courseName) {
            if (confirm(`Are you sure you want to delete "${courseName}"?`)) {
                alert('Course deleted successfully!');
            }
        }

        // Add hover effects and animations
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('.modern-table tbody tr');
            rows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(4px)';
                });

                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
        });
    </script>
@endpush
