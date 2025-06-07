<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.5/bootstrap-5.3.5/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>EduCore</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
        }

        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #1a1f2b;
            color: #fff;
            transition: all 0.3s;
            z-index: 1000;
        }

        .sidebar-brand {
            padding: 1.5rem 1rem;
            font-size: 1.2rem;
            font-weight: 600;
            color: #fff;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand i {
            margin-right: 10px;
            color: #4e66e3;
        }

        .sidebar-nav {
            padding: 0;
            list-style: none;
        }

        .sidebar-nav-item {
            position: relative;
        }

        .sidebar-nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: all 0.3s;
        }

        .sidebar-nav-link:hover, .sidebar-nav-link.active {
            color: #fff;
            background-color: #2a3347;
        }

        .sidebar-nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .sidebar-nav-dropdown {
            list-style: none;
            padding: 0;
            background-color: rgba(0,0,0,0.2);
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .sidebar-nav-dropdown.show {
            max-height: 500px;
        }

        .sidebar-nav-dropdown-link {
            display: block;
            padding: 0.5rem 1.5rem 0.5rem 3.5rem;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            transition: all 0.3s;
        }

        .sidebar-nav-dropdown-link:hover {
            color: #fff;
        }

        .sidebar-nav-dropdown-toggle::after {
            content: '\F282';
            font-family: 'bootstrap-icons';
            display: inline-block;
            margin-left: auto;
            transition: transform 0.3s;
        }

        .sidebar-nav-dropdown-toggle[aria-expanded="true"]::after {
            transform: rotate(90deg);
        }

        .main-content {
            margin-left: 280px;
            padding: 20px;
            transition: all 0.3s;
        }

        .header {
            background-color: #fff;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #4e66e3;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 10px;
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-brand">
        <i class="bi bi-mortarboard-fill"></i>
        <span>EduCore Admin</span>
    </div>

    <ul class="sidebar-nav">
        <li class="sidebar-nav-item">
            <a href="{{route('admin.dashboard')}}" class="sidebar-nav-link active">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="sidebar-nav-item">
            <a href="#" class="sidebar-nav-link">
                <i class="bi bi-person-vcard"></i>
                <span>Instructor Requests</span>
            </a>
        </li>

        <li class="sidebar-nav-item">
            <a class="sidebar-nav-link sidebar-nav-dropdown-toggle" data-bs-toggle="collapse" href="#courseManagement" role="button" aria-expanded="false">
                <i class="bi bi-book"></i>
                <span>Course Management</span>
            </a>
            <ul class="sidebar-nav-dropdown collapse" id="courseManagement">
                <li><a href="#" class="sidebar-nav-dropdown-link">All Courses</a></li>
                <li><a href="#" class="sidebar-nav-dropdown-link">Add New Course</a></li>
                <li><a href="{{route('admin.category.index')}}" class="sidebar-nav-dropdown-link">Categories</a></li>
            </ul>
        </li>

        <li class="sidebar-nav-item">
            <a class="sidebar-nav-link sidebar-nav-dropdown-toggle" data-bs-toggle="collapse" href="#userManagement" role="button" aria-expanded="false">
                <i class="bi bi-people"></i>
                <span>Users/Admins</span>
            </a>
            <ul class="sidebar-nav-dropdown collapse" id="userManagement">
                <li><a href="#" class="sidebar-nav-dropdown-link">All Users</a></li>
                <li><a href="#" class="sidebar-nav-dropdown-link">Admins</a></li>
                <li><a href="#" class="sidebar-nav-dropdown-link">Instructors</a></li>
            </ul>
        </li>

        <li class="sidebar-nav-item">
            <a href="#" class="sidebar-nav-link">
                <i class="bi bi-gear"></i>
                <span>Settings</span>
            </a>
        </li>
    </ul>
</div>

<!-- Main Content -->
<div class="main-content">
    <!-- Header -->
    <div class="header">
        <div class="d-flex align-items-center">
            <button class="btn btn-sm btn-outline-secondary me-2 d-lg-none" data-bs-toggle="collapse" data-bs-target=".sidebar">
                <i class="bi bi-list"></i>
            </button>
            <h4 class="mb-0">@yield('title')</h4>
        </div>
        <div class="d-flex align-items-center">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="user-avatar">
                        @if(auth()->user()->profile_image)
                            <img src="{{ auth()->user()->profile_image }}" alt="{{ auth()->user()->name }}" class="rounded-circle" width="40" height="40">
                        @else
                            {{ substr(auth()->user()->name, 0, 1) }}
                        @endif
                    </div>
                    <div class="me-2">
                        <div class="fw-bold">{{ auth()->user()->name }}</div>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                    <li>
                        <form action="{{ route('admin.logout') }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    @yield('content')
</div>

<script src="{{ asset('bootstrap-5.3.5/bootstrap-5.3.5/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
