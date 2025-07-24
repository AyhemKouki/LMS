@extends('users.user.layout.layout')

@section('content2')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Edit Coupon</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('coupons.update', $coupon->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="coupon_name">Coupon Name</label>
                                <input type="text" class="form-control" id="coupon_name" name="coupon_name"
                                       value="{{ old('coupon_name', $coupon->coupon_name) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="coupon_discount">Discount</label>
                                <input type="text" class="form-control" id="coupon_discount" name="coupon_discount"
                                       value="{{ old('coupon_discount', $coupon->coupon_discount) }}" required>
                                <small class="form-text text-muted">Enter percentage (e.g., 20%) or fixed amount</small>
                            </div>

                            <div class="form-group">
                                <label for="coupon_validity">Validity</label>
                                <input type="datetime-local" class="form-control" id="coupon_validity" name="coupon_validity"
                                       value="{{ old('coupon_validity', $coupon->coupon_validity) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="course_id">Apply to Course (Optional)</label>
                                <select class="form-control" id="course_id" name="course_id">
                                    <option value="">All Courses</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}" {{ $coupon->course_id == $course->id ? 'selected' : '' }}>
                                            {{ $course->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1" {{ $coupon->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $coupon->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary">
                                    Update Coupon
                                </button>
                                <a href="{{ route('coupons.index') }}" class="btn btn-secondary">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
