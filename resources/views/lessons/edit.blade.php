@extends('users.user.layout.layout')

@section('content2')

    <div class="container my-3">
        <div class="row justify-content-center">

            <div class="col-md-10">

                {{-- form begin --}}
                <form action="{{ route('lesson.update', $lesson) }}" method="post">
                    @method('PUT')
                    @csrf


                    <div class="card shadow-lg">

                        {{--card title--}}
                        <div class="card-header fs-4 fw-bold">Edit</div>

                        {{--card body--}}
                        <div class="card-body">

                            {{-- title --}}
                            <div class="mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label for="title">Lesson Title</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="title"
                                               id="title"
                                               autofocus
                                               value="{{ old('title', $lesson->title) }}"
                                               class="form-control">
                                        @error('title')
                                        <div class="alert alert-danger py-2 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            {{-- content --}}
                            <div class="mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label for="content" class="">Lesson Content</label>
                                    </div>
                                    <div class="col-md-9">
                                        <textarea class="form-control"
                                                  name="content"
                                                  id="content"
                                                  rows="3">{{ old('content', $lesson->content) }}</textarea>
                                        @error('content')
                                        <div class="alert alert-danger py-2 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            {{-- lesson order --}}
                            <div class="mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label for="lesson_order">Lesson Order</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="number"
                                               name="lesson_order"
                                               id="lesson_order"
                                               value="{{ old('lesson_order', $lesson->lesson_order) }}"
                                               class="form-control">
                                        @error('lesson_order')
                                        <div class="alert alert-danger py-2 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- course selection --}}
                            <div class="mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label for="course_id">Select Course</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select name="course_id" id="course_id" class="form-select"
                                                aria-label="Course selection">
                                            <option selected disabled>Select a course</option>
                                            @foreach($courses as $course)
                                                <option
                                                    value="{{ $course->id }}" {{ old('course_id', $lesson->course_id) == $course->id ? 'selected' : '' }}>
                                                {{ $course->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('course_id')
                                        <div class="alert alert-danger py-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                        </div>{{--end card body--}}

                        {{--card footer--}}
                        <div class="card-footer">

                            <button type="submit" class="btn btn-primary">Submit</button>

                            <a class="btn btn-dark" href="{{ route('lesson.index') }}">Retour</a>

                        </div>

                    </div>
                </form>
                {{-- form end --}}

            </div>

        </div>
    </div>

@endsection
