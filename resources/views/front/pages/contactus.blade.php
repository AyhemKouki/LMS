@extends('front.layout.layout')

@section('content')
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
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

        /* Contact Cards */
        .contact-cards-section {
            padding: 6rem 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        }

        .contact-card {
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

        .contact-card::before {
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

        .contact-card:hover::before {
            transform: scaleX(1);
        }

        .contact-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            background: white;
        }

        .icon-container {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            transition: all 0.4s ease;
        }

        .icon-container img {
            width: 48px;
            height: 48px;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.1));
            transition: all 0.4s ease;
        }

        .contact-card:hover .icon-container {
            transform: scale(1.1) rotate(5deg);
        }

        .contact-card:hover .icon-container img {
            filter: drop-shadow(0 8px 16px rgba(0,0,0,0.2));
        }

        /* Form Section */
        .form-section {
            padding: 6rem 0;
            background: linear-gradient(135deg, #f1f3f4 0%, #e8eaf6 100%);
        }

        .form-container {
            background: white;
            border-radius: 32px;
            padding: 4rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .modern-input {
            border: 2px solid #e9ecef;
            border-radius: 16px;
            padding: 1.2rem 1.5rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
            margin-bottom: 1.5rem;
        }

        .modern-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            background: white;
            transform: translateY(-2px);
        }

        .modern-textarea {
            border: 2px solid #e9ecef;
            border-radius: 16px;
            padding: 1.2rem 1.5rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
            resize: vertical;
            min-height: 120px;
        }

        .modern-textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            background: white;
            transform: translateY(-2px);
        }

        .btn-modern {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 16px;
            padding: 1rem 3rem;
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-modern:hover::before {
            left: 100%;
        }

        .btn-modern:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        }

        /* Map Section */
        .map-section {
            padding: 0;
            background: white;
        }

        .map-container {
            border-radius: 0;
            overflow: hidden;
            position: relative;
        }

        .map-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(102, 126, 234, 0.1), transparent);
            pointer-events: none;
            z-index: 1;
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
            .form-container {
                padding: 2.5rem 1.5rem;
            }
            .contact-card {
                padding: 2rem 1.5rem;
            }
        }
    </style>

    <!-- Hero Section with Gradient Overlay -->
    <section class="py-5 text-center text-white position-relative hero-section" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset('frontend/contactPageAssets/contact-bg.jpg') }}'); background-size: cover; background-position: center; min-height: 350px; display: flex; align-items: center;">
        <div class="container position-relative z-index-1">
            <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeInDown">Get In Touch</h1>
            <p class="lead mb-4 animate__animated animate__fadeInUp">We'd love to hear from you! Contact us for any questions .</p>
            <nav aria-label="breadcrumb" class="animate__animated animate__fadeInUp">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}" class="text-white text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active text-white opacity-75" aria-current="page">Contact Us</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Contact Cards -->
    <section class="contact-cards-section">
        <div class="container">
            <div class="row g-4">
                <!-- Location -->
                <div class="col-md-6 col-lg-3 animate-on-scroll">
                    <div class="contact-card">
                        <div class="icon-container">
                            <img src="{{asset("frontend/contactPageAssets/icons/location-icon.png")}}" alt="Location" width="48">
                        </div>
                        <h5 class="fw-semibold mb-3">Our Location</h5>
                        <p class="text-muted mb-0">Avenue Habib Bourguiba<br>Tunis, Tunisia</p>
                    </div>
                </div>

                <!-- Email -->
                <div class="col-md-6 col-lg-3 animate-on-scroll" style="animation-delay: 0.1s;">
                    <div class="contact-card">
                        <div class="icon-container">
                            <img src="{{asset('frontend/contactPageAssets/icons/email-icon.png')}}" alt="Email" width="48">
                        </div>
                        <h5 class="fw-semibold mb-3">Email Us</h5>
                        <p class="text-muted mb-0">lms@gmail.com<br>lmscompany@gmail.com</p>
                    </div>
                </div>

                <!-- Phone -->
                <div class="col-md-6 col-lg-3 animate-on-scroll" style="animation-delay: 0.2s;">
                    <div class="contact-card">
                        <div class="icon-container">
                            <img src="{{asset('frontend/contactPageAssets/icons/phone-icon.png')}}" alt="Phone" width="48">
                        </div>
                        <h5 class="fw-semibold mb-3">Call Us</h5>
                        <p class="text-muted mb-0">088 6578 654 87<br>088 6548 658 54</p>
                    </div>
                </div>

                <!-- Team -->
                <div class="col-md-6 col-lg-3 animate-on-scroll" style="animation-delay: 0.3s;">
                    <div class="contact-card">
                        <div class="icon-container">
                            <img src="{{asset('frontend/contactPageAssets/icons/team-icon.png')}}" alt="Team" width="48">
                        </div>
                        <h5 class="fw-semibold mb-3">Join Our Team</h5>
                        <p class="text-muted mb-0">Looking for talented individuals to join our growing team.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Clean Contact Form -->
    <section class="form-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 animate-on-scroll">
                    <div class="form-container">
                        <div class="text-center mb-5">
                            <h2 class="fw-bold mb-3">Send a Message</h2>
                            <p class="text-muted">We typically respond within 24 hours</p>
                        </div>

                        <form id="contactForm">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" class="form-control modern-input" placeholder="First Name" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control modern-input" placeholder="Last Name" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control modern-input" placeholder="Email Address" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="tel" class="form-control modern-input" placeholder="Phone Number">
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control modern-input" placeholder="Subject">
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control modern-textarea" rows="4" placeholder="Your Message"></textarea>
                                </div>
                                <div class="col-12 mt-4 text-center">
                                    <button type="submit" class="btn btn-modern btn-lg px-5 py-3">
                                        <i class="fas fa-paper-plane me-2"></i>Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Simple Map Section -->
    <section class="map-section bg-white">
        <div class="container-fluid px-0">
            <div class="map-container">
                <div class="ratio ratio-21x9">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d102239.59408130945!2d10.060877304957428!3d36.794854530729324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12fd337f5e7ef543%3A0xd671924e714a0275!2sTunis!5e0!3m2!1sfr!2stn!4v1749476537401!5m2!1sfr!2stn"
                        style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
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

        // Form submission with modern feedback
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const button = this.querySelector('button[type="submit"]');
            const originalText = button.innerHTML;

            // Loading state
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
            button.disabled = true;

            // Simulate submission
            setTimeout(() => {
                button.innerHTML = '<i class="fas fa-check me-2"></i>Message Sent!';
                button.style.background = 'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)';

                // Reset form
                this.reset();

                // Reset button
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.disabled = false;
                    button.style.background = '(linear-gradient(135deg, #667eea 0%, #764ba2 100%))';
                }, 3000);
            }, 2000);
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
    </script>

@endsection
