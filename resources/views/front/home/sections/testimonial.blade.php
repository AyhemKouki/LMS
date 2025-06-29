<style>
    .testimonial-section {
        padding: 120px 0;
        background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
        position: relative;
        overflow: hidden;
        animation: gradientShift 15s ease infinite;
    }

    @keyframes gradientShift {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    .testimonial-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23193765' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .testimonial-card {
        background: white;
        border-radius: 20px;
        padding: 35px;
        margin: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        border: 1px solid rgba(0, 0, 0, 0.05);
        opacity: 0;
        animation: slideIn 0.8s ease-out forwards;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .testimonial-card:hover {
        transform: translateY(-10px) rotate(1deg);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    }

    .student-info {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        transition: transform 0.3s ease;
    }

    .student-info:hover {
        transform: scale(1.05);
    }

    .student-avatar {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        margin-right: 20px;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
        }
    }

    .student-name {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 5px;
    }

    .student-course {
        color: #718096;
        font-size: 0.95rem;
    }

    .rating {
        color: #ffd700;
        margin: 15px 0;
        font-size: 1.1rem;
    }

    .rating i {
        opacity: 0;
        animation: starFade 0.5s ease forwards;
    }

    .rating i:nth-child(1) {
        animation-delay: 0.1s;
    }

    .rating i:nth-child(2) {
        animation-delay: 0.2s;
    }

    .rating i:nth-child(3) {
        animation-delay: 0.3s;
    }

    .rating i:nth-child(4) {
        animation-delay: 0.4s;
    }

    .rating i:nth-child(5) {
        animation-delay: 0.5s;
    }

    @keyframes starFade {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .testimonial-text {
        color: #4a5568;
        line-height: 1.8;
        font-size: 1.05rem;
    }

    .test-section-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: #000000;
        margin-bottom: 1rem;
        position: relative;
        display: inline-block;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        animation: titleAppear 1s ease-out;
    }

    @keyframes titleAppear {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .test-section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 4px;
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        border-radius: 2px;
        animation: lineGrow 0.8s ease-out forwards 0.5s;
    }

    @keyframes lineGrow {
        from {
            width: 0;
        }
        to {
            width: 80px;
        }
    }
</style>
@php
    use App\Models\Rating;

    $ratings = Rating::with(['user', 'course'])
        ->where('rating', '>=', 4)
        ->latest()
        ->take(6)
        ->get();
@endphp
<section class="testimonial-section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="test-section-title">What Our Students Say</h2>
            </div>
        </div>
        <div class="row">
            @foreach($ratings as $rating)
            <div class="col-lg-4 col-md-6">
                        <div class="testimonial-card">
                            <div class="student-info">
                                <img src="{{ asset('storage/'.$rating->user->profile_image)}}" alt="Student Avatar"
                                     class="student-avatar">
                                <div>
                                    <h4 class="student-name">{{ $rating->user->name }}</h4>
                                    <p class="student-course">{{ $rating->course->name }}</p>
                                </div>
                            </div>
                            <div class="rating">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $rating->rating)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <p class="testimonial-text">{{ $rating->comment }}</p>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
</section>

