@extends('front.layout.layout')

@section('content')
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(102, 126, 234, 0.8));
            background-size: cover;
            background-position: center;
            min-height: 400px;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="%23ffffff08" points="0,0 1000,200 1000,1000 0,800"/></svg>');
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateX(0px); }
            50% { transform: translateX(30px); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .breadcrumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            backdrop-filter: blur(10px);
        }

        .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.9) !important;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumb-item a:hover {
            color: white !important;
        }

        /* Stats Cards */
        .stats-section {
            padding: 6rem 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            padding: 3rem 2rem;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .stat-card:hover::before {
            transform: scaleX(1);
        }

        .stat-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            background: white;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        /* About Content */
        .about-section {
            padding: 6rem 0;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        }

        .about-card {
            background: white;
            border-radius: 32px;
            padding: 4rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .about-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        /* Team Section */
        .team-section {
            padding: 6rem 0;
            background: linear-gradient(135deg, #f1f3f4 0%, #e8eaf6 100%);
        }

        .team-card {
            background: white;
            border-radius: 24px;
            padding: 2.5rem 2rem;
            text-align: center;
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .team-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .team-card:hover::before {
            transform: scaleX(1);
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .team-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            border: 4px solid #f8f9fa;
            transition: all 0.4s ease;
        }

        .team-card:hover .team-avatar {
            transform: scale(1.1);
            border-color: #667eea;
        }

        /* Values Section */
        .values-section {
            padding: 6rem 0;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        }

        .value-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 2.5rem;
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .value-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .value-card:hover::before {
            transform: scaleX(1);
        }

        .value-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            background: white;
        }

        .value-icon {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            transition: all 0.4s ease;
        }

        .value-icon i {
            font-size: 2rem;
            color: white;
        }

        .value-card:hover .value-icon {
            transform: scale(1.1) rotate(5deg);
        }

        /* CTA Section */
        .cta-section {
            background: #667eea;
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><circle fill="%23ffffff08" cx="200" cy="200" r="250"/><circle fill="%23ffffff05" cx="800" cy="600" r="300"/></svg>');
        }

        /* Animations */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .animate-on-scroll.animate {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-section {
                min-height: 300px;
            }
            .about-card {
                padding: 2.5rem 1.5rem;
            }
            .stat-card, .team-card, .value-card {
                padding: 2rem 1.5rem;
            }
            .stat-number {
                font-size: 2.5rem;
            }
        }
    </style>

    <!-- Hero Section -->
    <section class="py-5 text-center text-white position-relative hero-section" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset('frontend/contactPageAssets/contact-bg.jpg') }}'); background-size: cover; background-position: center; min-height: 350px; display: flex; align-items: center;">
        <div class="container position-relative z-index-1">
            <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeInDown">About Our Company</h1>
            <p class="lead mb-4 animate__animated animate__fadeInUp">Discover our story, mission, and the passionate team behind our success.</p>
            <nav aria-label="breadcrumb" class="animate__animated animate__fadeInUp">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}" class="text-white text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active text-white opacity-75" aria-current="page">About Us</li>
                </ol>
            </nav>
        </div>
    </section>


<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="row g-4">
            <!-- Years in Education -->
            <div class="col-md-6 col-lg-3 animate-on-scroll">
                <div class="stat-card">
                    <div class="stat-number">10+</div>
                    <h5 class="fw-semibold mb-2">Years in Education</h5>
                    <p class="text-muted mb-0">Transforming learning since 2013</p>
                </div>
            </div>

            <!-- Courses Available -->
            <div class="col-md-6 col-lg-3 animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="stat-card">
                    <div class="stat-number">1000+</div>
                    <h5 class="fw-semibold mb-2">Courses Available</h5>
                    <p class="text-muted mb-0">Diverse learning materials for all levels</p>
                </div>
            </div>

            <!-- Active Learners -->
            <div class="col-md-6 col-lg-3 animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="stat-card">
                    <div class="stat-number">50,000+</div>
                    <h5 class="fw-semibold mb-2">Active Learners</h5>
                    <p class="text-muted mb-0">Students advancing their skills daily</p>
                </div>
            </div>

            <!-- Certified Instructors -->
            <div class="col-md-6 col-lg-3 animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="stat-card">
                    <div class="stat-number">200+</div>
                    <h5 class="fw-semibold mb-2">Certified Instructors</h5>
                    <p class="text-muted mb-0">Expert educators guiding your journey</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Content Section -->
<section class="about-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 animate-on-scroll">
                <div class="about-card">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h2 class="fw-bold mb-4">Our Educational Journey</h2>
                            <p class="text-muted mb-4">
                                Established in 2013, our learning platform began with a vision to democratize education through technology. What started as a small e-learning initiative has grown into a comprehensive learning ecosystem serving thousands of students worldwide.
                            </p>
                            <p class="text-muted mb-4">
                                Our foundation was built on a simple principle: to make quality education accessible, engaging, and effective for everyone. Today, we continue to innovate while staying true to our core mission of transforming lives through learning.
                            </p>
                            <div class="d-flex gap-3 flex-wrap">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span>Accredited Courses</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span>24/7 Learning Access</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span>Interactive Content</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span>Expert Instructors</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span>Progress Tracking</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span>Mobile Friendly</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <img src="{{asset("images/ourJourney.png")}}" alt="Our Journey" class="img-fluid rounded-3 ">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Education Team Section -->
    <section class="team-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5 animate-on-scroll">
                <h2 class="fw-bold mb-3">Meet Our Education Experts</h2>
                <p class="text-muted fs-5">The passionate educators and technologists shaping modern learning</p>
            </div>

            <div class="row g-4">
                <!-- Academic Director -->
                <div class="col-lg-3 col-md-6 animate-on-scroll">
                    <div class="team-card bg-white rounded-3 shadow-sm p-4 text-center h-100">
                        <img src="{{asset('frontend/team/teamMember1.jpg')}}" alt="Dr. Emily Chen" class="team-avatar rounded-circle mb-3">
                        <h5 class="fw-bold mb-2">Dr. Emily Chen</h5>
                        <p class="text-primary mb-3">Academic Director</p>
                        <p class="text-muted small mb-3">Former university professor with 15+ years in curriculum development and pedagogy.</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="#" class="btn btn-sm btn-outline-primary rounded-circle" style="width: 40px; height: 40px;">
                                <i class="fas fa-graduation-cap"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-primary rounded-circle" style="width: 40px; height: 40px;">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CTO -->
                <div class="col-lg-3 col-md-6 animate-on-scroll" style="animation-delay: 0.1s;">
                    <div class="team-card bg-white rounded-3 shadow-sm p-4 text-center h-100">
                        <img src="{{asset('frontend/team/teamMember2.png')}}" alt="Raj Patel" class="team-avatar rounded-circle mb-3">
                        <h5 class="fw-bold mb-2">Raj Patel</h5>
                        <p class="text-primary mb-3">Chief Technology Officer</p>
                        <p class="text-muted small mb-3">EdTech specialist focused on creating accessible, engaging learning platforms.</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="#" class="btn btn-sm btn-outline-primary rounded-circle" style="width: 40px; height: 40px;">
                                <i class="fab fa-github"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-primary rounded-circle" style="width: 40px; height: 40px;">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Lead Instructional Designer -->
                <div class="col-lg-3 col-md-6 animate-on-scroll" style="animation-delay: 0.2s;">
                    <div class="team-card bg-white rounded-3 shadow-sm p-4 text-center h-100">
                        <img src="{{asset('frontend/team/teamMember3.jpg')}}" alt="Maria Gonzalez" class="team-avatar rounded-circle mb-3">
                        <h5 class="fw-bold mb-2">Maria Gonzalez</h5>
                        <p class="text-primary mb-3">Lead Instructional Designer</p>
                        <p class="text-muted small mb-3">Expert in creating interactive, learner-centered course experiences.</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="#" class="btn btn-sm btn-outline-primary rounded-circle" style="width: 40px; height: 40px;">
                                <i class="fas fa-book-open"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-primary rounded-circle" style="width: 40px; height: 40px;">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Student Success Manager -->
                <div class="col-lg-3 col-md-6 animate-on-scroll" style="animation-delay: 0.3s;">
                    <div class="team-card bg-white rounded-3 shadow-sm p-4 text-center h-100">
                        <img src="{{asset('frontend/team/teamMember4.jpg')}}" alt="David Kim" class="team-avatar rounded-circle mb-3">
                        <h5 class="fw-bold mb-2">David Kim</h5>
                        <p class="text-primary mb-3">Student Success Manager</p>
                        <p class="text-muted small mb-3">Dedicated to ensuring every learner achieves their educational goals.</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="#" class="btn btn-sm btn-outline-primary rounded-circle" style="width: 40px; height: 40px;">
                                <i class="fas fa-hands-helping"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-primary rounded-circle" style="width: 40px; height: 40px;">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5 animate-on-scroll">
                <h2 class="fw-bold mb-3">Our Educational Values</h2>
                <p class="text-muted fs-5">The principles that guide our learning philosophy</p>
            </div>

            <div class="row g-4">
                <!-- Learning Excellence -->
                <div class="col-lg-4 col-md-6 animate-on-scroll">
                    <div class="value-card bg-white rounded-3 shadow-sm p-4 text-center h-100">
                        <div class="value-icon mx-auto rounded-circle d-flex align-items-center justify-content-center mb-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); width: 80px; height: 80px;">
                            <i class="fas fa-graduation-cap text-white fs-4"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Learning Excellence</h5>
                        <p class="text-muted">We're committed to delivering the highest quality educational content that's engaging, effective, and accessible to all learners.</p>
                    </div>
                </div>

                <!-- Student Success -->
                <div class="col-lg-4 col-md-6 animate-on-scroll" style="animation-delay: 0.1s;">
                    <div class="value-card bg-white rounded-3 shadow-sm p-4 text-center h-100">
                        <div class="value-icon mx-auto rounded-circle d-flex align-items-center justify-content-center mb-3" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); width: 80px; height: 80px;">
                            <i class="fas fa-user-graduate text-white fs-4"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Student Success</h5>
                        <p class="text-muted">Every decision we make is guided by what's best for our learners' growth, achievement, and long-term development.</p>
                    </div>
                </div>

                <!-- Innovation in Education -->
                <div class="col-lg-4 col-md-6 animate-on-scroll" style="animation-delay: 0.2s;">
                    <div class="value-card bg-white rounded-3 shadow-sm p-4 text-center h-100">
                        <div class="value-icon mx-auto rounded-circle d-flex align-items-center justify-content-center mb-3" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); width: 80px; height: 80px;">
                            <i class="fas fa-lightbulb text-white fs-4"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Innovation in Education</h5>
                        <p class="text-muted">We continuously explore new teaching methods and technologies to enhance the learning experience.</p>
                    </div>
                </div>

                <!-- Accessibility -->
                <div class="col-lg-4 col-md-6 animate-on-scroll" style="animation-delay: 0.3s;">
                    <div class="value-card bg-white rounded-3 shadow-sm p-4 text-center h-100">
                        <div
                            class="value-icon mx-auto rounded-circle d-flex align-items-center justify-content-center mb-3"
                            style="background: linear-gradient(135deg, #43c6ac 0%, #191654 100%); width: 80px; height: 80px;">
                        <i class="fas fa-door-open text-white fs-4"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Accessibility</h5>
                        <p class="text-muted">We believe education should be available to everyone, regardless of background, ability, or location.</p>
                    </div>
                </div>

                <!-- Community -->
                <div class="col-lg-4 col-md-6 animate-on-scroll" style="animation-delay: 0.4s;">
                    <div class="value-card bg-white rounded-3 shadow-sm p-4 text-center h-100">
                        <div class="value-icon mx-auto rounded-circle d-flex align-items-center justify-content-center mb-3" style="background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%); width: 80px; height: 80px;">
                            <i class="fas fa-users text-white fs-4"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Learning Community</h5>
                        <p class="text-muted">We foster collaborative environments where learners and educators support each other's growth.</p>
                    </div>
                </div>

                <!-- Continuous Improvement -->
                <div class="col-lg-4 col-md-6 animate-on-scroll" style="animation-delay: 0.5s;">
                    <div class="value-card bg-white rounded-3 shadow-sm p-4 text-center h-100">
                        <div class="value-icon mx-auto rounded-circle d-flex align-items-center justify-content-center mb-3" style="background: linear-gradient(135deg, #d4fc79 0%, #96e6a1 100%); width: 80px; height: 80px;">
                            <i class="fas fa-chart-line text-white fs-4"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Continuous Improvement</h5>
                        <p class="text-muted">We regularly evaluate and enhance our courses and platform based on learner feedback and educational research.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section py-5 text-center position-relative" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container position-relative" style="z-index: 2;">
            <div class="animate-on-scroll">
                <h3 class="fw-bold mb-4 text-white">Ready to Transform Learning?</h3>
                <p class="fs-5 mb-4 text-white-75">Discover how our platform can enhance your educational experience.</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="#" class="btn btn-light btn-lg px-4 rounded-pill">
                        <i class="fas fa-chalkboard-teacher me-2"></i>Start Teaching
                    </a>
                    <a href="#" class="btn btn-outline-light btn-lg px-4 rounded-pill">
                        <i class="fas fa-book-open me-2"></i>Explore Courses
                    </a>
                </div>
            </div>
        </div>
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: url('{{ asset('frontend/contactPageAssets/learning-pattern.png') }}') no-repeat center center; background-size: cover; opacity: 0.05; z-index: 1;"></div>
    </section>

<script>
    // Scroll animation observer
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });

    // Add smooth scrolling for any anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Counter animation for stats
    function animateCounter(element, target, duration = 2000) {
        let start = 0;
        const increment = target / (duration / 16);

        function updateCounter() {
            start += increment;
            if (start < target) {
                element.textContent = Math.floor(start) + '+';
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target + '+';
            }
        }

        updateCounter();
    }

    // Trigger counter animations when stats section is visible
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const statNumbers = entry.target.querySelectorAll('.stat-number');
                statNumbers.forEach(stat => {
                    const target = parseInt(stat.textContent);
                    animateCounter(stat, target);
                });
                statsObserver.unobserve(entry.target);
            }
        });
    });

    const statsSection = document.querySelector('.stats-section');
    if (statsSection) {
        statsObserver.observe(statsSection);
    }
</script>

@endsection
