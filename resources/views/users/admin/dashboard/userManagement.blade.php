@php use App\Models\User; @endphp
@extends('users.admin.layout.layout')

@section('title', 'User Management')

@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #1e293b;
        }

        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Glass Card Effect - Light Theme */
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.5);
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98), rgba(248, 250, 252, 0.95));
            backdrop-filter: blur(20px);
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 20px;
            padding: 3rem 2.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #3b82f6, #06b6d4, #8b5cf6);
        }

        .page-title {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 1.2rem;
            font-weight: 400;
            opacity: 0.9;
        }

        /* Stats Container */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(248, 250, 252, 0.9));
            border: 1px solid rgba(226, 232, 240, 0.6);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, #3b82f6, #06b6d4);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .stat-card:hover::before {
            opacity: 1;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            color: white;
            font-size: 1.4rem;
        }

        .stat-number {
            font-size: 2.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            line-height: 1;
        }

        .stat-label {
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Main Card */
        .main-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98), rgba(248, 250, 252, 0.95));
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2.5rem;
            color: white;
            position: relative;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
            position: relative;
            z-index: 1;
        }

        .header-title {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
        }

        .btn-modern {
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            position: relative;
        }

        .btn-primary {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.95);
            color: #3b82f6;
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .btn-secondary:hover {
            background: white;
            transform: translateY(-1px);
        }

        /* Filter Tabs */
        .filter-tabs {
            display: flex;
            gap: 0.5rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .filter-tab {
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.15);
            color: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.2);
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
        }

        .filter-tab:hover {
            background: rgba(255, 255, 255, 0.25);
            color: white;
        }

        .filter-tab.active {
            background: rgba(255, 255, 255, 0.95);
            color: #3b82f6;
            border-color: rgba(255, 255, 255, 0.8);
        }

        /* Table - NO ANIMATIONS */
        .table-container {
            overflow-x: auto;
            padding: 0;
        }

        .table-modern {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
        }

        .table-modern thead {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
        }

        .table-modern th {
            padding: 1.5rem 2rem;
            text-align: left;
            font-weight: 700;
            color: #334155;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0;
        }

        .table-modern th:last-child,
        .table-modern td:last-child {
            min-width: 120px; /* Assure assez d'espace */
            white-space: nowrap;
        }

        .table-modern th:last-child {
            text-align: center;
        }

        .table-modern td {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid rgba(226, 232, 240, 0.6);
            vertical-align: middle;
        }

        /* Table rows - STATIC, NO HOVER ANIMATIONS */
        .table-modern tbody tr {
            background: white;
        }

        .table-modern tbody tr:nth-child(even) {
            background: rgba(248, 250, 252, 0.5);
        }

        /* User Info */
        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(59, 130, 246, 0.2);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .user-details h4 {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
            font-size: 1rem;
        }

        .user-role {
            font-size: 0.8rem;
            color: #64748b;
            background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-weight: 500;
            display: inline-block;
        }

        .user-role.admin {
            background: linear-gradient(135deg, #fef3c7, #fed7aa);
            color: #92400e;
        }

        .user-role.instructor {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e40af;
        }

        .user-role.student {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
        }

        /* Action Buttons - STATIC */
        .action-buttons {
            display: flex;
            flex-direction: row !important;
            gap: 0.5rem;
            justify-content: center;
            align-items: center;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: 2px solid currentColor;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            color: #64748b;
            font-size: 1rem;
            margin: 0 2px;
        }

        .action-btn:hover {
            background: currentColor;
        }

        .action-btn.view {
            color: #0ea5e9;
        }

        .action-btn.view:hover i {
            color: white;
        }

        .action-btn.edit {
            color: #f59e0b;
        }

        .action-btn.edit:hover i {
            color: white;
        }

        .action-btn.delete {
            color: #ef4444;
        }

        .action-btn.delete:hover i {
            color: white;
        }

        /* Pagination */
        .pagination-wrapper {
            padding: 2rem;
            background: linear-gradient(135deg, rgba(248, 250, 252, 0.8), rgba(226, 232, 240, 0.8));
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 0 0 20px 20px;
        }

        .pagination {
            display: flex;
            gap: 0.75rem;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .page-item .page-link {
            min-width: 42px;
            height: 42px;
            border-radius: 12px;
            border: 2px solid transparent;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            cursor: pointer;
            font-weight: 600;
            color: #64748b;
            text-decoration: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 0 1rem;
        }

        .page-item .page-link:hover {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            border-color: #3b82f6;
            color: #3b82f6;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.15);
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            border-color: transparent;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .page-item.disabled .page-link {
            opacity: 0.5;
            cursor: not-allowed;
            background: rgba(255, 255, 255, 0.8);
            pointer-events: none;
        }

        .page-item:first-child .page-link,
        .page-item:last-child .page-link {
            font-size: 1.2rem;
            padding: 0;
            width: 42px;
        }

        @media (max-width: 640px) {
            .pagination {
                gap: 0.5rem;
            }

            .page-item .page-link {
                min-width: 38px;
                height: 38px;
                font-size: 0.9rem;
                padding: 0 0.75rem;
            }

            .pagination-wrapper {
                padding: 1.5rem 1rem;
            }
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .dashboard-container {
                padding: 1.5rem;
            }

            .stats-container {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .dashboard-container {
                padding: 1rem;
            }

            .page-header {
                padding: 2rem 1.5rem;
            }

            .page-title {
                font-size: 2rem;
            }

            .header-content {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-tabs {
                justify-content: center;
            }

            .table-modern th,
            .table-modern td {
                padding: 1rem;
            }

            .user-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .stats-container {
                grid-template-columns: 1fr;
            }

            .stat-card {
                padding: 1.5rem;
            }

            .stat-number {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 1.5rem;
            }

            .card-header {
                padding: 1.5rem;
            }

            .header-title {
                font-size: 1.5rem;
            }
        }

        /* Focus States */
        .btn-modern:focus,
        .action-btn:focus,
        .filter-tab:focus {
            outline: 2px solid #3b82f6;
            outline-offset: 2px;
        }
    </style>

    <div class="dashboard-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">User Management</h1>
            <p class="page-subtitle">Manage and monitor all user accounts with advanced controls</p>
        </div>

        <!-- Stats Section -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-number">{{ User::count() }}</div>
                <div class="stat-label">Total Users</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="stat-number">{{ User::where('role', 'student')->count() }}</div>
                <div class="stat-label">Students</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div class="stat-number">{{ User::where('role', 'instructor')->count() }}</div>
                <div class="stat-label">Instructors</div>
            </div>
        </div>

        <!-- Main Content Card -->
        <div class="main-card">
            <!-- Card Header -->
            <div class="card-header">
                <div class="header-content">
                    <h2 class="header-title">All Users</h2>
                    <div class="header-actions">
                    </div>
                </div>

                <div class="filter-tabs">
                    <a href="{{ route('admin.alluser.index') }}" class="filter-tab {{ Route::currentRouteName() == 'admin.alluser.index' ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        All Users
                    </a>
                    <a href="{{ route('admin.student.index') }}" class="filter-tab {{ Route::currentRouteName() == 'admin.student.index' ? 'active' : '' }}">
                        <i class="fas fa-graduation-cap"></i>
                        Students
                    </a>
                    <a href="{{ route('admin.instructor.index') }}" class="filter-tab {{ Route::currentRouteName() == 'admin.instructor.index' ? 'active' : '' }}">
                        <i class="fas fa-chalkboard-teacher"></i>
                        Instructors
                    </a>
                </div>
            </div>

            <!-- Table -->
            <div class="table-container">
                <table class="table-modern">
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Join Date</th>
                        <th style="text-align: center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(Route::currentRouteName() == 'admin.student.index')
                        @yield('studentloop')
                    @elseif(Route::currentRouteName() == 'admin.alluser.index')
                        @yield('userloop')
                    @elseif(Route::currentRouteName() == 'admin.instructor.index')
                        @yield('instructorloop')
                    @endif
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                @if(Route::currentRouteName() == 'admin.student.index')
                    {{ $students->links('pagination::bootstrap-5') }}
                @elseif(Route::currentRouteName() == 'admin.alluser.index')
                    {{ $users->links('pagination::bootstrap-5') }}
                @elseif(Route::currentRouteName() == 'admin.instructor.index')
                    {{ $instructors->links('pagination::bootstrap-5') }}
                @endif
            </div>
        </div>
    </div>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Confirm delete function
            window.confirmDelete = function(userName, userId) {
                const result = confirm(`⚠️ Are you sure you want to delete user "${userName}"?\n\nThis action cannot be undone.`);
                if (result) {
                    // Add loading state to delete button
                    const deleteBtn = document.querySelector(`[onclick*="${userId}"]`);
                    if (deleteBtn) {
                        deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                        deleteBtn.style.pointerEvents = 'none';
                    }

                    // Here you would typically submit a form or make an AJAX request
                    console.log('Deleting user:', userName, userId);
                }
            };

            // Filter tab loading states (minimal)
            const filterTabs = document.querySelectorAll('.filter-tab');

            filterTabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    if (!this.classList.contains('active')) {
                        const originalText = this.innerHTML;
                        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';

                        setTimeout(() => {
                            this.innerHTML = originalText;
                        }, 500);
                    }
                });
            });
        });
    </script>
