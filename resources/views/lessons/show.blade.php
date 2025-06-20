@extends('users.user.layout.layout')


@section('content2')
    <style>
        .video-wrapper {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 */
            height: 0;
            overflow: hidden;
        }

        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

    </style>

    <div class="container my-3">

        <div class="row justify-content-center">
            <div class="col-md-10">{{-- card width --}}

                <div class="card shadow-lg">

                    {{--card header--}}
                    <div class="card-header fs-4 fw-bold">Lesson Details</div>

                    {{--card body--}}
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Lesson Title:</strong>
                                </div>
                                <div class="col-md-9">
                                    {{ $lesson->title }}
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Lesson Content:</strong>
                                </div>
                                <div class="col-md-9">
                                    {{ $lesson->content }}
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Lesson Order:</strong>
                                </div>
                                <div class="col-md-9">
                                    {{ $lesson->lesson_order }}
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Course:</strong>
                                </div>
                                <div class="col-md-9">
                                    {{ $lesson->course->title }}
                                </div>
                            </div>
                        </div>

                        @php
                            // Extract the video ID from the URL
                            $youtubeUrl = $lesson->content;
                            preg_match("/(?:https?:\/\/)?(?:www\.)?youtu(?:be\.com\/watch\?v=|\.be\/)([\w\-]+)/", $youtubeUrl, $matches);
                            $videoId = $matches[1] ?? null;
                        @endphp

                        @if ($videoId)
                            <div class="video-wrapper">
                                <iframe
                                    src="https://www.youtube.com/embed/{{ $videoId }}"
                                    title="YouTube video"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        @else
                            <p>Invalid YouTube URL.</p>
                        @endif

                    </div>

                    {{-- footer --}}
                    <div class="card-footer">
                        <a class="btn btn-dark" href="{{ route('lesson.index') }}">Retour</a>
                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection
