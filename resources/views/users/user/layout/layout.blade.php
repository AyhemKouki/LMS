@extends('front.layout.layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 bg-white shadow-sm p-3 min-vh-100">
                <!-- Profile Card -->
                <div class="text-center mb-4">
                    @if(auth()->user()->profile_image == "/images/avatar.jpg")
                        <img src="{{ asset(auth()->user()->profile_image)}}" class="rounded-circle" width="80" height="80" alt="Avatar">
                    @else
                        <img src="{{ asset('storage/'. auth()->user()->profile_image)}}" class="rounded-circle" width="80" height="80" alt="Avatar">
                    @endif

                    <h5 class="mt-2 mb-0">{{auth()->user()->name}}</h5>
                    <small class="text-muted">
                        @if(auth()->user()->hasRole('admin'))
                            Administrator
                        @elseif(auth()->user()->hasRole('instructor'))
                            Instructor
                        @elseif(auth()->user()->hasRole('student'))
                            Student
                        @else
                            {{auth()->user()->role}}
                        @endif
                    </small>
                </div>

                <!-- Sidebar Links -->
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('dashboard')) active text-primary fw-bold @else text-dark @endif" href="{{route('dashboard')}}"><i class="fas fa-home me-2"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('profile.edit')) active text-primary fw-bold @else text-dark @endif" href="{{route('profile.edit')}}"><i class="fas fa-user me-2"></i> Profile</a>
                    </li>
                    @can('OnlyInstructor')
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('courses.*')) active text-primary fw-bold @else text-dark @endif"
                               href="{{route('courses.index')}}"><i class="fas fa-book me-2"></i> Courses</a>
                        </li>
                    @endcan

                    @can('OnlyInstructorLesson')
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('lesson.*')) active text-primary fw-bold @else text-dark @endif"
                               href="{{route('lesson.index')}}"><i class="fas fa-chalkboard me-2"></i> Lessons</a>
                        </li>
                    @endcan

                    @if(auth()->user()->role == 'student')
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('courses.*')) active text-primary fw-bold @else text-dark @endif"
                               href="{{route('courses.mycourses')}}"><i class="fas fa-book me-2"></i> My Courses</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('orders.*')) active text-primary fw-bold @else text-dark @endif" href="{{route('orders.index')}}"><i class="fas fa-shopping-cart me-2"></i> Orders</a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('rooms-table')) active text-primary fw-bold @else text-dark @endif" href="{{route('rooms-table')}}"><i class="fas fa-wallet me-2"></i> Rooms</a>
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
                    @if(!auth()->user()->hasRole('instructor'))
                        @if(!auth()->user()->instructorRequest || auth()->user()->instructorRequest->status === 'rejected')
                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('instructor.request.create')) active text-primary fw-bold @else text-dark @endif"
                                   href="{{ route('instructor.request.create') }}">
                                    <i class="fas fa-chalkboard-teacher me-2"></i> Become Instructor
                                </a>
                            </li>
                        @endif
                    @endif
                    @if(auth()->user()->instructorRequest && auth()->user()->instructorRequest->status === 'pending')
                    <li class="nav-item">
                        <span class="nav-link text-warning">
                                <i class="fas fa-clock me-2"></i> Instructor Request Pending
                            </span>
                        </li>
                    @endif
                    <li class="nav-item mt-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link text-danger"><i class="fas fa-sign-out-alt me-2"></i> Sign Out</button>
                        </form>

                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 p-4 ">
                @yield('profile')
                @yield('course_content')
                @yield('content2')
            </div>
        </div>
    </div>
@endsection
