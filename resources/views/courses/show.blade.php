@extends('users.admin.layout.layout')

@section('title', 'Courses details')

@section('content')
    <div class="container">
        <div class="header">
            <div class="header-content d-flex justify-content-between w-100">
                    <h1>{{ $course->title }}</h1>
                    <a href="{{ route('admin.course.index') }}" class="add-btn">
                        <i class="fas fa-arrow-left"></i>
                        Back to Courses
                    </a>
            </div>
        </div>

        <div class="main-card">
            <div class="table-container">
                <table class="modern-table">
                    <tbody>
                    <tr>
                        <th>Thumbnail</th>
                        <td>
                            <img src="{{ asset('storage/'.$course->thumbnail) }}" alt="{{ $course->title }}" class="course-thumbnail">
                        </td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $course->description }}</td>
                    </tr>
                    <tr>
                        <th>Instructor</th>
                        <td>
                            <div class="instructor-info">
                                @if($course->admin_id)
                                    <span class="instructor-name">{{ $course->admin->name }}</span>

                                @elseif($course->user_id)
                                    <span class="instructor-name">{{ $course->user->name }}</span>
                                @else
                                    N/A
                                @endif

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td><span class="badge badge-category">{{ $course->category->name }}</span></td>
                    </tr>
                    <tr>
                        <th>Level</th>
                        <td><span class="badge badge-{{ strtolower($course->level) }}">{{ $course->level }}</span></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <div class="status-column">
                                <span class="badge badge-{{ strtolower($course->status) }}">{{ $course->status }}</span>
                                <span
                                    class="badge badge-{{ strtolower($course->is_approved) }}">{{ $course->is_approved }}</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>
                            <div class="price-info">
                                @if($course->sale_price)
                                    <span class="original-price">${{ $course->price }}</span>
                                    <span class="sale-price">${{ $course->sale_price }}</span>
                                @else
                                    <span class="regular-price">${{ $course->price }}</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Duration</th>
                        <td><span class="course-duration">{{ $course->duration_hours }} hours</span></td>
                    </tr>
                    <tr>

                        <th>Certificate</th>
                        <td><span
                                class="badge badge-certificate-{{ $course->has_certificate ? 'yes' : 'no' }}">{{ $course->has_certificate ? 'Yes' : 'No' }}</span>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <style>
        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .header-left {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            transform: translateX(-4px);
            color: #764ba2;
        }

        .header h1 {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .add-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
            text-decoration: none !important;
        }

        .add-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(102, 126, 234, 0.4);
        }

        .main-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .table-container {
            overflow-x: auto;
        }

        .modern-table {
            width: 100%;
            border-collapse: collapse;
        }

        .modern-table thead {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .modern-table th {
            padding: 1.5rem 1rem;
            text-align: left;
            font-weight: 600;
            color: #475569;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 2px solid #e2e8f0;
        }

        .modern-table td {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .modern-table tbody tr {
            transition: all 0.3s ease;
        }

        .modern-table tbody tr:hover {
            background: linear-gradient(135deg, #fafbff 0%, #f0f4ff 100%);
            transform: scale(1.001);
        }

        .course-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .course-thumbnail {
            width: 80px;
            height: 60px;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .course-details h3 {
            font-size: 1rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .course-duration {
            font-size: 0.875rem;
            color: #64748b;
        }

        .instructor-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .instructor-name {
            font-weight: 500;
            color: #1e293b;
        }

        .badge {
            padding: 0.375rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .badge-admin {
            background: linear-gradient(135deg, #374151 0%, #1f2937 100%);
            color: white;
        }

        .badge-instructor {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .badge-category {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            color: white;
        }

        .badge-beginner {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: white;
        }

        .badge-intermediate {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: white;
        }

        .badge-advanced {
            background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%);
            color: white;
        }

        .badge-published {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .badge-draft {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
        }

        .badge-archived {
            background: linear-gradient(135deg, #374151 0%, #1f2937 100%);
            color: white;
        }

        .badge-certificate-yes {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .badge-certificate-no {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
        }

        .badge-approved {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .badge-pending {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .badge-rejected {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .status-column {
            flex-direction: column;
            gap: 0.5rem;
        }

        .price-info {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .original-price {
            text-decoration: line-through;
            color: #9ca3af;
            font-size: 0.875rem;
        }
        .sale-price {
            color: #ef4444;
            font-weight: 600;
        }

        .regular-price {
            font-weight: 600;
            color: #1e293b;
        }

        .pagination {
            padding: 2rem;
            display: flex;
            justify-content: center;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.3;
        }


        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .header {
                padding: 1.5rem;
            }

            .header-content {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .modern-table th,
            .modern-table td {
                padding: 1rem 0.5rem;
            }

            .course-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .actions {
                flex-direction: column;
            }
        }
    </style>



@endsection
