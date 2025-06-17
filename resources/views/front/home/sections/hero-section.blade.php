<style>
    .hero-section {
        background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.8) 100%),
                    url('{{ asset("frontend/assets/home-bg.png") }}') no-repeat center center;
        background-size: cover;
        min-height: 90vh;
        position: relative;
        overflow: visible;
        padding-bottom: 150px;
    }

    .small-logo {
        position: absolute;
        top: 30px;
        right: 30px;
        width: 90px;
        opacity: 0.9;
        transition: transform 0.3s ease;
    }

    .small-logo:hover {
        transform: scale(1.1);
    }

    .wave-shape {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 70%;
        z-index: 2;

    }

    .student-image {
        position: relative;
        z-index: 2;
        max-height: 85vh;
        margin-bottom: -50px;
        filter: drop-shadow(0 10px 20px rgba(0,0,0,0.15));
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-20px) rotate(1deg);
        }
        100% {
            transform: translateY(0px);
        }
    }

    .hero-content {
        padding-top: 160px;
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-size: 4rem;
        font-weight: 800;
        color: #2c3e50;
        margin-bottom: 1.8rem;
        line-height: 1.2;
        position: relative;
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: fadeInUp 1s ease-out;
    }

    .hero-text {
        font-size: 1.25rem;
        color: #555;
        margin-bottom: 2.5rem;
        line-height: 1.8;
        max-width: 600px;
        animation: fadeInUp 1s ease-out 0.2s backwards;
    }

    .cta-button {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: white;
        padding: 18px 45px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        animation: fadeInUp 1s ease-out 0.4s backwards;
    }

    .cta-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        color: white;
        background: linear-gradient(135deg,  #2a5298 0% , #1e3c72 100%);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Decorative elements */
    .hero-shapes {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 1;
    }

    .shape {
        position: absolute;
        border-radius: 50%;
        background: linear-gradient(45deg, rgba(52, 152, 219, 0.1), rgba(44, 62, 80, 0.1));
    }

    .shape-1 {
        width: 300px;
        height: 300px;
        top: -150px;
        right: 10%;
    }

    .shape-2 {
        width: 200px;
        height: 200px;
        bottom: 50px;
        left: 10%;
    }

    @media (max-width: 991px) {
        .hero-title {
            font-size: 3rem;
        }

        .hero-content {
            padding-top: 120px;
            text-align: center;
        }

        .hero-text {
            margin: 0 auto 2.5rem;
        }

        .student-image {
            max-height: 60vh;
            margin: 40px auto -30px;
        }
    }

    @media (max-width: 768px) {
        .hero-section {
            min-height: auto;
            padding-bottom: 100px;
        }

        .hero-title {
            font-size: 2.5rem;
        }

        .hero-text {
            font-size: 1.1rem;
        }

        .cta-button {
            padding: 15px 35px;
            font-size: 1rem;
        }

        .shape-1, .shape-2 {
            display: none;
        }
    }
</style>

<section class="hero-section">
    <div class="hero-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
    </div>
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
