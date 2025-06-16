@extends('users.admin.layout.layout')

@section('title' , 'Instructor Requests')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                    <div>
                        <h1 class="h3 fw-bold text-dark mb-1">
                            <i class="bi bi-person-check-fill me-2"></i>
                            Instructor Requests
                        </h1>
                        <p class="text-muted mb-0">Manage and review instructor application requests</p>
                    </div>
                    <div class="d-flex gap-2 align-items-center">
                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                            <i class="bi bi-list-check me-1"></i>
                            {{ $requests->total() }} Total Request{{ $requests->total() != 1 ? 's' : '' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Card -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                    @if($requests->count() > 0)
                        <!-- Table Header -->
                        <div class="card-header bg-white border-0 py-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="card-title mb-0 text-dark fw-semibold">Recent Applications</h6>
                                </div>
                                <div class="col-auto">
                                    <div class="input-group input-group-sm" style="width: 250px;">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="bi bi-search text-muted"></i>
                                        </span>
                                        <input type="text" class="form-control border-start-0 bg-light"
                                               placeholder="Search requests..." id="searchInput">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Table Content -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0" id="requestsTable">
                                    <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 fw-semibold text-dark py-3 ps-4">Applicant</th>
                                        <th class="border-0 fw-semibold text-dark py-3">Contact</th>
                                        <th class="border-0 fw-semibold text-dark py-3">Request Date</th>
                                        <th class="border-0 fw-semibold text-dark py-3">Status</th>
                                        <th class="border-0 fw-semibold text-dark py-3 pe-4">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($requests as $request)
                                        <tr class="border-bottom">
                                            <td class="py-3 ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="position-relative">
                                                        <div class="avatar-circle bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                                             style="width: 45px; height: 45px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                            @if( $request->user->profile_image != "/images/avatar.jpg")
                                                                <img
                                                                    src="{{ asset("storage/".$request->user->profile_image) }}"
                                                                    class="rounded-circle w-100 h-100 object-fit-cover"
                                                                    alt="{{ $request->user->name }}">
                                                            @else
                                                                <img src="{{asset($request->user->profile_image)}}"  class="rounded-circle w-100 h-100 object-fit-cover"
                                                                     alt="{{ $request->user->name }} ">
                                                            @endif
                                                        </div>
                                                        <div class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white"
                                                             style="width: 12px; height: 12px;"></div>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 fw-semibold text-dark">{{ $request->user->name }}</h6>
                                                        <small class="text-muted">Instructor Applicant</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                <div>
                                                    <div class="text-dark fw-medium">{{ $request->user->email }}</div>
                                                    <small class="text-muted">
                                                        <i class="bi bi-envelope me-1"></i>Primary Email
                                                    </small>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                <div>
                                                    <div class="text-dark fw-medium">{{ $request->created_at->format('M d, Y') }}</div>
                                                    <small class="text-muted">{{ $request->created_at->format('H:i A') }}</small>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                    <span class="badge bg-{{ $request->status_color }} bg-opacity-10 text-{{ $request->status_color }} border border-{{ $request->status_color }} border-opacity-25 px-3 py-2 rounded-pill fw-medium">
                                                        <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i>
                                                        {{ ucfirst($request->status) }}
                                                    </span>
                                            </td>
                                            <td class="py-3 pe-4">
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('admin.instructor-requests.show', $request) }}"
                                                       class="btn btn-sm btn-outline-primary rounded-pill px-3 hover-lift"
                                                       aria-label="Review request from {{ $request->user->name }}">
                                                    <i class="bi bi-eye me-1"></i>Review
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Pagination -->
                        @if($requests->hasPages())
                            <div class="card-footer bg-white border-0 py-3">
                                <div class="d-flex justify-content-between align-items-center">
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
                        <!-- Empty State -->
                        <div class="card-body text-center py-5">
                            <div class="empty-state">
                                <div class="empty-icon bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                                     style="width: 120px; height: 120px;">
                                    <i class="bi bi-inbox display-4 text-muted"></i>
                                </div>
                                <h4 class="text-dark mb-2">No Instructor Requests</h4>
                                <p class="text-muted mb-4">There are currently no instructor requests to review.</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="btn btn-outline-primary rounded-pill px-4">
                                        <i class="bi bi-arrow-clockwise me-2"></i>Refresh
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
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
            background-color: rgba(0,0,0,0.02);
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

        .badge {
            font-size: 0.75rem;
            letter-spacing: 0.025em;
        }

        .input-group-text {
            border-color: #e9ecef;
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
    </style>

    <!-- Search Functionality -->
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
