@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $content->title }}</h1>
    <p>{{ $content->body }}</p>

    <div class="media">
        @if ($content->media_type === 'youtube')
            <iframe src="{{ $content->media_path }}" frameborder="0" allowfullscreen></iframe>
        @elseif ($content->media_type === 'video' || $content->media_type === 'file')
            <a href="{{ asset('storage/' . $content->media_path) }}" download>Download {{ $content->media_type }}</a>
        @endif
    </div>

    <form action="{{ route('progress.markAsDone', $content->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Mark as Done</button>
    </form>

    <a href="{{ route('courses.contents', $content->course_id) }}" class="btn btn-secondary">Back to Contents</a>
</div>
@endsection
