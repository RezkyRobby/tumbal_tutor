@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $content->title }}</h1>
    <p>{{ $content->body }}</p>

    <div class="media mt-4">
        @if ($content->media_type === 'youtube')
            <!-- YouTube Embed -->
            <iframe 
                src="{{ $content->media_path }}" 
                frameborder="0" 
                allowfullscreen 
                style="width: 100%; height: 400px;">
            </iframe>
        @elseif ($content->media_type === 'video')
            <!-- Video Player -->
            <video 
                controls 
                style="width: 100%; max-height: 400px;">
                <source src="{{ asset('storage/' . $content->media_path) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @elseif ($content->media_type === 'file')
            <!-- File Viewer -->
            @php
                $fileExtension = pathinfo($content->media_path, PATHINFO_EXTENSION);
            @endphp

            @if (in_array($fileExtension, ['pdf']))
                <!-- PDF Viewer -->
                <iframe 
                    src="{{ asset('storage/' . $content->media_path) }}" 
                    frameborder="0" 
                    style="width: 100%; height: 500px;">
                </iframe>
            @else
                <!-- Download Link for Other Files -->
                <a 
                    href="{{ asset('storage/' . $content->media_path) }}" 
                    download 
                    class="btn btn-primary">
                    Download {{ strtoupper($fileExtension) }} File
                </a>
            @endif
        @endif
    </div>

    <form action="{{ route('progress.markAsDone', $content->id) }}" method="POST" class="mt-4">
        @csrf
        <button type="submit" class="btn btn-success">Mark as Done</button>
    </form>

    <a href="{{ route('courses.contents', $content->course_id) }}" class="btn btn-secondary mt-2">Back to Contents</a>
</div>
@endsection
