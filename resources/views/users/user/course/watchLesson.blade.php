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
@endsection
