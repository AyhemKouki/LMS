@php use App\Models\User; @endphp
@extends('users.admin.layout.layout')

@section('title', '')

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
            padding: 2rem;
            color: #0f172a;
        }

        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .page-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #6366f1, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 1.1rem;
            font-weight: 400;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #6366f1;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .main-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            overflow: hidden;
        }

        .card-header-modern {
            background: linear-gradient(135deg, #ffffff, #f8fafc);
            padding: 2rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #0f172a;
            margin: 0;
        }

        .search-container {
            position: relative;
            max-width: 400px;
            flex: 1;
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 3rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background: #ffffff;
        }

        .search-input:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            pointer-events: none;
        }

        .action-buttons {
            display: flex;
            gap: 0.75rem;
        }

        .btn-modern {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary-modern {
            background: linear-gradient(135deg, #6366f1, #818cf8);
            color: white;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        .btn-primary-modern:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        }

        .btn-secondary-modern {
            background: #ffffff;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

        .btn-secondary-modern:hover {
            background: #f8fafc;
            transform: translateY(-1px);
        }

        .table-container {
            overflow-x: auto;
        }

        .table-modern {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        .table-modern thead {
            background: #f8fafc;
        }

        .table-modern th {
            padding: 1.25rem 1.5rem;
            text-align: left;
            font-weight: 600;
            color: #64748b;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0;
        }

        .table-modern th:last-child {
            text-align: center;
        }

        .table-modern td {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }

        .table-modern tbody tr {
            transition: all 0.2s ease;
        }

        .table-modern tbody tr:hover {
            background: rgba(99, 102, 241, 0.02);
            transform: scale(1.001);
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #e2e8f0;
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-name {
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 0.25rem;
        }

        .user-role {
            font-size: 0.8rem;
            color: #64748b;
            background: #f1f5f9;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-weight: 500;
        }

        .action-buttons-table {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            align-items: center;
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


        .action-btn.delete {
            color: #ef4444;
            border-color: #ef4444;
        }

        .action-btn.delete:hover {
            background: #ef4444;
            color: white;
        }

        .pagination-modern {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            padding: 2rem;
            background: #f8fafc;
        }

        .pagination-modern nav {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .pagination-modern .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 0.5rem;
        }

        .pagination-modern .page-item .page-link {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            cursor: pointer;
            font-weight: 500;
            color: #6366f1;
            text-decoration: none;
        }

        .pagination-modern .page-item .page-link:hover {
            background: #6366f1;
            color: white;
            transform: translateY(-1px);
        }

        .pagination-modern .page-item.active .page-link {
            background: #6366f1;
            color: white;
            border-color: #6366f1;
        }

        .pagination-modern .page-item.disabled .page-link {
            opacity: 0.5;
            cursor: not-allowed;
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .page-header {
                padding: 1.5rem;
            }

            .page-title {
                font-size: 2rem;
            }

            .header-content {
                flex-direction: column;
                align-items: stretch;
            }

            .search-container {
                max-width: none;
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
        }

        .loading-skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }
            100% {
                background-position: -200% 0;
            }
        }

        .filter-tabs {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .filter-tab {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
        }

        .filter-tab.active {
            background: #6366f1;
            color: white;
            border-color: #6366f1;
        }
    </style>


    <div class="dashboard-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">User Management</h1>
            <p class="page-subtitle">Manage and monitor all user accounts </p>
        </div>

        <!-- Stats Section -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-number">{{User::count()}}</div>
                <div class="stat-label">Total Users</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{User::where('role' , 'student')->count()}}</div>
                <div class="stat-label">Students</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{User::where('role' , 'instructor')->count()}}</div>
                <div class="stat-label">Instructors</div>
            </div>

        </div>

        <!-- Main Content Card -->
        <div class="main-card">
            <!-- Card Header -->
            <div class="card-header-modern">
                <div class="header-content">
                    <h2 class="header-title">All Users</h2>

                </div>

                <div class="filter-tabs" style="margin-top: 1.5rem;">
                    <a href="{{route('admin.alluser.index')}}" class="filter-tab active">All Users</a>
                    <a href="{{route('admin.student.index')}}" class="filter-tab active">Students</a>
                    <a href="{{route('admin.instructor.index')}}" class="filter-tab active">Instructors</a>
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
                        <th>Actions</th>
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
            <div class="pagination-modern">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

@endsection

@push('scripts')
    <script>
        // Search functionality
        const searchInput = document.querySelector('.search-input');
        const tableRows = document.querySelectorAll('.table-modern tbody tr');

        searchInput.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();

            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Filter tabs functionality
        const filterTabs = document.querySelectorAll('.filter-tab');

        filterTabs.forEach(tab => {
            tab.addEventListener('click', function () {
                // Remove active class from all tabs
                filterTabs.forEach(t => t.classList.remove('active'));
                // Add active class to clicked tab
                this.classList.add('active');

                // Filter logic would go here
                const filter = this.textContent.toLowerCase();
                console.log('Filtering by:', filter);
            });
        });

        // Confirm delete function
        function confirmDelete(userName) {
            if (confirm(`Are you sure you want to delete ${userName}?`)) {
                // Delete logic would go here
                console.log('Deleting user:', userName);
            }
        }

        // Action button hover effects
        const actionButtons = document.querySelectorAll('.action-btn');

        actionButtons.forEach(btn => {
            btn.addEventListener('mouseenter', function () {
                this.style.transform = 'translateY(-2px) scale(1.05)';
            });

            btn.addEventListener('mouseleave', function () {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Smooth hover animations for table rows
        const rows = document.querySelectorAll('.table-modern tbody tr');

        rows.forEach(row => {
            row.addEventListener('mouseenter', function () {
                this.style.boxShadow = '0 4px 12px rgba(99, 102, 241, 0.15)';
            });

            row.addEventListener('mouseleave', function () {
                this.style.boxShadow = 'none';
            });
        });

        // Initialize tooltips (if using Bootstrap tooltips)
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
@endpush
