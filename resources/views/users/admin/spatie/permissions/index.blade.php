@extends('users.admin.layout.layout')

@section('title' , 'Permissions')

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
            text-decoration: none;
        }

        .floating-add-btn:hover {
            transform: scale(1.1) rotate(90deg);
            box-shadow: 0 12px 35px rgba(102, 126, 234, 0.8);
            color: white;
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
            margin-bottom: 0.25rem;
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
            color: white;
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

        .permission-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .permission-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .permission-details h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .permission-id {
            font-size: 0.875rem;
            color: #64748b;
        }

        .permission-description {
            font-size: 0.875rem;
            color: #64748b;
            font-style: italic;
        }

        .date-info {
            color: #64748b;
            font-size: 0.875rem;
        }

        .actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .action-btn {
            padding: 0.5rem 1rem;
            border-radius: 10px;
            border: none;
            font-size: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .action-btn.edit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .action-btn.edit:hover {
            color: white;
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .action-btn.delete {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .action-btn.delete:hover {
            color: white;
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.3;
            color: #64748b;
        }

        .empty-state h4 {
            color: #1e293b;
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: #64748b;
            margin-bottom: 2rem;
        }

        .search-box {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 0.75rem 1rem;
            width: 300px;
            transition: all 0.3s ease;
        }

        .search-box:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            outline: none;
            background: white;
        }

        .stats-badge {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            font-size: 0.875rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .permission-category {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 500;
            margin-top: 0.25rem;
        }

        .category-admin {
            background: linear-gradient(135deg, #374151 0%, #1f2937 100%);
            color: white;
        }

        .category-user {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            color: white;
        }

        .category-content {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        @media (max-width: 768px) {
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

            .permission-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .actions {
                flex-direction: column;
                width: 100%;
            }

            .action-btn {
                justify-content: center;
            }

            .search-box {
                width: 100%;
            }
        }
    </style>

    <div class="container">
        <!-- Modern Header -->
        <div class="header">
            <div class="header-content">
                <div>
                    <h1>
                        <i class="fas fa-key me-2"></i>
                        Permissions Management
                    </h1>
                    <p class="text-muted mb-0">Manage and organize user permissions across the system</p>
                </div>
                <div class="d-flex gap-3 align-items-center">
                    <div class="stats-badge">
                        <i class="fas fa-shield-alt"></i>
                        {{ $permissions->count() }} Permission{{ $permissions->count() != 1 ? 's' : '' }}
                    </div>
                    <input type="text" class="search-box" placeholder="Search permissions..." id="searchInput">
                    <a href="{{ route('admin.permission.create') }}" class="add-btn">
                        <i class="fas fa-plus-circle"></i>Create New Permission
                    </a>
                </div>
            </div>
        </div>

        <!-- Floating Add Button for Mobile -->
        <a href="{{ route('admin.permission.create') }}" class="floating-add-btn d-md-none">
            <i class="fas fa-plus"></i>
        </a>

        <!-- Main Content Card with Modern Styling -->
        <div class="main-card">
            @if($permissions->count() > 0)
                <div class="table-container">
                    <table class="modern-table" id="permissionsTable">
                        <thead>
                        <tr>
                            <th>Permission</th>
                            <th>Details</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>
                                    <div class="permission-info">
                                        <div class="permission-icon">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                        <div class="permission-details">
                                            <h3>{{ $permission->name }}</h3>
                                            <div class="permission-id">ID: {{ $permission->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        @php
                                            $category = 'user';
                                            if (str_contains(strtolower($permission->name), 'admin')) {
                                                $category = 'admin';
                                            } elseif (str_contains(strtolower($permission->name), 'content') || str_contains(strtolower($permission->name), 'course')) {
                                                $category = 'content';
                                            }
                                        @endphp
                                        <span class="permission-category category-{{ $category }}">
                                            {{ ucfirst($category) }} Permission
                                        </span>
                                        <div class="permission-description mt-1">
                                            System access control permission
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="date-info">
                                        <div class="fw-medium">{{ $permission->created_at->format('M d, Y') }}</div>
                                        <div class="small">{{ $permission->created_at->format('H:i A') }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('admin.permission.edit', $permission) }}" class="action-btn edit">
                                            <i class="fas fa-edit"></i>Edit
                                        </a>
                                        <form action="{{ route('admin.permission.destroy', $permission) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete"
                                                    onclick="return confirm('Are you sure you want to delete this permission?')">
                                                <i class="fas fa-trash"></i>Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <!-- Modern Empty State -->
                <div class="empty-state">
                    <i class="fas fa-key"></i>
                    <h4>No Permissions Found</h4>
                    <p>There are currently no permissions in the system. Create your first permission to get started.</p>
                    <a href="{{ route('admin.permission.create') }}" class="add-btn">
                        <i class="fas fa-plus-circle"></i>Create First Permission
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Enhanced Search Functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const table = document.getElementById('permissionsTable');
            let searchTimeout;

            if (searchInput && table) {
                searchInput.addEventListener('keyup', function() {
                    const tbody = table.getElementsByTagName('tbody')[0];

                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        try {
                            const filter = this.value.toLowerCase();
                            const rows = tbody.getElementsByTagName('tr');

                            for (let i = 0; i < rows.length; i++) {
                                const cells = rows[i].getElementsByTagName('td');
                                let found = false;

                                for (let j = 0; j < cells.length; j++) {
                                    if (cells[j].textContent.toLowerCase().indexOf(filter) > -1) {
                                        found = true;
                                        break;
                                    }
                                }

                                rows[i].style.display = found ? '' : 'none';
                            }
                        } catch (error) {
                            console.error('Search error:', error);
                        }
                    }, 300);
                });
            }

            // Enhanced delete confirmation
            document.querySelectorAll('.action-btn.delete').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const permissionName = this.closest('tr').querySelector('.permission-details h3').textContent;

                    if (confirm(`Are you sure you want to delete the permission "${permissionName}"? This action cannot be undone and may affect user access.`)) {
                        this.closest('form').submit();
                    }
                });
            });

            // Add visual feedback for permission categories
            document.querySelectorAll('.permission-category').forEach(badge => {
                badge.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.05)';
                });

                badge.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });
        });
    </script>
@endsection
