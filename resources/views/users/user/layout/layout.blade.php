@extends('front.layout.layout2')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 bg-white shadow-sm p-3 min-vh-100">
                <!-- Profile Card -->
                <div class="text-center mb-4">
                    <img src="{{ auth()->user()->profile_image }}" class="rounded-circle" width="80" height="80" alt="Avatar">
                    <h5 class="mt-2 mb-0">{{auth()->user()->name}}</h5>
                    <small class="text-muted">{{auth()->user()->role}}</small>
                </div>

                <!-- Sidebar Links -->
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('dashboard')) active text-primary fw-bold @else text-dark @endif" href="{{route('dashboard')}}"><i class="fas fa-home me-2"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('profile.edit')) active text-primary fw-bold @else text-dark @endif" href="{{route('profile.edit')}}"><i class="fas fa-user me-2"></i> Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('courses.*')) active text-primary fw-bold @else text-dark @endif" href="#"><i class="fas fa-book me-2"></i> Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('orders.*')) active text-primary fw-bold @else text-dark @endif" href="#"><i class="fas fa-shopping-cart me-2"></i> Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('withdrawals.*')) active text-primary fw-bold @else text-dark @endif" href="#"><i class="fas fa-wallet me-2"></i> Withdrawals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('coupons.*')) active text-primary fw-bold @else text-dark @endif" href="#"><i class="fas fa-tags me-2"></i> Coupons</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('blogs.*')) active text-primary fw-bold @else text-dark @endif" href="#"><i class="fas fa-blog me-2"></i> Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('reviews.*')) active text-primary fw-bold @else text-dark @endif" href="#"><i class="fas fa-star me-2"></i> Reviews</a>
                    </li>
                    <li class="nav-item mt-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link text-danger"><i class="fas fa-sign-out-alt me-2"></i> Sign Out</button>
                        </form>

                    </li>
                </ul>
            </div>

            <!-- Main Dashboard Content -->
            <div class="col-md-9 col-lg-10 p-4">
                @yield('profile')
            </div>
        </div>
    </div>
@endsection
