@extends('front.layout.layout')

@section('content')
    <style>
        /* Base Styles */
        body {
            background-color: #f8fafc;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: #1e293b;
            line-height: 1.6;
        }

        .container {
            max-width: 1600px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Header Styles */
        .header {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 2.5rem;
            margin: 2rem 0;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .breadcrumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            backdrop-filter: blur(10px);
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 30%;
            height: 100%;
            background: linear-gradient(135deg, rgba(167, 119, 227, 0.1) 0%, rgba(110, 142, 251, 0.1) 100%);
            z-index: -1;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .header h1 {
            font-size: 2.25rem;
            font-weight: 700;
            background: linear-gradient(135deg, #6e8efb 0%, #a777e3 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 0;
        }

        /* Search and Filter Bar */
        .search-sort {
            display: flex;
            gap: 1rem;
            width: 100%;
            margin-top: 1.5rem;
        }

        .search-input {
            flex: 1;
            padding: 0.875rem 1.25rem;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .search-input:focus {
            outline: none;
            border-color: #a777e3;
            box-shadow: 0 0 0 3px rgba(167, 119, 227, 0.2);
        }

        .sort-select {
            padding: 0.875rem 1.25rem;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            min-width: 220px;
            font-size: 1rem;
            background-color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .sort-select:focus {
            outline: none;
            border-color: #a777e3;
            box-shadow: 0 0 0 3px rgba(167, 119, 227, 0.2);
        }

        /* Page Layout */
        .page-layout {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 2rem;
            margin-bottom: 3rem;
        }

        /* Filter Sidebar */
        .filter-sidebar {
            background: white;
            border-radius: 24px;
            padding: 2rem;
            height: fit-content;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 2rem;
        }

        .filter-section {
            margin-bottom: 2.5rem;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 2rem;
        }

        .filter-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .filter-section h3 {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 1.25rem;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-section h3::before {
            content: '';
            display: block;
            width: 6px;
            height: 6px;
            background: linear-gradient(135deg, #6e8efb 0%, #a777e3 100%);
            border-radius: 50%;
        }

        .filter-options {
            display: flex;
            flex-direction: column;
            gap: 0.875rem;
        }

        .filter-checkbox {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            transition: all 0.2s ease;
            padding: 0.5rem;
            border-radius: 8px;
        }

        .filter-checkbox:hover {
            background-color: #f8fafc;
        }

        .filter-checkbox input {
            width: 18px;
            height: 18px;
            accent-color: #a777e3;
            cursor: pointer;
        }

        .price-range {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .price-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.9375rem;
            transition: all 0.3s ease;
        }

        .price-input:focus {
            outline: none;
            border-color: #a777e3;
        }

        /* Courses Grid */
        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .course-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            max-height: 550px;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        .course-image-container {
            position: relative;
            overflow: hidden;
            height: 200px;
        }

        .course-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .course-card:hover .course-image {
            transform: scale(1.05);
        }

        .course-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: linear-gradient(135deg, #6e8efb 0%, #a777e3 100%);
            color: white;
            padding: 0.375rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .course-content {
            padding: 1.75rem;
        }

        .course-level {
            display: inline-block;
            margin-bottom: 0.75rem;
            font-size: 0.8125rem;
            font-weight: 600;
            padding: 0.375rem 0.75rem;
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .level-beginner {
            background-color: #dcfce7;
            color: #166534;
        }

        .level-intermediate {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .level-advanced {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .course-title {
            font-size: 1.125rem;
            font-weight: 700;
            margin: 0.5rem 0 1rem;
            color: #1e293b;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .course-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.25rem;
            font-size: 0.875rem;
            color: #64748b;
        }

        .course-meta-item {
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .course-price {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 1.5rem;
        }

        .price-current {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
        }

        .price-original {
            font-size: 0.9375rem;
            text-decoration: line-through;
            color: #94a3b8;
        }

        .enroll-btn {
            background: linear-gradient(135deg, #6e8efb 0%, #a777e3 100%);
            color: white;
            border: none;
            padding: 0.625rem 1.25rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(110, 142, 251, 0.2);
            text-decoration: none;
        }

        .enroll-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(110, 142, 251, 0.3);
        }

        /* Instructor Badge */
        .instructor-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1.25rem;
            padding-top: 1.25rem;
            border-top: 1px solid #f1f5f9;
        }

        .instructor-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }

        .instructor-name {
            font-size: 0.875rem;
            font-weight: 500;
            color: #475569;
        }

        /* Rating Stars */
        .course-rating {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            margin-bottom: 0.5rem;
        }

        .rating-stars {
            color: #f59e0b;
            font-size: 0.875rem;
            display: flex;
            gap: 2px;
        }

        .rating-stars .star {
            font-size: 1rem;
        }

        .rating-stars .star.filled {
            color: #f59e0b;
        }

        .rating-stars .star.empty {
            color: #e2e8f0;
        }

        .rating-value {
            font-weight: 600;
            font-size: 0.875rem;
            color: #1e293b;
            margin-left: 4px;
        }

        .rating-count {
            font-size: 0.8125rem;
            color: #64748b;
        }

        /* Responsive Adjustments */
        @media (max-width: 1200px) {
            .page-layout {
                grid-template-columns: 240px 1fr;
            }
        }

        @media (max-width: 992px) {
            .page-layout {
                grid-template-columns: 1fr;
            }

            .filter-sidebar {
                position: static;
                margin-bottom: 2rem;
            }

            .courses-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 1.5rem;
            }

            .header {
                padding: 1.75rem;
            }

            .header h1 {
                font-size: 1.75rem;
            }

            .search-sort {
                flex-direction: column;
            }

            .sort-select {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .course-card {
                margin-bottom: 1.5rem;
            }

            .course-price {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .enroll-btn {
                width: 100%;
            }
        }
    </style>
    <!-- Hero Section -->
    <section class="py-5 text-center text-white position-relative hero-section" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset('frontend/contactPageAssets/contact-bg.jpg') }}'); background-size: cover; background-position: center; min-height: 350px; display: flex; align-items: center;">
        <div class="container position-relative z-index-1">
            <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeInDown">Our Courses</h1>
            <p class="lead mb-4 animate__animated animate__fadeInUp">Explore our wide range of courses designed to help
                you succeed.</p>
            <nav aria-label="breadcrumb" class="animate__animated animate__fadeInUp">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}" class="text-white text-decoration-none">Home</a>
                    </li>
                    <li class="breadcrumb-item active text-white opacity-75" aria-current="page">Courses</li>
                </ol>
            </nav>
        </div>
    </section>
    <div class="container">
        <div class="header">
            <div class="header-content">
                <h1>Browse Courses</h1>
                <div class="search-sort">
                    <input type="text" class="search-input" placeholder="Search courses..." id="courseSearch">
                </div>
            </div>
        </div>

        <div class="page-layout">

            <aside class="filter-sidebar">
                <form id="filterForm" method="GET" action="{{ route('coursespage.index') }}">
                    <div class="filter-section">
                        <h3>Categories</h3>
                        <div class="filter-options">
                            @foreach($categories as $category)
                                <label class="filter-checkbox">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                        {{ in_array($category->id, (array)request('categories')) ? 'checked' : '' }}>
                                    <span>{{ $category->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="filter-section">
                        <h3>Level</h3>
                        <div class="filter-options">
                            <label class="filter-checkbox">
                                <input type="checkbox" name="levels[]" value="beginner"
                                    {{ in_array('beginner', (array)request('levels')) ? 'checked' : '' }}>
                                <span>Beginner</span>
                            </label>
                            <label class="filter-checkbox">
                                <input type="checkbox" name="levels[]" value="intermediate"
                                    {{ in_array('intermediate', (array)request('levels')) ? 'checked' : '' }}>
                                <span>Intermediate</span>
                            </label>
                            <label class="filter-checkbox">
                                <input type="checkbox" name="levels[]" value="advanced"
                                    {{ in_array('advanced', (array)request('levels')) ? 'checked' : '' }}>
                                <span>Advanced</span>
                            </label>
                        </div>
                    </div>

                    <div class="filter-section">
                        <h3>Price Range</h3>
                        <div class="price-range">
                            <input type="number" class="price-input" placeholder="Min" name="price_min" value="{{ request('price_min') }}">
                            <span>to</span>
                            <input type="number" class="price-input" placeholder="Max" name="price_max" value="{{ request('price_max') }}">
                        </div>
                    </div>

                    <button type="submit" class="enroll-btn" style="width: 100%; margin-top: 1rem;">
                        Apply Filters
                    </button>
                </form>
            </aside>

            <div class="courses-grid" id="coursesGrid">
            @foreach($courses as $course)
                    <div class="course-card">
                        <div class="course-image-container">
                            <img src="{{ asset('storage/'.$course->thumbnail) }}" alt="{{ $course->title }}" class="course-image">
                            @if($course->has_certificate)
                                <div class="course-badge">certified</div>
                            @endif
                        </div>
                        <div class="course-content">
                            <span class="course-level level-{{ $course->level }}">{{ $course->level }}</span>
                            <h3 class="course-title">{{ $course->title }}</h3>

                            <div class="course-rating">
                                <div class="rating-stars">
                                    @php
                                        $averageRating = round($course->ratings()->avg('rating'));
                                        $ratingsCount = $course->ratings()->count();
                                    @endphp
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="star {{ $i <= $averageRating ? 'filled' : 'empty' }}">
                                            <i class="fas fa-star"></i>
                                        </span>
                                    @endfor
                                </div>
                                <span
                                    class="rating-value">{{ number_format($course->ratings()->avg('rating'), 1) }}</span>
                                <span class="rating-count">({{ $ratingsCount }})</span>
                            </div>

                            <div class="course-meta">
                                <span class="course-meta-item">
                                    <i class="far fa-clock"></i> {{ $course->duration_hours }} hours
                                </span>
                            </div>

                            <div class="course-price">
                                <div>
                                    <span class="price-current">${{ $course->price }}</span>
                                    @if($course->original_price > $course->price)
                                        <span class="price-original">${{ $course->original_price }}</span>
                                    @endif
                                </div>
                                @if(auth()->user() && auth()->user()->role == "student")
                                    <a href="{{route('addToCart' , $course->id)}}" class="enroll-btn">Add to cart</a>
                                @endif
                            </div>


                            <div class="instructor-badge">
                                @if($course->user_id)
                                    @if($course->user->profile_image == "/images/avatar.jpg")
                                        <img src="{{ asset($course->user->profile_image)}}" alt="{{ $course->user->name }}" class="instructor-avatar">
                                    @else
                                        <img src="{{ asset('storage/'. $course->user->profile_image)}}" alt="{{ $course->user->name }}" class="instructor-avatar">
                                    @endif
                                    <span class="instructor-name">{{ $course->user->name }}</span>
                                @else
                                    <img
                                    src="{{  asset('images/avatar.jpg') }}"
                                    alt="{{ $course->admin->name }}" class="instructor-avatar">

                                    <span class="instructor-name">{{ $course->admin->name }}</span>

                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Search functionality
            const searchInput = document.getElementById('courseSearch');
            const courseCards = document.querySelectorAll('.course-card');

            searchInput.addEventListener('input', function (e) {
                const searchTerm = e.target.value.toLowerCase();

                courseCards.forEach(card => {
                    const title = card.querySelector('.course-title').textContent.toLowerCase();
                    const level = card.querySelector('.course-level').textContent.toLowerCase();

                    if (title.includes(searchTerm) || level.includes(searchTerm)) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection
