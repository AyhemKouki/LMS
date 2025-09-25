@extends('users.user.layout.layout')

@section('content2')
    <div class="container-fluid px-4 py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0 text-primary"> Order History</h2>
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-funnel-fill me-2"></i> Filter
                </button>
                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                    <li><a class="dropdown-item" href="#">All Orders</a></li>
                    <li><a class="dropdown-item" href="#">Completed</a></li>
                    <li><a class="dropdown-item" href="#">Canceled</a></li>
                </ul>
            </div>
        </div>

        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-uppercase text-secondary small">
                        <tr>
                            <th class="ps-4 py-3">Order ID</th>
                            <th class="py-3">Date</th>
                            <th class="py-3">Courses</th>
                            <th class="py-3">Amount</th>
                            <th class="pe-4 py-3 text-end">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($orders as $order)
                            <tr class="border-top">
                                <td class="ps-4 py-3">
                                    <a href="#" class="text-decoration-none text-primary fw-semibold">#{{ $order->id }}</a>
                                </td>
                                <td class="py-3 text-muted">
                                    {{ $order->created_at->format('M d, Y') }}
                                </td>
                                <td class="py-3">
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($order_courses as $order_course)
                                            @if($order_course->order_id === $order->id)
                                                <span class="badge bg-light border text-dark">
                                                    <i class="bi bi-book me-1"></i> {{ $order_course->course->title ?? 'N/A' }}
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                                <td class="py-3 fw-semibold text-dark">
                                    ${{ number_format($order->amount, 2) }}
                                </td>
                                <td class="pe-4 py-3 text-end">
                                    <span class="badge rounded-pill px-3 py-2 fw-medium
                                        bg-{{ $order->status === 1 ? 'success' : 'danger' }}-subtle
                                        text-{{ $order->status === 1 ? 'success' : 'danger' }}">
                                        <i class="bi {{ $order->status === 1 ? 'bi-check-circle-fill' : 'bi-x-circle-fill' }} me-1"></i>
                                        {{ $order->status === 1 ? 'Completed' : 'Canceled' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center justify-content-center text-muted">
                                        <i class="bi bi-cart-x fs-1 mb-3"></i>
                                        <h5 class="fw-semibold">No orders found</h5>
                                        <p>You haven't placed any orders yet.</p>
                                        <a href="{{ route('coursespage.index') }}" class="btn btn-primary mt-2 px-4">
                                            <i class="bi bi-book me-2"></i> Browse Courses
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .table th, .table td {
            vertical-align: middle;
        }
        .table thead th {
            border-bottom: 2px solid #dee2e6;
        }
        .badge {
            font-size: 0.78rem;
            letter-spacing: 0.3px;
        }
        .card {
            border-radius: 1rem;
        }
    </style>
@endsection
