@extends('front.layout.layout')

@section('content')
    <div class="container py-5">
        @if(session('cart'))
                    <div class="row">
                        <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Shopping Cart</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Course</th>
                                            <th>Price</th>
                                            <th>Subtotal</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $total = 0 @endphp
                                        @foreach(session('cart') as $id => $details)
                                            @php $total += $details['price'] @endphp
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{asset('storage/'.$details['image']) }}" alt="{{ $details['name'] }}"
                                                             class="img-fluid rounded" style="max-width: 80px">
                                                        <div class="ms-3">
                                                            <h6 class="mb-0">{{ $details['name'] }}</h6>
                                                            <small
                                                                class="text-muted">{{ Str::limit($details['description'], 100) }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>${{ $details['price'] }}</td>
                                                <td>${{ $details['price'] }}</td>
                                                <td>
                                                    <form id="remove-form-{{ $id }}"
                                                          action="{{ route('removeFromCart', $id) }}" method="POST"
                                                          style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="btn btn-link border border-danger rounded p-2 transition-colors duration-200 ease-in-out hover:bg-red-100">
                                                            <i class="fas fa-trash text-danger"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Cart Summary</h5>
                                <div class="d-flex justify-content-between mb-3">
                                    <span>Total</span>
                                    <span>${{ $total }}</span>
                                </div>
                                <form action="{{ route('order.post') }}" method="POST">
                                    @csrf
                                    <a href="{{ route('coursespage.index') }}" class="btn btn-secondary w-100 mb-3">Continue Shopping</a>
                                    <button type="submit" class="btn btn-primary w-100">Complete Purchase</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        @else
            <div class="text-center">
                <h3>Your cart is empty</h3>
                <a href="{{ route('coursespage.index') }}" class="btn btn-primary mt-3">Continue Shopping</a>
            </div>
        @endif
    </div>
@endsection
