@extends('users.user.layout.layout')

@section('content2')
    <div class="container">
        <h2 class="mb-4">Course Reviews</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Course</th>
                    <th>Student</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ratings as $rating)
                    <tr>
                        <td>{{ $rating->course->title }}</td>
                        <td>{{ $rating->user->name }}</td>
                        <td>
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $rating->rating)
                                    <i class="fas fa-star text-warning"></i>
                                @else
                                    <i class="far fa-star text-warning"></i>
                                @endif
                            @endfor
                        </td>
                        <td>{{ $rating->comment }}</td>
                        <td>{{ $rating->created_at->format('M d, Y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @if($ratings->isEmpty())
            <div class="alert alert-info">No reviews found.</div>
        @endif
    </div>
@endsection
