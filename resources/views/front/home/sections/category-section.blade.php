<section class="category-section bg-light py-5">

    <section class="category-section position-relative py-5" style="
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    overflow: hidden;">
        <style>
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes slideInScale {
                from {
                    opacity: 0;
                    transform: scale(0.8) translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: scale(1) translateY(0);
                }
            }

            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }

            .category-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
                animation: float 6s ease-in-out infinite;
            }

            .header-content {
                animation: fadeInUp 0.8s ease-out;
            }

            .category-card {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 20px;
                transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                animation: slideInScale 0.6s ease-out forwards;
                opacity: 0;
                overflow: hidden;
                position: relative;
            }

            .category-card:nth-child(1) { animation-delay: 0.1s; }
            .category-card:nth-child(2) { animation-delay: 0.2s; }
            .category-card:nth-child(3) { animation-delay: 0.3s; }
            .category-card:nth-child(4) { animation-delay: 0.4s; }
            .category-card:nth-child(5) { animation-delay: 0.5s; }
            .category-card:nth-child(6) { animation-delay: 0.6s; }

            .category-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
                transition: left 0.5s;
            }

            .category-card:hover::before {
                left: 100%;
            }

            .category-card:hover {
                transform: translateY(-10px) scale(1.02);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
                border-color: rgba(255, 255, 255, 0.4);
            }

            .card-img-top {
                height: 200px;
                object-fit: cover;
                transition: transform 0.4s ease;
                border-radius: 15px 15px 0 0;
            }

            .category-card:hover .card-img-top {
                transform: scale(1.1);
            }

            .card-body {
                padding: 1.5rem;
            }

            .card-title {
                font-weight: 700;
                color: #2d3748;
                margin-bottom: 0.75rem;
                font-size: 1.25rem;
            }

            .card-text {
                color: #718096;
                line-height: 1.6;
                margin-bottom: 1.5rem;
            }

            .btn-modern {
                background: linear-gradient(135deg, #56ccf2 0%, #2f80ed 100%);
                border: none;
                border-radius: 50px;
                padding: 0.75rem 2rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                position: relative;
                overflow: hidden;
                transition: all 0.3s ease;
            }

            .btn-modern::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, #2f80ed 0%,  #56ccf2 100%);
                transition: left 0.3s ease;
                z-index: 0;
            }

            .btn-modern:hover::before {
                left: 0;
            }

            .btn-modern:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
            }

            .btn-modern span {
                position: relative;
                z-index: 1;
            }

            .section-title {
                font-size: 3.5rem;
                font-weight: 800;
                background: linear-gradient(135deg, #ffffff 0%, #f7fafc 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                margin-bottom: 1rem;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .section-subtitle {
                color: rgba(255, 255, 255, 0.9);
                font-size: 1.25rem;
                font-weight: 300;
                letter-spacing: 0.5px;
            }

            .floating-shapes {
                position: absolute;
                width: 100%;
                height: 100%;
                overflow: hidden;
                z-index: 1;
            }

            .shape {
                position: absolute;
                opacity: 0.1;
                animation: float 8s ease-in-out infinite;
            }

            .shape:nth-child(1) {
                top: 20%;
                left: 10%;
                animation-delay: 0s;
            }

            .shape:nth-child(2) {
                top: 60%;
                right: 10%;
                animation-delay: 2s;
            }

            .shape:nth-child(3) {
                bottom: 20%;
                left: 20%;
                animation-delay: 4s;
            }

            @media (max-width: 768px) {
                .section-title {
                    font-size: 2.5rem;
                }
                .category-card {
                    margin-bottom: 2rem;
                }
            }
        </style>

        <div class="floating-shapes">
            <div class="shape">
                <i class="fas fa-graduation-cap" style="font-size: 3rem; color: white;"></i>
            </div>
            <div class="shape">
                <i class="fas fa-book" style="font-size: 2.5rem; color: white;"></i>
            </div>
            <div class="shape">
                <i class="fas fa-lightbulb" style="font-size: 3.5rem; color: white;"></i>
            </div>
        </div>

        <div class="container position-relative" style="z-index: 2;">
            <div class="row mb-5">
                <div class="col-12 text-center header-content">
                    <h2 class="section-title">Categories</h2>
                    <p class="section-subtitle">Explore our diverse range of categories</p>
                </div>
            </div>
            <div class="row g-4">
                <!-- Sample categories with demo data -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card category-card h-100 border-0">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Programming">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-code me-2" style="color: #667eea;"></i>
                                Programming
                            </h5>
                            <p class="card-text">Master the art of coding with our comprehensive programming courses covering multiple languages and frameworks.</p>
                            <button class="btn btn-modern">
                                <span>View Courses</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card category-card h-100 border-0">
                        <img src="{{asset("images/design-image.jpg")}}" class="card-img-top" alt="Design">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-palette me-2" style="color: #764ba2;"></i>
                                Design
                            </h5>
                            <p class="card-text">Unleash your creativity with our design courses covering UI/UX, graphic design, and digital art fundamentals.</p>
                            <button class="btn btn-modern">
                                <span>View Courses</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card category-card h-100 border-0">
                        <img src="{{asset("images/business-image.jpg")}}" class="card-img-top" alt="Business">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-chart-line me-2" style="color: #4facfe;"></i>
                                Business
                            </h5>
                            <p class="card-text">Develop essential business skills including marketing, finance, and entrepreneurship to grow your career.</p>
                            <button class="btn btn-modern">
                                <span>View Courses</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card category-card h-100 border-0">
                        <img src="{{asset("images/photography-image.jpg")}}" class="card-img-top" alt="Photography">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-camera me-2" style="color: #f5576c;"></i>
                                Photography
                            </h5>
                            <p class="card-text">Capture stunning images and learn professional photography techniques from composition to post-processing.</p>
                            <button class="btn btn-modern">
                                <span>View Courses</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card category-card h-100 border-0">
                        <img src="{{asset("images/music-image.jpg")}}" class="card-img-top" alt="Music">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-music me-2" style="color: #667eea;"></i>
                                Music
                            </h5>
                            <p class="card-text">Learn to play instruments, understand music theory, and create your own compositions with expert guidance.</p>
                            <button class="btn btn-modern">
                                <span>View Courses</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card category-card h-100 border-0">
                        <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Language">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-globe me-2" style="color: #764ba2;"></i>
                                Languages
                            </h5>
                            <p class="card-text">Expand your horizons by learning new languages with interactive lessons and cultural immersion experiences.</p>
                            <button class="btn btn-modern">
                                <span>View Courses</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</section>
