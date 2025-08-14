@extends('users.admin.layout.layout')

@section('title' , 'Instructor Requests')

@section('content')
    <style>
        .container {
            max-width: 1400px;
            margin: 0 auto;
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

        /* Enhanced styles for the existing structure */
        .hover-lift {
            transition: all 0.2s ease-in-out;
        }

        .hover-lift:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .card {
            transition: all 0.3s ease;
        }

        .table-hover tbody tr:hover {
            background: linear-gradient(135deg, #fafbff 0%, #f0f4ff 100%);
        }

        tbody.searching {
            opacity: 0.7;
            transition: opacity 0.2s ease;
        }

        .avatar-circle {
            transition: all 0.3s ease;
        }

        .avatar-circle:hover {
            transform: scale(1.05);
        }

        .empty-state {
            animation: fadeInUp 0.6s ease-out;
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

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .dropdown-menu {
            border: 1px solid rgba(0,0,0,0.08);
            animation: fadeIn 0.15s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Custom badge styles for status */
        .badge.bg-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        }

        .badge.bg-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
        }

        .badge.bg-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
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

            .course-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .actions {
                flex-direction: column;
            }
        }
        .search-box:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            outline: none;
            background: white;
        }
    </style>

    <div class="container">
        <!-- Modern Header -->
        <div class="header">
            <div class="header-content">
                <div>
                    <h1>
                        <i class="bi bi-person-check-fill me-2"></i>
                        Instructor Requests
                    </h1>
                    <p class="text-muted mb-0">Manage and review instructor application requests</p>
                </div>
                <div class="d-flex gap-2 align-items-center">
                    <span class="badge badge-category px-3 py-2 rounded-pill">
                        <i class="bi bi-list-check me-1"></i>
                        {{ $requests->total() }} Total Request{{ $requests->total() != 1 ? 's' : '' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Main Content Card with Modern Styling -->
        <div class="main-card">
            @if($requests->count() > 0)
                <!-- Modern Table Header -->
                <div class="card-header bg-white border-0 py-3" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%) !important;">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="card-title mb-0 text-dark fw-semibold">Recent Applications</h6>
                        </div>
                        <div class="col-auto">
                            <div class="d-flex  align-items-center" style="width: 250px;">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-search text-muted"></i>
                                </span>
                                <input type="text" class="search-box form-control" name="search"
                                       placeholder="Search requests..." id="searchInput">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modern Table Content -->
                <div class="table-container p-0">
                    <table class="modern-table" id="requestsTable">
                        <thead>
                        <tr>
                            <th class="ps-4">Applicant</th>
                            <th>Contact</th>
                            <th>Request Date</th>
                            <th>Status</th>
                            <th class="pe-4">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($requests as $request)
                            <tr>
                                <td class="ps-4">
                                    <div class="course-info">
                                        <div class="position-relative">
                                            <div class="avatar-circle bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                                 style="width: 45px; height: 45px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                @if( $request->user->profile_image != "/images/avatar.jpg")
                                                    <img
                                                        src="{{ asset("storage/".$request->user->profile_image) }}"
                                                        class="rounded-circle w-100 h-100 object-fit-cover"
                                                        alt="{{ $request->user->name }}">
                                                @else
                                                    <img src="{{asset($request->user->profile_image)}}" class="rounded-circle w-100 h-100 object-fit-cover"
                                                         alt="{{ $request->user->name }}">
                                                @endif
                                            </div>
                                            <div class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white"
                                                 style="width: 12px; height: 12px;"></div>
                                        </div>
                                        <div class="course-details">
                                            <h3>{{ $request->user->name }}</h3>
                                            <div class="course-duration">Instructor Applicant</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="instructor-info">
                                        <div>
                                            <div class="instructor-name">{{ $request->user->email }}</div>
                                            <small class="text-muted">
                                                <i class="bi bi-envelope me-1"></i>Primary Email
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div class="instructor-name">{{ $request->created_at->format('M d, Y') }}</div>
                                        <small class="text-muted">{{ $request->created_at->format('H:i A') }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="status-column">
                                        @php
                                            $statusClass = match($request->status) {
                                                'approved' => 'badge-approved',
                                                'pending' => 'badge-pending',
                                                'rejected' => 'badge-rejected',
                                                default => 'badge-pending'
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }}">
                                            <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i>
                                            {{ ucfirst($request->status) }}
                                        </span>
                                    </div>
                                </td>
                                <td class="pe-4">
                                    <div class="actions">
                                        <a href="{{ route('admin.instructor-requests.show', $request) }}"
                                           class="action-btn view" title="Review request">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Modern Pagination -->
                @if($requests->hasPages())
                    <div class="pagination">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <div class="text-muted small">
                                Showing {{ $requests->firstItem() }} to {{ $requests->lastItem() }} of {{ $requests->total() }} results
                            </div>
                            <div>
                                {{ $requests->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <!-- Modern Empty State -->
                <div class="card-body text-center py-5">
                    <div class="empty-state">
                        <div class="empty-icon bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                             style="width: 120px; height: 120px;">
                            <i class="bi bi-inbox display-4 text-muted"></i>
                        </div>
                        <h4 class="text-dark mb-2">No Instructor Requests</h4>
                        <p class="text-muted mb-4">There are currently no instructor requests to review.</p>
                        <div class="d-flex justify-content-center gap-2">
                            <button class="add-btn" onclick="window.location.reload()">
                                <i class="bi bi-arrow-clockwise me-2"></i>Refresh
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Enhanced Search Functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const table = document.getElementById('requestsTable');
            let searchTimeout;

            if (searchInput && table) {
                searchInput.addEventListener('keyup', function () {
                    const tbody = table.getElementsByTagName('tbody')[0];
                    tbody.classList.add('searching');

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
                        } finally {
                            tbody.classList.remove('searching');
                        }
                    }, 300);
                });
            }
        });
    </script>
@endsection
