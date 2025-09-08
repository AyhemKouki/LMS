@extends('users.admin.layout.layout')

@section('title' , 'Coupons')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Coupons Management</h4>
                    </div>

                    <div class="card-body">
                        @if(session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="mb-4">
                            <a href="{{ route('admin.coupons.create') }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> Add New Coupon
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Coupon Name</th>
                                    <th>Discount</th>
                                    <th>Validity</th>
                                    <th>Course</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($coupons as $coupon)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $coupon->coupon_name }}</td>
                                        <td>{{ $coupon->coupon_discount }}</td>
                                        <td>{{ $coupon->coupon_validity }}</td>
                                        <td>{{ $coupon->course->title ?? 'All Courses' }}</td>
                                        <td>
                                        <span class="badge badge-{{ $coupon->status ? 'success' : 'danger' }}">
                                            {{ $coupon->status ? 'Active' : 'Inactive' }}
                                        </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this coupon?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No coupons found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .badge {
            font-size: 100%;
        }
        .table th {
            white-space: nowrap;
        }
        .action-buttons .btn {
            margin-right: 5px;
        }
    </style>
@endsection
