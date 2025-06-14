<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.5/bootstrap-5.3.5/dist/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>EduCore</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem;
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

            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
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
            <a href="{{route('admin.dashboard')}}" class="sidebar-nav-link ">
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
                <li><a href="{{route('admin.course.index')}}" class="sidebar-nav-dropdown-link">Courses</a></li>
                <li><a href="{{route('admin.category.index')}}" class="sidebar-nav-dropdown-link">Categories</a></li>
            </ul>
        </li>

        <li class="sidebar-nav-item">
            <a href ="{{route('admin.alluser.index')}}" class="sidebar-nav-link " >
                <i class="bi bi-people"></i>
                Users
            </a>
        </li>

        <li class="sidebar-nav-item">
            <a class="sidebar-nav-link sidebar-nav-dropdown-toggle" data-bs-toggle="collapse" href="#RolesManagement" role="button" aria-expanded="false">
                <i class="bi bi-shield-lock"></i>
                <span>Roles/Permissions</span>
            </a>
            <ul class="sidebar-nav-dropdown collapse" id="RolesManagement">
                <li><a href="{{route('admin.role.index')}}" class="sidebar-nav-dropdown-link">Roles</a></li>
                <li><a href="{{route('admin.permission.index')}}" class="sidebar-nav-dropdown-link">Permissions</a></li>
                <li><a href="{{route('admin.user.list')}}" class="sidebar-nav-dropdown-link">Users</a></li>
            </ul>
        </li>
        <li class="sidebar-nav-item mt-auto">
            <form action="{{ route('admin.logout') }}" method="post">
                @csrf
                <button type="submit" class="sidebar-nav-link w-100 text-start border-0 bg-transparent">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sign out</span>
                </button>
            </form>
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
                <div class="d-flex align-items-center text-decoration-none">
                    <div class="user-avatar">
                        @if(auth()->user()->profile_image)
                            <img src="{{ auth()->user()->profile_image }}" alt="{{ auth()->user()->name }}"
                                 class="rounded-circle" width="40" height="40">
                        @else
                            {{ substr(auth()->user()->name, 0, 1) }}
                        @endif
                    </div>
                    <div class="me-2">
                        <div class="fw-bold">{{ auth()->user()->name }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @yield('content')
</div>

<script src="{{ asset('bootstrap-5.3.5/bootstrap-5.3.5/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
