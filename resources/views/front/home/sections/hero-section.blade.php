<style>
    .hero-section {
        background: url('{{ asset("frontend/assets/home-bg.png") }}') no-repeat center center;
        background-size: cover;
        min-height: 85vh;
        position: relative;
        overflow: hidden;
    }

    .small-logo {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 80px;
        opacity: 0.8;
    }

    .wave-shape {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 70%;
        z-index: 3;
    }

    .student-image {
        position: relative;
        z-index: 2;
        max-height: 80vh;
        margin-bottom: -50px;
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-20px);
        }
        100% {
            transform: translateY(0px);
        }
    }

    .hero-content {
        padding-top: 150px;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1.5rem;
    }

    .hero-text {
        font-size: 1.2rem;
        color: #666;
        margin-bottom: 2rem;
    }

    .cta-button {
        background: linear-gradient(45deg, #2c3e50, #3498db);
        color: white;
        padding: 15px 40px;
        border-radius: 30px;
        font-weight: 600;
        text-decoration: none;
        transition: transform 0.3s ease;
    }

    .cta-button:hover {
        transform: translateY(-3px);
        color: white;
    }
</style>

<section class="hero-section">
    <img src="{{ asset('frontend/assets/small-logo.png') }}" alt="Small Logo" class="small-logo">
    <div class="content-wrapper">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <h1 class="hero-title">Unlock Your Learning Potential</h1>
                    <p class="hero-text">Join our platform to access high-quality courses, expert instructors, and a
                        supportive learning community. Start your educational journey today!</p>
                    <a href="#courses" class="cta-button">Explore Courses</a>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('frontend/assets/student-img.png') }}" alt="Student" class="student-image">
                </div>
            </div>
        </div>
    </div>
    <img src="{{ asset('frontend/assets/wave-shape.png') }}" alt="Wave Shape" class="wave-shape">
</section>
