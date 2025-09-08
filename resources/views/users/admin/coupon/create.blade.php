@extends('users.admin.layout.layout')

@section('title' , 'Coupons')
@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Create New Coupon</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.coupons.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf

                            <div class="mb-3">
                                <label for="coupon_name" class="form-label">Coupon Name</label>
                                <input type="text" class="form-control" name="coupon_name" id="coupon_name" required>
                                <div class="invalid-feedback">
                                    Please provide a coupon name.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="coupon_discount" class="form-label">Discount (%)</label>
                                <input type="number" class="form-control" name="coupon_discount" id="coupon_discount" min="1" max="100" required>
                                <div class="invalid-feedback">
                                    Please provide a valid discount percentage (1-100).
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="coupon_validity" class="form-label">Expiry Date</label>
                                <input type="date" class="form-control" name="coupon_validity" id="coupon_validity" required>
                                <div class="invalid-feedback">
                                    Please select an expiry date.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="course_id" class="form-label">Associated Course (optional)</label>
                                <select name="course_id" id="course_id" class="form-select">
                                    <option value="">None</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="status" class="form-label">Coupon Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-plus-circle me-2"></i>Create Coupon
                                </button>
                                <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border-radius: 10px;
            border: none;
        }
        .form-control, .form-select {
            padding: 10px;
            border-radius: 5px;
        }
        .btn {
            border-radius: 5px;
            padding: 10px 20px;
        }
    </style>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
@endsection
