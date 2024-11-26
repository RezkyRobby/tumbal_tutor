@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $course->course_name }} - Contents</h1>
    <p>{{ $course->description }}</p>

    <ul>
        @foreach ($course->contents as $content)
            <li>
                <strong>{{ $content->title }}</strong> - {{ $content->media_type }}
                <a href="{{ route('contents.view', $content->id) }}" class="btn btn-primary">View</a>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Back to Enrollments</a>
</div>
@endsection
