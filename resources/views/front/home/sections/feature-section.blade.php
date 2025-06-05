<!-- feature-section.blade.php -->
<style>
    .features-section {
        padding: 100px 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        position: relative;
        z-index: 1;
    }

    .section-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .section-header h2 {
        font-size: 2.8rem;
        color: #2c3e50;
        margin-bottom: 20px;
        font-weight: 700;
        position: relative;
        display: inline-block;
    }

    .section-header h2:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(45deg, #3498db, #2ecc71);
        border-radius: 2px;
    }

    .section-header p {
        color: #666;
        font-size: 1.2rem;
        max-width: 600px;
        margin: 20px auto 0;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        padding: 20px;
    }

    .feature-card {
        background: white;
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }

    .feature-icon {
        width: 110px;
        height: 110px;
        background: #f8f9fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        position: relative;
        z-index: 1;
        transition: all 0.3s ease;
    }

    .feature-icon:after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 2px dashed #e1e1e1;
        top: 0;
        left: 0;
        animation: spin 20s linear infinite;
    }

    @keyframes spin {
        100% {
            transform: rotate(360deg);
        }
    }

    .feature-icon img {
        width: 55px;
        height: 55px;
        transition: transform 0.3s ease;
    }

    .feature-content h4 {
        font-size: 1.4rem;
        color: #2c3e50;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .feature-content p {
        color: #666;
        font-size: 1rem;
        line-height: 1.6;
        margin: 0;
    }

    /* Feature card variants */
    .feature-card.green:hover {
        background: linear-gradient(135deg, #2ecc71, #27ae60);
    }

    .feature-card.pink:hover {
        background: linear-gradient(135deg, #e84393, #d63031);
    }

    .feature-card.sky:hover {
        background: linear-gradient(135deg, #3498db, #2980b9);
    }

    .feature-card:hover {
        transform: translateY(-10px);
    }

    .feature-card:hover .feature-icon {
        background: rgba(255, 255, 255, 0.9);
        transform: scale(1.1);
    }

    .feature-card:hover .feature-icon img {
        transform: scale(1.1);
    }

    .feature-card:hover .feature-content h4,
    .feature-card:hover .feature-content p {
        color: white;
    }

    @media (max-width: 768px) {
        .features-section {
            padding: 60px 0;
        }

        .section-header h2 {
            font-size: 2.2rem;
        }

        .features-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .feature-card {
            padding: 30px 20px;
        }
    }
</style>

<section class="features-section">
    <div class="container">
        <div class="section-header">
            <h2>Why Choose Us</h2>
            <p>Discover the unique features that make our platform the perfect choice for your learning journey</p>
        </div>
        <div class="features-grid">
            <div class="feature-card green wow fadeInUp" data-wow-delay="0.1s">
                <div class="feature-icon">
                    <img src="{{ asset('frontend/assets/feature1.png') }}" alt="Expert Teachers">
                </div>
                <div class="feature-content">
                    <h4>Expert Teachers</h4>
                    <p>Learn from industry experts and experienced educators who are passionate about helping you succeed</p>
                </div>
            </div>
            <div class="feature-card pink wow fadeInUp" data-wow-delay="0.3s">
                <div class="feature-icon">
                    <img src="{{ asset('frontend/assets/feature2.png') }}" alt="Easy Communication">
                </div>
                <div class="feature-content">
                    <h4>Easy Communication</h4>
                    <p>Stay connected with instructors and peers through our intuitive communication platform</p>
                </div>
            </div>
            <div class="feature-card sky wow fadeInUp" data-wow-delay="0.5s">
                <div class="feature-icon">
                    <img src="{{ asset('frontend/assets/feature3.png') }}" alt="Get Certificates">
                </div>
                <div class="feature-content">
                    <h4>Get Certificates</h4>
                    <p>Earn recognized certificates upon completion to showcase your achievements and skills</p>
                </div>
            </div>
        </div>
    </div>
</section>
