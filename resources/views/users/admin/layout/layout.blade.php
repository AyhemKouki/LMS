<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.5/bootstrap-5.3.5/dist/css/bootstrap.min.css') }}">
    <title>LMS | @yield('title')</title>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-danger navbar-dark">
    <div class="container-fluid">

        <a class="navbar-brand" href="#">Navbar</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">

            <div class="navbar-nav">
                <a class="nav-link" href="#">Home</a>
            </div>

            <div class="navbar-nav">

                <span class="navbar-text">{{ auth()->user()->name }}</span>

                <form action="{{ route('admin.logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-link text-light text-decoration-none">Logout</button>
                </form>
            </div>

        </div>

    </div>
</nav>


@yield('content')


<script src="{{ asset('bootstrap-5.3.5/bootstrap-5.3.5/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
