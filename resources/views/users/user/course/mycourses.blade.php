@extends('users.user.layout.layout')

@section('content2')
    <div class="container-fluid">
        <h2 class="mb-4">My Courses</h2>
        <div class="row">
            @forelse($courses as $course)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $course->thumbnail) }}" class="card-img-top"
                             alt="{{ $course->title }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button"
                                        id="lessonDropdown{{ $course->id }}" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                    View Lessons
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="lessonDropdown{{ $course->id }}">
                                    @forelse($course->lessons as $lesson)
                                        <li><a class="dropdown-item"
                                               href="{{route('courses.watchLesson' , $lesson->id)}}">{{ $lesson->title }}</a>
                                        </li>
                                    @empty
                                        <li><span class="dropdown-item">No lessons available</span></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">No courses found</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
