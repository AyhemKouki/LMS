@extends('users.user.layout.layout')

@section('content2')
    <div class="container-fluid">
        <h2 class="mb-4">My Orders</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Courses</th>
                    <th>Amount</th>
                    <th>Status</th>

                </tr>
                </thead>
                <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                        <td>
                            @foreach($order_courses as $order_course)
                                @if($order_course->order_id === $order->id)
                                    <div>{{ $order_course->course->title ?? 'N/A' }}</div>
                                @endif
                            @endforeach
                        </td>
                        <td>${{ number_format($order->amount, 2) }}</td>
                        <td>
                                <span
                                    class="badge bg-{{ $order->status === 1 ? 'success' : 'danger' }}">
                                    {{ $order->status === 1 ? 'completed' : 'canceled' }}
                                </span>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No orders found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
