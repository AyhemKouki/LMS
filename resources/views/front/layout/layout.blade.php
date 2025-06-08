<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCore</title>
    <!-- Bootstrap CSS -->
    <link href="{{asset("https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css")}}" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            color: #2c3e50;
        }
        .nav-link {
            color: #2c3e50;
            font-weight: 500;
            margin: 0 10px;
        }
        .btn-signin {
            background-color: #0f68c2;
            color: white;
            border-radius: 20px;
            padding: 8px 20px;
            font-weight: 500;
        }
        footer {
            background-color: #2c3e50;
            color: white;
            padding: 50px 0 20px;
        }
        footer h5 {
            font-weight: 600;
            margin-bottom: 20px;
        }
        footer a {
            color: #bdc3c7;
            text-decoration: none;
        }
        footer a:hover {
            color: white;
        }
        .footer-divider {
            border-top: 1px solid rgba(255,255,255,0.1);
            margin: 30px 0;
        }
        .copyright {
            color: #bdc3c7;
            font-size: 0.9rem;
        }

    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">
            <img src="{{asset('images/logo.png')}}">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown">
                        Category
                    </a>
                    <ul class="dropdown-menu">
                        <!-- put category items here like (math , science , web)-->
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Blogs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
            </ul>
        </div>

        <div class="d-flex align-items-center">
            <a href="{{route('login')}}" class="btn btn-signin">Sign In</a>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main class="flex-grow-1">

    <div class="w-full">
            @yield('home-content')
    </div>
</main>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <img src="{{asset("images/logo2.png")}}" alt="">
                <p>Your trusted partner in innovative e-learning solutions, offering interactive courses, expert-led training, and cutting-edge educational tools to empower learners and educators worldwide.</p>
                <div class="mt-3">
                    <h6>Follow Us On</h6>
                    <!-- Social icons would go here -->
                </div>
            </div>
            <div class="col-md-2 mb-4">
                <h5>Help Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#">Courses</a></li>
                    <li><a href="#">About Us</a></li>
                </ul>
            </div>
            <div class="col-md-2 mb-4">
                <h5>More Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#">About Us</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h5>Connect With Us</h5>
                <address>
                    <p>Email us:<br>
                        <a href="mailto:kouki.ayhem@etudiant-fst.utm.tn">kouki.ayhem@etudiant-fst.utm.tn</a></p>
                    <p>Call us:<br>
                        +216 99 999 999</p>
                    <p>Address:<br>
                        07 rue Badis Ibn Mansour</p>
                </address>
            </div>
        </div>
        <div class="footer-divider"></div>
        <div class="text-center copyright">
            <p>Copyright © Educore</p>
        </div>
    </div>
</footer>

<!-- Bootstrap JS and dependencies -->
<script src="{{asset("https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js")}}"></script>
</body>
</html>
