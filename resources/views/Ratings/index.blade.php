@extends('users.admin.layout.layout')

@section('title' , 'Ratings')

@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .reviews-container {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem;
        }

        .reviews-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .header h1 {
            font-size: 2.5rem;
            color: #2d3748;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .header p {
            color: #718096;
            font-size: 1.1rem;
        }

        .reviews-grid {
            display: grid;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .review-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .review-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .review-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .course-info {
            flex: 1;
        }

        .course-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.25rem;
        }

        .student-name {
            color: #718096;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .student-name i {
            color: #667eea;
        }

        .rating-container {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 0.25rem;
        }

        .stars {
            display: flex;
            gap: 0.2rem;
        }

        .star {
            color: #ffd700;
            font-size: 1.1rem;
            transition: transform 0.2s ease;
        }

        .star:hover {
            transform: scale(1.2);
        }

        .rating-number {
            font-size: 0.85rem;
            color: #718096;
            font-weight: 500;
        }

        .comment {
            color: #4a5568;
            line-height: 1.6;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }

        .review-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
        }

        .date {
            color: #a0aec0;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .helpful-btn {
            background: none;
            border: 1px solid #e2e8f0;
            color: #718096;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .helpful-btn:hover {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #718096;
        }

        .empty-state i {
            font-size: 4rem;
            color: #cbd5e0;
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: #4a5568;
        }

        .stats-bar {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            border-radius: 12px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #667eea;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #718096;
            margin-top: 0.25rem;
        }

        @media (max-width: 768px) {
            .reviews-wrapper {
                padding: 1rem;
                margin: 1rem;
            }

            .header h1 {
                font-size: 2rem;
            }

            .review-header {
                flex-direction: column;
                gap: 1rem;
            }

            .rating-container {
                align-items: flex-start;
            }

            .stats-bar {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>

    <div class="reviews-container">
        <div class="reviews-wrapper">
            <div class="header">
                <h1>Course Reviews</h1>
                <p>See what students are saying about the courses</p>
            </div>

            @if($ratings->isNotEmpty())
                <div class="stats-bar">
                    <div class="stat-item">
                        <div class="stat-number">{{ number_format($ratings->avg('rating'), 1) }}</div>
                        <div class="stat-label">Average Rating</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $ratings->count() }}</div>
                        <div class="stat-label">Total Reviews</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ number_format(($ratings->where('rating', '>=', 4)->count() / $ratings->count()) * 100) }}%</div>
                        <div class="stat-label">Recommended</div>
                    </div>
                </div>

                <div class="reviews-grid">
                    @foreach($ratings as $rating)
                        <div class="review-card">
                            <div class="review-header">
                                <div class="course-info">
                                    <div class="course-title">{{ $rating->course->title }}</div>
                                    <div class="student-name">
                                        <i class="fas fa-user-circle"></i>
                                        {{ $rating->user->name }}
                                    </div>
                                </div>
                                <div class="rating-container">
                                    <div class="stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $rating->rating)
                                                <i class="fas fa-star star"></i>
                                            @else
                                                <i class="far fa-star star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <div class="rating-number">{{ number_format($rating->rating, 1) }}</div>
                                </div>
                            </div>

                            @if($rating->comment)
                                <div class="comment">
                                    {{ $rating->comment }}
                                </div>
                            @endif

                            <div class="review-footer">
                                <div class="date">
                                    <i class="far fa-calendar"></i>
                                    {{ $rating->created_at->format('M d, Y') }}
                                </div>
                                <button class="helpful-btn">
                                    <i class="far fa-thumbs-up"></i>
                                    Helpful
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="far fa-comments"></i>
                    <h3>No Reviews Yet</h3>
                    <p>Your courses haven't received any reviews yet. Keep creating great content!</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Add interactivity
        document.querySelectorAll('.helpful-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if (this.classList.contains('active')) {
                    this.innerHTML = '<i class="far fa-thumbs-up"></i> Helpful';
                    this.classList.remove('active');
                } else {
                    this.innerHTML = '<i class="fas fa-thumbs-up"></i> Thanks!';
                    this.classList.add('active');
                    this.style.background = '#667eea';
                    this.style.color = 'white';
                    this.style.borderColor = '#667eea';
                }
            });
        });

        // Add hover effects to stars
        document.querySelectorAll('.star').forEach(star => {
            star.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.2)';
            });

            star.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });
    </script>
@endsection
